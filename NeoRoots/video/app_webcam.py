from flask import Flask, jsonify, Response
from flask_cors import CORS
import cv2
import time
import threading
lock = threading.Lock()
from ultralytics import YOLO


# =========================
# YOLO
# =========================
print("Cargando YOLO...")
model = YOLO("yolov8s.pt")
print("YOLO cargado")

app = Flask(__name__)
CORS(
    app,
    resources={
        r"/*": {
            "origins": [
                "http://localhost"
            ]
        }
    }
)

# =========================
# OBJETO -> MATERIAL
# =========================
MATERIALES = {

    # PLASTICO
    "bottle": "plastic",
    "cup": "plastic",
    "toothbrush": "plastic",

    # PAPEL
    "book": "paper",

    # VIDRIO
    "wine glass": "glass",
    "vase": "glass",

    # METAL
    "cell phone": "metal",
    "laptop": "metal",
    "keyboard": "metal",
    "mouse": "metal",
    "remote": "metal"
}

# =========================
# PUNTOS
# =========================
PUNTOS = {
    "plastic": 10,
    "paper": 20,
    "glass": 30,
    "metal": 20
}

# =========================
# COLORES
# =========================
COLORES = {

    "plastic": (0, 255, 255),
    "paper": (255, 0, 0),
    "glass": (0, 255, 0),
    "metal": (128, 128, 128),
    "unknown": (0, 0, 255)
}

# =========================
# VARIABLES GLOBALES
# =========================
frame_actual = None
detecciones_actuales = []
cajas_previas = {}

ultima_deteccion = {
    "object": "ninguno",
    "material": "unknown",
    "points": 0,
    "confidence": 0
}

# =========================
# CAMARA
# =========================
print("Abriendo webcam...")

cap = cv2.VideoCapture(
    0,
    cv2.CAP_DSHOW
)

cap.set(cv2.CAP_PROP_FRAME_WIDTH, 640)
cap.set(cv2.CAP_PROP_FRAME_HEIGHT, 480)

if not cap.isOpened():

    print("ERROR: no se pudo abrir webcam")
    exit()

print("Webcam OK")

# =========================
# HILO CAPTURA
# =========================
def capturar_frames():

    global frame_actual

    while True:

        ok, frame = cap.read()

        if ok:
            with lock:
                frame_actual = frame

        time.sleep(0.003)

# =========================
# HILO YOLO
# =========================
def procesar_yolo():

    global frame_actual
    global detecciones_actuales
    global ultima_deteccion
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

        frame_yolo = cv2.resize(
            frame,
            (320, 240)
        )

        inicio_yolo = time.time()

        results = model(
            frame_yolo,
            imgsz=320,
            verbose=False,
            classes=[
                39,  # bottle
                41,  # cup
                73,  # book
                40,  # wine glass
                75,  # vase
                67,  # cell phone
                63,  # laptop
                66,  # keyboard
                64,  # mouse
                65   # remote
            ]
        )

        fin_yolo = time.time()

        tiempo_yolo = fin_yolo - inicio_yolo

        fps_yolo = 1 / max(
            tiempo_yolo,
            0.0001
        )

        print(
            f"YOLO FPS: {fps_yolo:.1f}"
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
                clave = nombre

                material = MATERIALES.get(
                    nombre,
                    "unknown"
                )

                puntos = PUNTOS.get(
                    material,
                    0
                )

                color = COLORES.get(
                    material,
                    COLORES["unknown"]
                )

                x1, y1, x2, y2 = box.xyxy[0]

                escala_x = frame.shape[1] / 320
                escala_y = frame.shape[0] / 240

                x1 = int(x1 * escala_x)
                y1 = int(y1 * escala_y)

                x2 = int(x2 * escala_x)
                y2 = int(y2 * escala_y)

                # =========================
                # SUAVIZADO
                # =========================

                clave = nombre

                if clave in cajas_previas:

                    previo = cajas_previas[clave]

                    x1 = int(previo[0] * 0.7 + x1 * 0.3)
                    y1 = int(previo[1] * 0.7 + y1 * 0.3)

                    x2 = int(previo[2] * 0.7 + x2 * 0.3)
                    y2 = int(previo[3] * 0.7 + y2 * 0.3)

                cajas_previas[clave] = (
                    x1,
                    y1,
                    x2,
                    y2
                )

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

        with lock:

            ultima_deteccion = {
                "object": mejor_objeto,
                "material": mejor_material,
                "points": mejor_puntos,
                "confidence": round(
                    mejor_confianza,
                    2
                )
            }

# =========================
# PAGINA PRINCIPAL
# =========================
@app.route("/")
def index():

    return """
    <h1>NeoRoots IA activa</h1>

    <ul>
        <li><a href='/video'>/video</a></li>
        <li><a href='/detectar'>/detectar</a></li>
        <li><a href='/ultima_deteccion'>/ultima_deteccion</a></li>
    </ul>
    """

# =========================
# ULTIMA DETECCION
# =========================
@app.route("/ultima_deteccion")
def obtener_ultima_deteccion():

    return jsonify(
        ultima_deteccion
    )

# =========================
# DETECTAR
# =========================
@app.route("/detectar")
def detectar():

    return jsonify({

        "success": True,
        "object": ultima_deteccion["object"],
        "material": ultima_deteccion["material"],
        "points": ultima_deteccion["points"],
        "confidence": ultima_deteccion["confidence"]
    })

# =========================
# VIDEO
# =========================
def generar_video():

    tiempo_anterior = time.time()

    while True:

        with lock:

            if frame_actual is None:
                continue

            frame = frame_actual.copy()

            detecciones = detecciones_actuales.copy()

        tiempo_actual = time.time()

        fps = 1 / max(
            tiempo_actual - tiempo_anterior,
            0.0001
        )

        tiempo_anterior = tiempo_actual

        for det in detecciones:

            cv2.rectangle(
                frame,
                (det["x1"], det["y1"]),
                (det["x2"], det["y2"]),
                det["color"],
                2
            )

            texto = (
                f'{det["nombre"]} '
                f'{det["confianza"]:.2f}'
            )

            cv2.putText(
                frame,
                texto,
                (det["x1"], det["y1"] - 10),
                cv2.FONT_HERSHEY_SIMPLEX,
                0.6,
                det["color"],
                2
            )

        cv2.putText(
            frame,
            f"FPS: {fps:.1f}",
            (10, 30),
            cv2.FONT_HERSHEY_SIMPLEX,
            0.8,
            (255, 255, 255),
            2
        )

        cv2.putText(
            frame,
            "YOLOv8s",
            (10, 60),
            cv2.FONT_HERSHEY_SIMPLEX,
            0.8,
            (255, 255, 255),
            2
        )

        ret, buffer = cv2.imencode(
            ".jpg",
            frame
        )

        if not ret:
            continue

        yield (
            b'--frame\r\n'
            b'Content-Type: image/jpeg\r\n\r\n'
            + buffer.tobytes() +
            b'\r\n'
        )

# =========================
# STREAM
# =========================
@app.route("/video")
def video():

    return Response(
        generar_video(),
        mimetype="multipart/x-mixed-replace; boundary=frame"
    )

# =========================
# MAIN
# =========================
if __name__ == "__main__":

    threading.Thread(
        target=capturar_frames,
        daemon=True
    ).start()

    threading.Thread(
        target=procesar_yolo,
        daemon=True
    ).start()

    print("NeoRoots IA iniciada")

    app.run(
        host="0.0.0.0",
        port=5000,
        debug=False,
        threaded=True
    )