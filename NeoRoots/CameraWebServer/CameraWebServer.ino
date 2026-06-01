#include <HTTPClient.h>
#include "esp_camera.h"
#include <WiFi.h>
#include <WebServer.h>
#include <ESPmDNS.h>

#define CAMERA_MODEL_AI_THINKER
#include "camera_pins.h"

// =========================
// WIFI
// =========================
const char* ssid = "FamiliaUL";
const char* password = "Thexxx1985$";

WebServer server(80);

// =========================
// CAPTURE
// =========================
void handleCapture() {

  camera_fb_t * fb = esp_camera_fb_get();

  if (!fb) {
    server.send(500, "text/plain", "Camera capture failed");
    return;
  }

  server.sendHeader("Content-Type", "image/jpeg");
  server.send_P(200, "image/jpeg", (const char *)fb->buf, fb->len);

  esp_camera_fb_return(fb);
}

// =========================
// STREAM
// =========================
void handleStream() {

  WiFiClient client = server.client();

  String response =
    "HTTP/1.1 200 OK\r\n"
    "Content-Type: multipart/x-mixed-replace; boundary=frame\r\n\r\n";

  client.print(response);

  while (client.connected()) {

    camera_fb_t * fb = esp_camera_fb_get();

    if (!fb) continue;

    client.printf(
      "--frame\r\n"
      "Content-Type: image/jpeg\r\n"
      "Content-Length: %u\r\n\r\n",
      fb->len
    );

    client.write(fb->buf, fb->len);
    client.print("\r\n");

    esp_camera_fb_return(fb);

    delay(50); // ~20 FPS
  }
}

// =========================
// SETUP
// =========================
void setup() {

  Serial.begin(115200);

  camera_config_t config;

  config.ledc_channel = LEDC_CHANNEL_0;
  config.ledc_timer = LEDC_TIMER_0;

  config.pin_d0 = Y2_GPIO_NUM;
  config.pin_d1 = Y3_GPIO_NUM;
  config.pin_d2 = Y4_GPIO_NUM;
  config.pin_d3 = Y5_GPIO_NUM;
  config.pin_d4 = Y6_GPIO_NUM;
  config.pin_d5 = Y7_GPIO_NUM;
  config.pin_d6 = Y8_GPIO_NUM;
  config.pin_d7 = Y9_GPIO_NUM;

  config.pin_xclk = XCLK_GPIO_NUM;
  config.pin_pclk = PCLK_GPIO_NUM;
  config.pin_vsync = VSYNC_GPIO_NUM;
  config.pin_href = HREF_GPIO_NUM;

  config.pin_sccb_sda = SIOD_GPIO_NUM;
  config.pin_sccb_scl = SIOC_GPIO_NUM;

  config.pin_pwdn = PWDN_GPIO_NUM;
  config.pin_reset = RESET_GPIO_NUM;

  config.xclk_freq_hz = 20000000;

  config.pixel_format = PIXFORMAT_JPEG;

  config.frame_size = FRAMESIZE_VGA;
  config.jpeg_quality = 12;
  config.fb_count = 2;

  if (esp_camera_init(&config) != ESP_OK) {
    Serial.println("Error iniciando cámara");
    return;
  }

  // =========================
  // WIFI
  // =========================
  WiFi.begin(ssid, password);

  Serial.print("Conectando WiFi");

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  String ip = WiFi.localIP().toString();

HTTPClient http;

http.begin("http://192.168.1.9/NeoRoots/BackEnd/register_camera.php");

http.addHeader(
  "Content-Type",
  "application/x-www-form-urlencoded"
);

String datos =
  "name=NeoRootsCam&ip=" + ip;

int codigo = http.POST(datos);

Serial.print("Codigo registro: ");
Serial.println(codigo);

http.end();

  Serial.println("");
  Serial.println("WiFi conectado");

  Serial.print("IP: ");
  Serial.println(WiFi.localIP());

  // =========================
  // MDNS
  // =========================
  if (MDNS.begin("neoroots-cam")) {
    Serial.println("mDNS iniciado");
  }

  Serial.println("Listo:");
  Serial.println("http://neoroots-cam.local/capture");
  Serial.println("http://neoroots-cam.local/stream");
}

// =========================
// LOOP
// =========================
void loop() {
  server.handleClient();
}