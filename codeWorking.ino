#include <ESP8266WiFi.h>
#include <WiFiClient.h> 
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>

int Led_OnBoard = 2;                  // Initialize the Led_OnBoard 
const int motorPin = D0;              // relay Output pin
const char* ssid = "iPhone";      // Your wifi Name       
const char* password = "12345678";    // Your wifi Password 
const char *host = "172.20.10.7";  //Your pc or server (database) IP, if you are a windows os user, open cmd, then type ipconfig then look at IPv4 Address.

void setup() {
  // put your setup code here, to run once:
  delay(1000);
  pinMode(Led_OnBoard, OUTPUT);       // Initialize the Led_OnBoard pin as an output
  pinMode(motorPin, OUTPUT);          // Initialise the motor Pin as an output
  //digitalWrite(motorPin, LOW);        // keep motor off initally  
  Serial.begin(9600);
  WiFi.mode(WIFI_OFF);                //Prevents reconnection issue (taking too long to connect)
  delay(1000);
  WiFi.mode(WIFI_STA);                //This line hides the viewing of ESP as wifi hotspot
  WiFi.begin(ssid, password);         //Connect to your WiFi router
  Serial.println("");

  Serial.print("Connecting");
  // Wait for connection
  while (WiFi.status() != WL_CONNECTED) {
    digitalWrite(Led_OnBoard, LOW);
    delay(250);
    Serial.print(".");
    digitalWrite(Led_OnBoard, HIGH);
    delay(250);
  }

  digitalWrite(Led_OnBoard, HIGH);
  //If connection successful show IP address in serial monitor
  Serial.println("");
  Serial.println("Connected to Network/SSID");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());  //IP address assigned to your ESP
}

void loop() {
  // put your main code here, to run repeatedly:
  HTTPClient http;                                                        //Declare object of class HTTPClient
 
  String mValueSend, postData,motor;
  int rvalue=analogRead(A0);                                              //Read Analog value of Moisture Sensor
  mValueSend = String(rvalue);                                            //String to interger conversion

  if(rvalue >= 700){
    digitalWrite(motorPin, HIGH);                                         // turn ON motor (high value, low moisture)
    motor = "ON";
  }
  else{
    digitalWrite(motorPin, LOW);                                          // turn OFF motor (low value, High moisture)
    motor = "OFF";
  }
  postData = "svalue="+mValueSend;                                      //Post Data (moisture sensor value)
  
  http.begin("http://172.20.10.7/iot/InsertDB.php");                   //Specify request destination
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");    //Specify content-type header
  int httpCode = http.POST(postData);                                     //Send the request
  String payload = http.getString();                                      //Get the response payload

  
  Serial.println(httpCode);                                               //Print HTTP return code
  Serial.println(payload);                                                //Print request response payload
  
  Serial.println("Moisture Value=" + mValueSend);
  Serial.println("Motor Status=" + motor);
  
  http.end();  //Close connection

  delay(4000);  //Here there is 4 seconds delay plus 1 second delay below, so Post Data at every 5 seconds
  digitalWrite(Led_OnBoard, LOW);
  delay(1000);
  digitalWrite(Led_OnBoard, HIGH);
}
