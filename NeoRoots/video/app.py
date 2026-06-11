from flask import Flask
import serial
import time

app = Flask(__name__)

# ⚠️ Puerto del colegio
arduino = serial.Serial('COM9', 9600)
time.sleep(2)

@app.route('/')
def home():
    return """
    <html>
    <head>
        <title>Papelera Inteligente</title>
        <style>
            body {
                font-family: Arial;
                text-align: center;
                background: #f2f2f2;
            }

            button {
                width: 220px;
                height: 80px;
                margin: 15px;
                font-size: 20px;
                border: none;
                border-radius: 15px;
                color: white;
                cursor: pointer;
            }

            .verde { background: #2ecc71; }
            .blanco { background: #bdc3c7; color: black; }
            .negro { background: #2c3e50; }
        </style>
    </head>

    <body>
        <h1>♻ Papelera Inteligente</h1>

        <button class="verde" onclick="fetch('/verde')">Verde</button>
        <br>
        <button class="blanco" onclick="fetch('/blanco')">Blanco</button>
        <br>
        <button class="negro" onclick="fetch('/negro')">Negro</button>
    </body>
    </html>
    """

@app.route('/verde')
def verde():
    arduino.write(b'A')
    return "OK"

@app.route('/blanco')
def blanco():
    arduino.write(b'A')
    return "OK"

@app.route('/negro')
def negro():
    arduino.write(b'A')
    return "OK"

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=False)