
#include <SPI.h>
#include <Ethernet.h>
#include <Wire.h>
#include <Adafruit_Sensor.h>
#include "Adafruit_TSL2591.h"
#include "DHT.h"


#define DHTPIN 7
#define DHTTYPE DHT22
//TSL 2591 sensor
float light;

Adafruit_TSL2591 tsl = Adafruit_TSL2591(2591); 

//sensor configuration
void configureSensor(void)
{
 
  tsl.setGain(TSL2591_GAIN_MED);     
  
  tsl.setTiming(TSL2591_INTEGRATIONTIME_300MS);
  

  
  Serial.println(F("---------------------------------"));
  Serial.print  (F("Gain:         "));
  tsl2591Gain_t gain = tsl.getGain();
  switch(gain)
  {
    
    case TSL2591_GAIN_MED:
      Serial.println(F("25x (Medium)"));
      break;
    
  }
  
}



DHT dht(DHTPIN, DHTTYPE);
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
//192.168.1.121
byte ip[] = {192, 168, 1, 177 };
//the arduino IP
//IPAddress ip(192,168,1,177);



//declaring the soil moisture variable
const int value = A1;
float moist;
//char serv[] = "192.168.1.116";//server's ip
byte serv[] = {192, 168, 1, 120} ; //Read the code explanation below

//120 acum 116 inainte
EthernetClient client;

void setup() {
  Serial.begin(9600); //setting the baud rate at 9600
  Ethernet.begin(mac, ip);
  dht.begin();

  
  
  

  configureSensor();
}

void unifiedSensorAPIRead(void)
{
 
  sensors_event_t event;
  tsl.getEvent(&event);
 
  
  
  if ((event.light == 0) |
      (event.light > 4294966000.0) | 
      (event.light <-4294966000.0))
  {
  
    Serial.println(F("Invalid data "));
  }
  else
  {
    Serial.print(event.light); Serial.println(F(" lux"));
    light=event.light;
  }
}


void loop() {


  //soil moisture
  moist = analogRead(value);  // Reading the analog value
  moist = constrain(moist, 400, 1023); //  Ranges of the value
  moist = map(moist, 400, 1023, 100, 0); // Map value : 400 will be 100 and 1023 will be 0
  Serial.print("Soil moisture[%]: ");
  Serial.print(moist);
  Serial.println("%");
  unifiedSensorAPIRead();
  Serial.print("Ambiental light[lx]=");
  Serial.println(light);
  //temp and humidity
  float hum = dht.readHumidity(); //reading the humidity value (relative humidity)
  float temp = dht.readTemperature(); //reading the temperature value in celsius
  Serial.print(" Air temperature[C]= ");
  Serial.println(temp);
  Serial.print("Air humidity[RH]= ");
  Serial.println(hum);

  Serial.println("<--------------->");

  if (client.connect(serv, 80)) { //Connecting at the IP address and port we saved before
    Serial.println("You are connnected to the SERVER");

    client.print("GET /arduino/data.php?"); //Connecting and Sending values to database trought the HTTP GET REQUEST
    Serial.println(" GET HAS BEEN MADE" ) ;
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
    
    Serial.println("connection failed");
  }
  delay(60000 );//delay of 1 mins
}
