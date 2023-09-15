/*
 Basic MQTT example

 This sketch demonstrates the basic capabilities of the library.
 It connects to an MQTT server then:
  - publishes "hello world" to the topic "outTopic"
  - subscribes to the topic "inTopic", printing out any messages
    it receives. NB - it assumes the received payloads are strings not binary

 It will reconnect to the server if the connection is lost using a blocking
 reconnect function. See the 'mqtt_reconnect_nonblocking' example for how to
 achieve the same result without blocking the main loop.
 
*/

#include <WiFi.h>
#include <PubSubClient.h>

// Update these with values suitable for your network.

char ssid[] = "MA121";     // 所使用之網路名稱
char pass[] = "11211121";  // MA121網路的密碼
int status  = WL_IDLE_STATUS;    // the Wifi radio's status

char mqttServer[]     = "iot.eclipse.org";
char clientId[]       = "B10321136";
char publishTopic[]   = "B10321136";   
char publishPayload[] = "hello world";
char subscribeTopic[] = "B10321136";  //以上為MQTT的設定

void callback(char* topic, byte* payload, unsigned int length) {
  Serial.print("Message arrived [");
  Serial.print(topic);
  Serial.print("] ");
  for (int i=0;i<length;i++) {
    Serial.print((char)payload[i]);
  }
  Serial.println();
}

WiFiClient wifiClient;     // 建立wifi前端物件
PubSubClient client(wifiClient);   // 基於wifi物件，建立MQTT前端物件

void reconnect() {     //MQTT伺服器的reconnect()自訂函式。
  // 若目前沒有和伺服器相接，則反覆執行直到連結成功。
  while (!client.connected()) {
    Serial.print("Attempting MQTT connection..."); //監控視窗顯示的內容
    // Attempt to connect
    if (client.connect(clientId)) {  // 指定用戶端ID並連結MQTT伺服器
      Serial.println("connected");   // 若連結成功，在序列埠監控視窗顯示「已連線」
    
      client.publish(publishTopic, publishPayload);
      // ... and resubscribe
      client.subscribe(subscribeTopic);
    } else {      // 若連線不成功，則顯示錯誤訊息
      Serial.print("failed, rc=");
      Serial.print(client.state());
      Serial.println(" try again in 5 seconds");
     
      delay(5000);     // 等候5秒，再重新嘗試連線。
    }
  }
}

void setup()
{
  Serial.begin(38400);

  while (status != WL_CONNECTED) {
    Serial.print("Attempting to connect to SSID: ");
    Serial.println(ssid);
    // Connect to WPA/WPA2 network. Change this line if using open or WEP network:
    status = WiFi.begin(ssid, pass);

    
    delay(10000);  //等待連線時間
  }

  client.setServer(mqttServer, 1883); //設定MQTT代理人的網址和埠號
  client.setCallback(callback);

  // Allow the hardware to sort itself out
  delay(1500); //留點時間給網路進行初始化
}

void loop()
{
  if (!client.connected()) {    // 確認用戶端是否已連上伺服器
    reconnect();             // 若沒有連上，則執行此自訂函式。
  }
  client.loop();            // 更新用戶端狀態
}
