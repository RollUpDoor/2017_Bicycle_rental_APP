

#include <SoftwareSerial.h>

#define _baudrate   9600
#define _rxpin      4
#define _txpin      5
SoftwareSerial debug( _rxpin, _txpin ); // RX, TX
//*-- IoT Information
#define SSID "VML"
#define PASS "mslu5129"
#define IP "" // ThingSpeak IP Address: 184.106.153.149
// 使用 GET 傳送資料的格式
// GET /update?key=[THINGSPEAK_KEY]&field1=[data 1]&filed2=[data 2]...;
String GET = "GET //";//網頁位置

/*重量感測器*/
 //定義接角 10接時鐘線 9接數據線

void setup() {
    Serial.begin( _baudrate );
    debug.begin( _baudrate );
    sendDebug("AT");
    Loding("sent AT");
    connectWiFi();
}
void loop() {
    delay(5000);   //5s



  
    SentOnCloud( buffer[i]);  
    SentOnCloud( buffer1[i]); 
}
boolean connectWiFi()
{
    debug.println("AT+CWMODE=1");
    Wifi_connect();
}

void SentOnCloud( double T)
{
    // 設定 ESP8266 作為 Client 端
    String cmd = "AT+CIPSTART=\"TCP\",\"";
    cmd += IP;
    cmd += "\",80";
    sendDebug(cmd);
    if( debug.find( "Error" ) )
    {
        Serial.print( "RECEIVED: Error\nExit1" );
        return;
    }
    cmd = GET + "?field1=" + T +"\r\n";
    debug.print( "AT+CIPSEND=" );
    debug.println( cmd.length() );
    if(debug.find( ">" ) )
    {
        Serial.print(">");
        Serial.print(cmd);
        debug.print(cmd);
    }
    else
    {
        debug.print( "AT+CIPCLOSE" );
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
