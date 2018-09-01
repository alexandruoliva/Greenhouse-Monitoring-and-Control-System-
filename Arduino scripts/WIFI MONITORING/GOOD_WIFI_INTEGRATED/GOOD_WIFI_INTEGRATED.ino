
#include <LCD.h>
#include <LiquidCrystal.h>
#include <LiquidCrystal_I2C.h>


#include <LiquidCrystal.h>

#include <ESP8266WiFi.h>

#include <SPI.h>

#include <Wire.h>
#include <Adafruit_Sensor.h>
#include "Adafruit_TSL2591.h"
#include <dht.h>


LiquidCrystal_I2C lcd(0x27, 2, 1, 0, 4, 5, 6, 7);

dht DHT;
#define DHT22_PIN 13
//TSL 2591 sensor
float light;


Adafruit_TSL2591 tsl = Adafruit_TSL2591(2591);


//router
const char* ssid = "iPhoneAlex";
const char* password = "oliolioli";
//sensor configuration
void configureSensor(void)
{

  tsl.setGain(TSL2591_GAIN_MED);

  tsl.setTiming(TSL2591_INTEGRATIONTIME_300MS);



  Serial.println(F("---------------------------------"));
  Serial.print  (F("Gain:         "));
  tsl2591Gain_t gain = tsl.getGain();
  switch (gain)
  {

    case TSL2591_GAIN_MED:
      Serial.println(F("25x (Medium)"));
      break;

  }

}



byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
//192.168.1.121
//arduino ip de la camin 192.168.1.177
byte ip[] = {172, 20, 10, 10  };
//ip hotspot pentru telefon {172, 20, 10, 10 };
//the arduino IP

//IPAddress ip(192,168,1,177);



//declaring the soil moisture variable
//const int value = A0;
float moist;
//char serv[] = "192.168.116";//server's ip
const char* server = "172.20.10.4";
//const char* server = "172.20.10.4"; telefon
//
//de la telefon server const char* server = "172.20.10.4";
// byte serv[] = {192, 168, 1, 120} ; de la camin

//120 acum 116 inainte
WiFiClient client;





void setup() {

  //lcd
  lcd.begin (16, 2);
  lcd.setBacklightPin(3, POSITIVE);
  lcd.setBacklight(HIGH);
  Serial.begin(9600);
  //
  Serial.begin(9600); //setting the baud rate at 9600
  //  dht.begin();
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);

  Serial.println();
  Serial.println();
  Serial.print("Connecting to the network: ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".....");
  }
  Serial.println("");
  Serial.println("You are connected to WIFI");
  lcd.println("Connected to WIFI");




  configureSensor();
}

void unifiedSensorAPIRead(void)
{

  sensors_event_t event;
  tsl.getEvent(&event);



  if ((event.light == 0) |
      (event.light > 4294966000.0) |
      (event.light < -4294966000.0))
  {

    Serial.println(F("Invalid data "));
  }
  else
  {

    light = event.light;
  }
}


void loop() {


  //soil moisture
  // Reading the analog value
  moist = analogRead(A0);
  //dht 22 nou

  uint32_t start = micros();
  int chk = DHT.read22(DHT22_PIN);
  uint32_t stop = micros();



  float hum = DHT.humidity;
  float temp = DHT.temperature;

  Serial.println();
  Serial.print("Temperature[C]: ");
  Serial.println(temp);
  Serial.print("Air humidity[RH]: ");
  Serial.println(temp);
  //



  moist = constrain(moist, 400, 1023); //  Ranges of the value
  moist = map(moist, 650, 1023, 100, 0); // Map value : 400 will be 100 and 1023 will be 0
  if (moist > 99) {
    moist = 100;
  }
  Serial.print("Soil moisture[%]: ");
  Serial.print(moist);
  unifiedSensorAPIRead();
  Serial.print("Ambiental light[lx]=");
  light = light * 10;
  Serial.println(light);


  Serial.println("<--------------->");

  //print pe lcd


  
  lcd.clear();


  lcd.setCursor(0, 0);
  lcd.print("C:");
  lcd.print(temp);
  lcd.setCursor(0, 1);
  lcd.print("RH:");
  lcd.print(hum);
  lcd.setCursor(6, 0);
  lcd.print("LX");
  lcd.print(light);
  lcd.setCursor(9, 1);
  lcd.print("%:");
  lcd.print(moist);






  if (client.connect(server, 80)) { //Connecting at the IP address and port we saved before
    Serial.println("You are connnected to the SERVER");

    client.print("GET /arduino/data.php?"); //Connecting and Sending values to database trought the HTTP GET REQUEST
    Serial.println("REQUEST HAS BEEN MADE" ) ;

    //sending the light
    client.print("light=");
    client.print(light);
    client.print("&temperature=");
    client.print(temp);
    client.print("&humidity=");
    client.print(hum);
    client.print("&moist=");
    //it doesn't work if the last ine is "client.print"
    client.println(moist);
    //client.println(" HTTP/1.1");
    //Printing the values on the serial monitor
    Serial.print("Temperature= ");
    Serial.println(temp);
    Serial.print("Humidity= ");
    Serial.println(hum);

    Serial.print("Soil Moisture = " );
    Serial.println(moist);
    Serial.print("light=");
    Serial.print(light);

    client.stop();
  }
  else {
    lcd.clear();
    lcd.print("Request");
    lcd.setCursor(0, 1);
    lcd.print("failed! ");
    Serial.println("connection failed");
  }
  delay(5000);//delay of 5 mins
}
