#include <SoftwareSerial.h>
#define _baudrate   9600  //注意!每個ESP8266鮑率不同，需測試
#define rxpin1      4
#define txpin1      5
SoftwareSerial debug( rxpin1, txpin1 ); // RX, TX
//*-- IoT Information
#define SSID "d-link"
#define PASS "0937261066"
#define IP "184.106.153.149" // ThingSpeak IP Address: 184.106.153.149
String APIKEY = "MV07GGR1TMOYXFV8";
// 使用 GET 傳送資料的格式
// GET /update?key=[O04PFPCLF34WHMNE]&field1=[DATA_1]&filed2=[DATA_2]...;
//String GET = "GET /update?key=" + APIKEY + "&field1=" + String((int)temp) + \
//                                  "&field2=" + String((int)humd);
String GET = "GET /update?key=" + APIKEY;  

void setup() {
    Serial.begin( _baudrate );
    debug.begin( _baudrate );
    sendDebug("AT");
    Loding("sent AT");
    connectWiFi();
}
void loop() {
    delay(10000);   // 60 second
    SentOnCloud( String(5), String(9) );
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
