/*
 *  This sketch demonstrates how to set up a simple HTTP-like server.
 *  伺服器會依使用者連線要求設定 GPIO 輸出
 *    http://server_ip/gpio/0 會設定 GPIO2 至低電位,
 *    http://server_ip/gpio/1 會設定 GPIO2 至高電位
 *  伺服器IP是 ESP8266 模組的IP 
 *  並且會顯示於Serial port 上.
 */

#include <ESP8266WiFi.h>

const char* ssid = "MA121";
const char* password = "11211121";

// 建立一個 instance
// 並指定listen的埠(port)
WiFiServer server(80);

void setup() {
  Serial.begin(115200);
  delay(10);

  // 將 GPIO2 設為輸出，並指定為0(低電位)
  pinMode(2, OUTPUT);
  digitalWrite(2, 0);
  
  // server 連線 WiFi
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  
  WiFi.begin(ssid, password);
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
  
  // 啟動伺服器 (server)
  server.begin();
  Serial.println("Server started");

  // 顯示出 IP 位址
  Serial.println(WiFi.localIP());
}

void loop() {
  // 檢查是否有 client 已連線
  // 當函數return時client object被破壞時client會中斷連線
  WiFiClient client = server.available();
  if (!client) {
    return;
  }
  
  // 等待 client 傳送一些request資料
  Serial.println("new client");
  while(!client.available()){
    delay(1);
  }
  
  // 讀取client傳送 request的第一行資料
  String req = client.readStringUntil('\r');
  Serial.println(req);
  client.flush();
  
  // 利用 request 資料控制 val 值
  int val=0;
  if (req.indexOf("/gpio/0") != -1)
    val = 0;
  else if (req.indexOf("/gpio/1") != -1)
    val = 1;
  else {
    Serial.println("invalid request");
    client.stop();  //中斷連線
    return;
  }

  // 依 request設定 GPIO2 可接LED顯示
  digitalWrite(2, val);
  
  client.flush();

  // 預備 response 內容
  String s = "HTTP/1.1 200 OK\r\nContent-Type: text/html\r\n\r\n<!DOCTYPE HTML>\r\n<html>\r\nGPIO is now ";
  s += (val)?"high":"low";
  s += "</html>\n";

  // 傳送 response 給用戶
  client.print(s);
  delay(1);
  Serial.println("Client disonnected");
}

