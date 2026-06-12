from flask import Flask, jsonify, Response
from flask_cors import CORS
import cv2
import time
import threading
import serial
from ultralytics import YOLO

# =========================
# ARDUINO
# =========================
arduino = serial.Serial('COM9', 9600)
time.sleep(2)

print("Arduino conectado")

# =========================
# YOLO
# =========================
print("Cargando YOLO...")
model = YOLO("yolov8s.pt")
print("YOLO cargado")

# =========================
# FLASK
# =========================
app = Flask(__name__)
CORS(app, resources={r"/*": {"origins": ["http://localhost"]}})

# =========================
# CONFIG
# =========================
lock = threading.Lock()

frame_actual = None
detecciones_actuales = []
cajas_previas = {}

ultima_deteccion = {
    "object": "ninguno",
    "material": "unknown",
    "points": 0,
    "confidence": 0
}

# 🔥 FIX IMPORTANTE (antes faltaba)
ultimo_material_enviado = None

# =========================
# MAPAS
# =========================
MATERIALES = {
    "bottle": "plastic",
    "cup": "plastic",
    "toothbrush": "plastic",
    "book": "paper",
    "wine glass": "glass",
    "vase": "glass",
    "cell phone": "metal",
    "laptop": "metal",
    "keyboard": "metal",
    "mouse": "metal",
    "remote": "metal"
}

PUNTOS = {
    "plastic": 10,
    "paper": 20,
    "glass": 30,
    "metal": 20
}

COLORES = {
    "plastic": (0, 255, 255),
    "paper": (255, 0, 0),
    "glass": (0, 255, 0),
    "metal": (128, 128, 128),
    "unknown": (0, 0, 255)
}

# =========================
# CAMARA
# =========================
print("Abriendo webcam...")
cap = cv2.VideoCapture(0, cv2.CAP_DSHOW)

cap.set(cv2.CAP_PROP_FRAME_WIDTH, 640)
cap.set(cv2.CAP_PROP_FRAME_HEIGHT, 480)

if not cap.isOpened():
    print("ERROR webcam")
    exit()

print("Webcam OK")

# =========================
# SERVO
# =========================
def mover_servo():
    arduino.write(b'V')

# =========================
# THREAD: CAPTURA
# =========================
def capturar_frames():

    global frame_actual

    while True:
        ok, frame = cap.read()

        if ok:
            with lock:
                frame_actual = frame

        time.sleep(0.01)

# =========================
# THREAD: YOLO
# =========================
def procesar_yolo():

    global frame_actual
    global detecciones_actuales
    global ultima_deteccion
    global ultimo_material_enviado

    ultimo_yolo = 0

    while True:

        if time.time() - ultimo_yolo < 0.125:
            time.sleep(0.01)
            continue

        ultimo_yolo = time.time()

        with lock:
            if frame_actual is None:
                continue
            frame = frame_actual.copy()

        frame_yolo = cv2.resize(frame, (320, 240))

        results = model(
            frame_yolo,
            imgsz=320,
            verbose=False,
            classes=[39, 41, 73, 40, 75, 67, 63, 66, 64, 65]
        )

        nuevas_detecciones = []

        mejor_confianza = 0
        mejor_objeto = "ninguno"
        mejor_material = "unknown"
        mejor_puntos = 0

        for result in results:

            for box in result.boxes:

                confianza = float(box.conf[0])

                if confianza < 0.40:
                    continue

                clase = int(box.cls[0])
                nombre = model.names[clase]

                material = MATERIALES.get(nombre, "unknown")
                puntos = PUNTOS.get(material, 0)
                color = COLORES.get(material, COLORES["unknown"])

                x1, y1, x2, y2 = box.xyxy[0]

                escala_x = frame.shape[1] / 320
                escala_y = frame.shape[0] / 240

                x1 = int(x1 * escala_x)
                y1 = int(y1 * escala_y)
                x2 = int(x2 * escala_x)
                y2 = int(y2 * escala_y)

                nuevas_detecciones.append({
                    "x1": x1,
                    "y1": y1,
                    "x2": x2,
                    "y2": y2,
                    "nombre": nombre,
                    "material": material,
                    "confianza": confianza,
                    "color": color
                })

                if confianza > mejor_confianza:
                    mejor_confianza = confianza
                    mejor_objeto = nombre
                    mejor_material = material
                    mejor_puntos = puntos

        with lock:
            detecciones_actuales = nuevas_detecciones

            ultima_deteccion = {
                "object": mejor_objeto,
                "material": mejor_material,
                "points": mejor_puntos,
                "confidence": round(mejor_confianza, 2)
            }

@app.route("/")
def index():
    return """
    <h1>NeoRoots IA activa</h1>
    <a href='/video'>video</a><br>
    <a href='/ultima_deteccion'>detección</a>
    """

@app.route("/ultima_deteccion")
def obtener():
    return jsonify(ultima_deteccion)

@app.route("/mover_servo")
def mover_servo_web():

    print("MOVIENDO SERVO")

    mover_servo()

    return jsonify({
        "ok": True
    })
# =========================
# VIDEO STREAM
# =========================
def generar_video():

    while True:

        with lock:
            if frame_actual is None:
                continue
            frame = frame_actual.copy()
            detecciones = detecciones_actuales.copy()

        for det in detecciones:

            cv2.rectangle(frame,
                          (det["x1"], det["y1"]),
                          (det["x2"], det["y2"]),
                          det["color"], 2)

            cv2.putText(frame,
                        det["nombre"],
                        (det["x1"], det["y1"] - 10),
                        cv2.FONT_HERSHEY_SIMPLEX,
                        0.6,
                        det["color"], 2)

        ret, buffer = cv2.imencode(".jpg", frame)

        if not ret:
            continue

        yield (b'--frame\r\n'
               b'Content-Type: image/jpeg\r\n\r\n'
               + buffer.tobytes() +
               b'\r\n')

@app.route("/video")
def video():
    return Response(generar_video(),
                    mimetype="multipart/x-mixed-replace; boundary=frame")

# =========================
# MAIN
# =========================
if __name__ == "__main__":

    threading.Thread(target=capturar_frames, daemon=True).start()
    threading.Thread(target=procesar_yolo, daemon=True).start()

    print("NeoRoots listo")

    app.run(host="0.0.0.0", port=5000, debug=False, threaded=True)