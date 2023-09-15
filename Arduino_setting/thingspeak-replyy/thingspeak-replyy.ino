#include <SPI.h>
#include <WiFi.h>

char ssid[] = "MA121";      //  your network SSID (name) 
char pass[] = "11211121";   // your network password
int keyIndex = 0;            // your network key Index number (needed only for WEP)
String READAPIKEY  = "0MGF9UUHWLKY7IHE";
String channel_id  = "275999";
String field_id    = "1";

int status = WL_IDLE_STATUS;

// Initialize the Wifi client library
WiFiClient client;

// server address:
char server[] = "api.thingspeak.com";

void printWifiStatus() {
  // print the SSID of the network you're attached to:
  Serial.print("SSID: ");
  Serial.println(WiFi.SSID());

  // print your WiFi shield's IP address:
  IPAddress ip = WiFi.localIP();
  Serial.print("IP Address: ");
  Serial.println(ip);

  // print the received signal strength:
  long rssi = WiFi.RSSI();
  Serial.print("signal strength (RSSI):");
  Serial.print(rssi);
  Serial.println(" dBm");
}

void setup() {
  // put your setup code here, to run once:
  // start serial port:
  Serial.begin(9600);
 
// attempt to connect to Wifi network:
  while ( status != WL_CONNECTED) { 
    Serial.print("Attempting to connect to SSID: ");
    Serial.println(ssid);
    // Connect to WPA/WPA2 network. Change this line if using open or WEP network:    
    status = WiFi.begin(ssid, pass);

    // wait 10 seconds for connection:
    delay(10000);
  } 
  // you're connected now, so print out the status:
  printWifiStatus();
}

void loop() {
  // put your main code here, to run repeatedly:

   // if there's a successful connection:
  if (client.connect(server, 80)) {
    Serial.println("Updateing...");
   //以下為GET方法
       String GET = "GET /channels/" + String(channel_id) + "/fields/" + String(field_id) + ".json?key=" +
                     READAPIKEY + "&results=1";

        Serial.println( "**-- Get a Channel Fields Feed --**" );
        String getStr = GET + " HTTP/1.1\r\n";
        Serial.println(getStr);
        client.print( getStr );
        client.print( "Host: api.thingspeak.com\n" );
        client.print( "Connection: keep-alive\r\n\r\n" );
        
        delay(1000);
        // 讀取所有從 ThingSpeak IoT Server 的回應並輸出到串列埠
        while(client.available())
        {
            String line = client.readStringUntil('\r');
            Serial.println(line);
        }
    client.stop();
    //以上為GET方法*/
  }

  delay(10000);
}
