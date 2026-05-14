#include <OneWire.h>
#include <DallasTemperature.h>
#include <WiFi.h>
#include <HTTPClient.h>

#define PIN_SENSOR 21

OneWire oneWire(PIN_SENSOR);
DallasTemperature sensores(&oneWire);

const char* ssid = "Cuando tenga el Esp32";
const char* password = "Cuando tenga el Esp32";

const char* servidor = "https://tuweb.infinityfreeapp.com/php)";

void setup() {
  Serial.begin(115200);
  sensores.begin();

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Conectando");
  }

  Serial.println("Conectado");
}

void loop() {

  sensores.requestTemperatures();

  float temperatura = sensores.getTempCByIndex(0);

  if (temperatura == DEVICE_DISCONNECTED_C) {
    Serial.println("Error");
    return;
  }

  Serial.print("Temperatura: ");
  Serial.println(temperatura);

  if (WiFi.status() == WL_CONNECTED) { //Envio de datos al ervidor

    HTTPClient http;

    http.begin(servidor);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    String datos = "temperatura=" + String(temperatura);

    int codigo = http.POST(datos);

    Serial.print("Respuesta: ");
    Serial.println(codigo);

    http.end();
  }

  delay(3000);
}