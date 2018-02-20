#include <ESP8266WiFi.h>

#define echoPin 2 // Echo Pin
#define trigPin 0 // Trigger Pin

const char* ssid = "LakshmiNelayam"; //replace this with your WiFi network name
const char* password = "Mannem0123"; //replace this with your WiFi network password
IPAddress ip(192,168,0,123);
IPAddress gt(192,168,0,1);
IPAddress sb(255,255,255,0);
long duration, distance; // Duration used to calculate distance
long bindepth=1;
void setup()
{
  pinMode(LED_BUILTIN, OUTPUT);
  Serial.begin(115200);
  WiFi.begin(ssid, password);
  //WiFi.config(ip,gt,sb);

  Serial.println();
  Serial.print("Connecting");
  while (WiFi.status() != WL_CONNECTED)
  {
    delay(500);
    Serial.print(".");
  }
  WiFi.config(ip,gt,sb);
  Serial.println("success!");
  Serial.print("IP Address is: ");
  Serial.println(WiFi.localIP());
pinMode(trigPin, OUTPUT);
pinMode(echoPin, INPUT);
Serial.println("esp-ultrasoonsensor2017.ino");
delay(10000);
bindepth=level()+1;
}

const char* hostGet = "apple.heliohost.org"; 


void postData(String id,float per) {

   WiFiClient clientGet;
   const int httpGetPort = 80;
   //the path and file to send the data to:
   String urlGet = "/uploadcvr.php?id="+id+"&percentage="+per;
   Serial.println(urlGet);
      Serial.print(">>> Pushing data to: ");
      Serial.println(hostGet);
      
       if (!clientGet.connect(hostGet, httpGetPort)) {
        Serial.print("Connection failed: ");
        Serial.print(hostGet);
      } else {
          clientGet.println("GET " + urlGet + " HTTP/1.1");
          clientGet.print("Host: ");
          clientGet.println(hostGet);
          clientGet.println("User-Agent: ESP8266/1.0");
          clientGet.println("Connection: close\r\n\r\n");
          
          unsigned long timeoutP = millis();
          while (clientGet.available() == 0) {
            
            if (millis() - timeoutP > 20000) {
              Serial.print(">>> Client Timeout: ");
              Serial.println(hostGet);
              clientGet.stop();
              return;
            }
          }

          //just checks the 1st line of the server response. Could be expanded if needed.
          while(clientGet.available()){
            String retLine = clientGet.readStringUntil('\r');
            Serial.println(retLine);
            break; 
          }

      } //end client connection if else
                        
      Serial.print(">>> Closing host: ");
      Serial.println(hostGet);
          
      clientGet.stop();

}
 
float level()
{
/* The following trigPin/echoPin cycle is used to determine the
distance of the nearest object by bouncing soundwaves off of it. */
digitalWrite(trigPin, LOW);
delayMicroseconds(2);
digitalWrite(trigPin, HIGH);
delayMicroseconds(10);
digitalWrite(trigPin, LOW);
duration = pulseIn(echoPin, HIGH);
//Calculate the distance (in cm) based on the speed of sound.
distance = duration/58.2;
Serial.println(distance);
return distance;
//Delay 50ms before next reading.
}
void loop()
{  
  
  float val=level();
  postData("CSE",100-(val*100)/bindepth);
  delay(25000);
}


