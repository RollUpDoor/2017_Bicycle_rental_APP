#include <SoftwareSerial.h>
#include "DHT.h"

#define _baudrate   115200  //注意!每個ESP8266鮑率不同，需測試
#define rxpin1      4
#define txpin1      5
SoftwareSerial debug( rxpin1, txpin1 ); // RX, TX

//=============以下為DHT11========================
#define DHTPIN 2     // what digital pin we're connected to

// Uncomment whatever type you're using!
#define DHTTYPE DHT11   // DHT 11
//#define DHTTYPE DHT22   // DHT 22  (AM2302), AM2321
//#define DHTTYPE DHT21   // DHT 21 (AM2301)

// Connect pin 1 (on the left) of the sensor to +5V
// NOTE: If using a board with 3.3V logic like an Arduino Due connect pin 1
// to 3.3V instead of 5V!
// Connect pin 2 of the sensor to whatever your DHTPIN is
// Connect pin 4 (on the right) of the sensor to GROUND
// Connect a 10K resistor from pin 2 (data) to pin 1 (power) of the sensor

// Initialize DHT sensor.
// Note that older versions of this library took an optional third parameter to
// tweak the timings for faster processors.  This parameter is no longer needed
// as the current DHT reading algorithm adjusts itself to work on faster procs.
DHT dht(DHTPIN, DHTTYPE);
//=============以上為DHT11========================

//*-- IoT Information
#define SSID "CHT7050"
#define PASS "055372408"
#define IP "184.106.153.149" // ThingSpeak IP Address: 184.106.153.149
String APIKEY = "FF8NXJBAHSE4Y8DM";
int temp = 30;
int humd  = 50;


// 使用 GET 傳送資料的格式
// GET /update?key=[O04PFPCLF34WHMNE]&field1=[DATA_1]&filed2=[DATA_2]...;
//String GET = "GET /update?key=" + APIKEY + "&field1=" + String((int)temp) + \
//                                  "&field2=" + String((int)humd);
String GET = "GET /update?key=" + APIKEY;  

void setup() {
    Serial.begin( _baudrate );
    debug.begin( _baudrate );
//=============以下為DHT11========================
  Serial.println("DHTxx test!");
  dht.begin();
 //=============以上為DHT11========================    
    sendDebug("AT");
    Loding("sent AT");
    connectWiFi();
}
void loop() {
    delay(10000);   // 60 second
     //=============以下為DHT11========================
  // Reading temperature or humidity takes about 250 milliseconds!
  // Sensor readings may also be up to 2 seconds 'old' (its a very slow sensor)
  float h = dht.readHumidity();
  // Read temperature as Celsius (the default)
  float t = dht.readTemperature();
  // Read temperature as Fahrenheit (isFahrenheit = true)
  float f = dht.readTemperature(true);

  // Check if any reads failed and exit early (to try again).
  if (isnan(h) || isnan(t) || isnan(f)) {
    Serial.println("Failed to read from DHT sensor!");
    return;
  }
    SentOnCloud( String(t), String(h) );
}
boolean connectWiFi()
{
    debug.println("AT+CWMODE=1");
    Wifi_connect();
}

//以下函數傳送温濕度至 ThingSpeak
void SentOnCloud( String T, String H )
{
    // 設定 ESP8266 作為 Client 端
    //AT+CIPSTART:建立TCP/UDP連接
    //AT+CIPSTART="TCP","184.106.153.149,80" (ThingSpeak IP位址)
    String cmd = "AT+CIPSTART=\"TCP\",\"";  
    cmd += IP;                              
    cmd += "\",80";                         
    sendDebug(cmd);                         //透過softSerial傳送AT命令
    if( debug.find( "Error" ) )
    {
        Serial.print( "RECEIVED: Error\nExit1" );
        return;
    }
    // 傳送數據至ThingSpeak
    //AT+CIPSEND=<length>：發送數據
    //GET /update?key=FF8NXJBAHSE4Y8DM&field1=T&field2=H\r\n"
    cmd = GET + "&field1=" + T + "&field2=" + H +"\r\n";  
    debug.print( "AT+CIPSEND=" );         
    debug.println( cmd.length() );        
    //模組收到指令后先換行傳回”>”，然后開始接收串列埠資料，當資料長度滿length時傳送資料
    if(debug.find( ">" ) )
    {
        Serial.print(">");
        Serial.print(cmd);
        debug.print(cmd);
    }
    else
    {
        debug.print( "AT+CIPCLOSE" );   //關閉TCP/UDP連線
    }
    if( debug.find("OK") )
    {
        Serial.println( "RECEIVED: OK" );
    }
    else
    {
        Serial.println( "RECEIVED: Error\nExit2" );
    }
}
void Wifi_connect()
{
    //加入AP
    //AT+CWJAP=SSID,PASS
    String cmd="AT+CWJAP=\"";
    cmd+=SSID;
    cmd+="\",\"";
    cmd+=PASS;
    cmd+="\"";
    sendDebug(cmd);
    Loding("Wifi_connect");
}
void Loding(String state){
    for (int timeout=0 ; timeout<10 ; timeout++)
    {
      if(debug.find("OK"))
      {
          Serial.println("RECEIVED: OK");
          break;
      }
      else if(timeout==9){
        Serial.print( state );
        Serial.println(" fail...\nExit2");
      }
      else
      {
        Serial.print("Wifi Loading...");
        delay(500);
      }
    }
}
void sendDebug(String cmd)
{
    Serial.print("SEND: ");
    Serial.println(cmd);
    debug.println(cmd);
} 
