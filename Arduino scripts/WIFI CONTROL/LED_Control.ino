



#include <ESP8266WiFi.h>
#include <ArduinoJson.h>

const char* ssid     = "iPhoneAlex";
const char* password = "oliolioli";

const char* host     = "172.20.10.4"; 
// pentru camin 192.168.1.120
String path          = "/LicentaLaravelV2/resources/views/control/light.json";
const int pin        = 12;//becul
const int pin2       = 13;//pompa

void setup() {
  pinMode(pin, OUTPUT);
  pinMode(pin, HIGH);
  pinMode(pin2,OUTPUT);
  pinMode(pin2, HIGH);
  Serial.begin(115200);

  delay(10);
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);
  int wifi_ctr = 0;
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("WiFi connected");
  Serial.println("IP address: " + WiFi.localIP());
}

void loop() {
  Serial.print("connecting to ");
  Serial.println(host);
  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
        digitalWrite(pin, HIGH);
        digitalWrite(pin2, HIGH);
    return;
  }

  client.print(String("GET ") + path + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "Connection: keep-alive\r\n\r\n");

  delay(500); // wait for server to respond

  // read response
  String section = "header";
  while (client.available()) {
    String line = client.readStringUntil('\r');
    // Serial.print(line);
    // we’ll parse the HTML body here
    if (section == "header") { // headers..
      Serial.print(".");
      if (line == "\n") { // skips the empty space at the beginning
        section = "json";
      }
    }
    else if (section == "json") { // print the good stuff
      section = "ignore";
      String result = line.substring(1);

      // Parse JSON
      int size = result.length() + 1;
      char json[size];
      result.toCharArray(json, size);
      StaticJsonBuffer<200> jsonBuffer;
      JsonObject& json_parsed = jsonBuffer.parseObject(json);
      if (!json_parsed.success())
      {
        Serial.println("parseObject() failed");
        return;
      }

      // Make the decision to turn off or on the LED
      if (strcmp(json_parsed["light"], "off") == 0) {
        digitalWrite(pin, HIGH);
        digitalWrite(pin2, HIGH);
        Serial.println("LED OFF");
      }
       if (strcmp(json_parsed["light"], "on") == 0) {
        digitalWrite(pin, LOW);
        Serial.println("LED ON");
        digitalWrite(pin2, HIGH);
      }
      if (strcmp(json_parsed["light"], "onn") == 0) {
        digitalWrite(pin2, LOW);
         digitalWrite(pin, HIGH);
        Serial.println("the other led is ON");
      }
      if (strcmp(json_parsed["light"], "offf") == 0) {
        digitalWrite(pin2, HIGH);
        digitalWrite(pin, HIGH);
        Serial.println("the other LED is OFF");
      }

    }
  }
  Serial.print("closing connection. ");
}
