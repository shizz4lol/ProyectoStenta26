//Libreras que se incluyen
#include <OneWire.h>
#include <DallasTemperature.h>

// Pin donde conecta el sensor
#define PIN_SENSOR 21

// Configuración de comunicación
OneWire oneWire(PIN_SENSOR);
DallasTemperature sensores(&oneWire);

void setup() {
  Serial.begin(115200);
  sensores.begin();
}

void loop() {

  // Se pide temperatura al sensor
  sensores.requestTemperatures();

  // Se obtiene la temperatura del sensor
  float temperatura = sensores.getTempCByIndex(0);

  // Se verifica si hay algun error
  if (temperatura == DEVICE_DISCONNECTED_C) {
    Serial.println("Error");
    return;
  }

  // Se muestra los datos en pantalla
  Serial.print("Temperatura: ");
  Serial.print(temperatura);
  Serial.println(" °C");


  delay(3000);
}