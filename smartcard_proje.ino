#include <SPI.h>                  
#include <MFRC522.h>                 
#include <WiFi.h>
#include <PubSubClient.h>
#include <Wire.h>
/////////////////
WiFiClient espClient;
PubSubClient client(espClient);
////////////////////////////////////////////////////
const char* ssid = "Rocketman";
const char* password = "By.yasin4141";
const char* mqtt_server = "192.168.43.2";
char msg[150];//BUFFER
///////////////////////////////////////////////////
int RST_PIN = 22;                          
int SS_PIN = 21;                          
int alert_pin=5;//onay led
int alert_pin2=17;//onay led
const int ledPin = 2;
MFRC522 rfid(SS_PIN, RST_PIN);           
/////////////////////////////////////////////////////
void setup() { 
  Serial.begin(115200);                    
  SPI.begin();                        
  rfid.PCD_Init(); 
  setup_wifi();
  client.setServer(mqtt_server, 4141);
  client.setCallback(callback);
  pinMode(ledPin, OUTPUT);
  pinMode(alert_pin, OUTPUT);
  pinMode(alert_pin2, OUTPUT);
  pinMode(4,OUTPUT);//buzzer
 
}
///////////////////////////////////////////////
void setup_wifi() {
  delay(10);
  // We start by connecting to a WiFi network
  Serial.println();
  Serial.print("Baglanılıyor ... =>  ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi Bağlandı.");
  Serial.println("IP Adresi: ");
  Serial.println(WiFi.localIP());
}
//////////////////////////////////////////
void callback(char* topic, byte* message, unsigned int length) {
    String messageTemp;
  
   for (int i = 0; i < length; i++) {
    //Serial.print((char)message[i]);
    messageTemp += (char)message[i];
  }
  if (messageTemp=="0"){
    Serial.println("Bakiye Yetersiz! ");
    digitalWrite(alert_pin2,HIGH);
    digitalWrite(4, HIGH);
    delay(750);
    digitalWrite(4, LOW);
    delay(250);
    digitalWrite(alert_pin2,LOW);
    
    }else if(messageTemp=="-1"){
        Serial.println("Tanımsız Kart! ");
      digitalWrite(alert_pin2,HIGH);
    digitalWrite(4, HIGH);
    delay(750);
    digitalWrite(4, LOW);
    delay(250);
    digitalWrite(alert_pin2,LOW);
      }
    else{
       Serial.print("Kalan Bakiye => ");
       Serial.println(messageTemp);
       digitalWrite(alert_pin,HIGH);
       digitalWrite(4, HIGH);
       delay(150);
       digitalWrite(4, LOW);
       delay(150);
       digitalWrite(4, HIGH);
       delay(150);
       digitalWrite(4, LOW);
       delay(1000);
       digitalWrite(alert_pin,LOW);
      }
}
///////////////////////////////////
void reconnect() {//yeniden bağlanılıyor
 
  while (!client.connected()) {
    Serial.print("MQTT Sunucusuna yeniden bağlanılıyor...");
    // Attempt to connect
    if (client.connect("esp32Istemcisi")) {
      Serial.println("Bağlandı.");
     
      client.subscribe("GeriBesleme"); // Subscribe OL
    } else {
      Serial.print("Hata, rc=");
      Serial.print(client.state());
      Serial.println(" 5 saniye sonra yeniden deneyecek...");
      delay(5000);
    }
  }
}
////////////////////////////////////////////
void loop() {
  if (!client.connected()) {//mqtt reconnect
  reconnect();
  }
  client.loop();
   SPI.begin();                            //SPI
  rfid.PCD_Init(); 
  String kartId="";
  
  if ( ! rfid.PICC_IsNewCardPresent())    //Yeni kartın okunmasını bekliyoruz.
    return;
  if ( ! rfid.PICC_ReadCardSerial())      //Kart okunmadığı zaman bekliyoruz.
    return;
  //kart Okutuldugunda gerçekleşecek oalaylar//

   for(int i=0;i<4;i++){
    kartId+=rfid.uid.uidByte[i];
   }
   Serial.print("Okutulan Kart Id =>");
   Serial.println(kartId);
   kartId.toCharArray(msg, 50) ;
   client.publish("KartBilgileri",  msg);
   rfid.PICC_HaltA();
   delay(1000);
} 
