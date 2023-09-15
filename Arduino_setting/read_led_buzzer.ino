#include <SPI.h>
#include <MFRC522.h>

#define RST_PIN    A0     // Reset腳
#define SS_PIN     10     // 晶片選擇腳

MFRC522 mfrc522(SS_PIN, RST_PIN);    // 建立MFRC522物件

MFRC522::MIFARE_Key key;  // 儲存金鑰

byte sector = 15;   // 指定讀寫的「區段」，可能值:0~15
byte block = 1;     // 指定讀寫的「區塊」，可能值:0~3

byte sector2 = 15;   // 指定讀寫的「區段」，可能值:0~15
byte block2 = 2;     // 指定讀寫的「區塊」，可能值:0~3

int ledPin = 7; //第13隻接腳請連接到 LED，以便控制 LED 明滅
const int buzzer = 8; // 用Pin8 輸出方波至蜂鳴器




// 暫存讀取區塊內容的陣列，MIFARE_Read()方法要求至少要18位元組空間，來存放16位元組。
byte buffer[18];
byte buffer1[18];

MFRC522::StatusCode status;

void readBlock(byte _sector, byte _block, byte _blockData[])  {
  if (_sector < 0 || _sector > 15 || _block < 0 || _block > 3) {

    digitalWrite(ledPin, HIGH); // 設定PIN7腳位為高電位= 0V ，LED 處於發亮狀態!!
    tone(buzzer,500); //蜂鳴器吵鬧
    
    Serial.println(F("Wrong sector or block number.")); // 顯示「區段或區塊碼錯誤」，然後結束函式。
    
    delay(500); 
  
    noTone(buzzer);//蜂鳴器安靜
    digitalWrite(ledPin, LOW); // 設定PIN7腳位為低電位= 0V ，LED 處於熄滅狀態!!
    return;
  }

  byte blockNum = _sector * 4 + _block;  // 計算區塊的實際編號（0~63）
  byte trailerBlock = _sector * 4 + 3;   // 控制區塊編號

  // 驗證金鑰
  status = (MFRC522::StatusCode) mfrc522.PCD_Authenticate(MFRC522::PICC_CMD_MF_AUTH_KEY_A, trailerBlock, &key, &(mfrc522.uid));
  // 若未通過驗證…
  if (status != MFRC522::STATUS_OK) {
    
    digitalWrite(ledPin, HIGH); // 設定PIN7腳位為高電位= 0V ，LED 處於發亮狀態!!
    tone(buzzer,500); //蜂鳴器吵鬧
    
    //Serial.print(F("PCD_Authenticate() failed: "));// 顯示錯誤訊息
    //Serial.println(mfrc522.GetStatusCodeName(status));
    
    Serial.println("unknow guy"); //監控視窗出現兩次，可能原因為我寫入兩筆資*顯示一次???
    
    delay(500);
   
    noTone(buzzer); //蜂鳴器安靜
    digitalWrite(ledPin, LOW); // 設定PIN7腳位為低電位= 0V ，LED 處於熄滅狀態!!
    return;
  }

  byte buffersize = 18;
  status = (MFRC522::StatusCode) mfrc522.MIFARE_Read(blockNum, _blockData, &buffersize);

  // 若讀取不成功…
  if (status != MFRC522::STATUS_OK) {
    
    digitalWrite(ledPin, HIGH); // 設定PIN7腳位為高電位= 0V ，LED 處於發亮狀態!!
    tone(buzzer,500); //蜂鳴器吵鬧
   
    Serial.print(F("MIFARE_read() failed: ")); // 顯示錯誤訊息
    Serial.println(mfrc522.GetStatusCodeName(status));
    
    delay(500); 
    
    noTone(buzzer);//蜂鳴器安靜
    digitalWrite(ledPin, LOW); // 設定PIN7腳位為低電位= 0V ，LED 處於熄滅狀態!!
    return;
  }

  // 顯示「讀取成功！」
  Serial.println(F("Data was read."));
  tone(buzzer,2000); //蜂鳴器吵鬧
  delay(30); // (也就是發亮0.3 秒)
  noTone(buzzer);//蜂鳴器安靜
}

void setup() {

  pinMode(ledPin, OUTPUT); // 設定第 7 支腳為輸出模式LED
  pinMode(buzzer,OUTPUT); //蜂鳴器
  
  Serial.begin(9600);
  SPI.begin();       // 初始化SPI介面
  
  Serial.println(F("Please scan MIFARE Classic card..."));

  // 準備金鑰（用於key A和key B），出廠預設為6組 0xFF。
  for (byte i = 0; i < 6; i++) {
    key.keyByte[i] = 0xFF;
  }

}

void loop() {
  mfrc522.PCD_Init();        // 初始化MFRC522卡片，如果放到setup裡面只能執行一次

  // 查看是否感應到卡片
  if ( ! mfrc522.PICC_IsNewCardPresent()) {
    return;  // 退回loop迴圈的開頭
  }

  // 選取一張卡片
  if ( ! mfrc522.PICC_ReadCardSerial()) {  // 若傳回1，代表已讀取到卡片的ID
    return;
  }


  readBlock(sector, block, buffer);      // 區段編號、區塊編號、存放讀取資料的陣列
  readBlock(sector2, block2, buffer1);      // 區段編號、區塊編號、存放讀取資料的陣列

  Serial.print(F("Read block: "));        // 顯示儲存讀取資料的陣列元素值
  for (byte i = 0 ; i < 16 ; i++) {
    Serial.write (buffer[i]);
  }

   for (byte i = 0 ; i < 16 ; i++) {      //清除陣列儲存資料
    buffer[i]=0;
  }
  
  Serial.println();

  for (byte i = 0 ; i < 16 ; i++) {
    Serial.write (buffer1[i]);
  }

   for (byte i = 0 ; i < 16 ; i++) {
   buffer1[i]=0;
  }
  
  Serial.println();
  Serial.println();
  delay(500);
  
  // 令卡片進入停止狀態
  //mfrc522.PCD_StopCrypto1(); //這行也可以讓卡片連續讀取
  mfrc522.PICC_HaltA();
  
}
