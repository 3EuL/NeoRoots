from flask import Flask, Response
import requests
import cv2
import numpy as np
from ultralytics import YOLO
from datetime import datetime

app = Flask(__name__)

ESP32_URL = "http://192.168.4.1/capture"
model = YOLO("yolov8n.pt")  # se descarga automáticamente la primera vez

PUNTOS = {
    "bottle": 10,
    "cup": 5,
    "book": 7,
    "cell phone": 2
}

@app.route("/")
def index():
    return "<h1>NeoRoots IA activa</h1><p>Ve a /detectar</p>"

@app.route("/detectar")
def detectar():
    try:
        r = requests.get(ESP32_URL, timeout=10)
        img_array = np.frombuffer(r.content, np.uint8)
        img = cv2.imdecode(img_array, cv2.IMREAD_COLOR)

        results = model(img, verbose=False)

        detectado = "ninguno"
        puntos = 0

        for result in results:
            for box in result.boxes:
                clase = int(box.cls[0])
                nombre = model.names[clase]
                detectado = nombre
                puntos = PUNTOS.get(nombre, 1)

                x1, y1, x2, y2 = map(int, box.xyxy[0])
                cv2.rectangle(img, (x1, y1), (x2, y2), (0, 255, 0), 2)
                cv2.putText(img, f"{nombre} (+{puntos})", (x1, y1 - 10),
                            cv2.FONT_HERSHEY_SIMPLEX, 0.6, (0, 255, 0), 2)
                break

        hora = datetime.now().strftime("%H:%M:%S")
        cv2.putText(img, f"Hora: {hora}", (10, 25),
                    cv2.FONT_HERSHEY_SIMPLEX, 0.7, (255, 0, 0), 2)

        _, buffer = cv2.imencode(".jpg", img)
        return Response(buffer.tobytes(), mimetype="image/jpeg")

    except Exception as e:
        return f"Error: {e}", 500

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)