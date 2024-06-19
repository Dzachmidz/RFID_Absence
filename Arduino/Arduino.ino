#include <SPI.h>
#include <MFRC522.h>
#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>

// Network SSID
const char* ssid = "OPPOF5";
const char* password = "13012003";

// Pengenal host (server) = IP Address komputer server di jaringan WiFi
const char* host = "192.168.57.33";  // Update dengan IP Address dari WiFi adapter komputer Anda

#define LED_PIN 15 // D8
#define BTN_PIN 5  // D1

//sediakan variabel untuk RFID
#define SDA_PIN 2 //D4
#define RST_PIN 0 //D3

MFRC522 mfrc522(SDA_PIN, RST_PIN);

void setup() {
  Serial.begin(9600);

  // Setting koneksi WiFi
  WiFi.hostname("NodeMCU");
  WiFi.begin(ssid, password);

  // Cek koneksi WiFi
  while (WiFi.status() != WL_CONNECTED) {
    // Progress sedang mencari WiFi
    delay(500);
    Serial.print(".");
  }

  Serial.println("\nWiFi Connected");
  Serial.println("IP Address: ");
  Serial.println(WiFi.localIP());

  pinMode(LED_PIN, OUTPUT);
  pinMode(BTN_PIN, INPUT); // Ubah ke INPUT karena BTN_PIN harus dibaca

  SPI.begin();
  mfrc522.PCD_Init();
  Serial.println("Dekatkan Kartu RFID Anda ke Reader");
  Serial.println();
}

void loop() {
  // Baca status pin button kemudian uji
  if (digitalRead(BTN_PIN) == HIGH) { // Ditekan
    // Nyalakan lampu LED
    digitalWrite(LED_PIN, HIGH);
    while (digitalRead(BTN_PIN) == HIGH); // Menahan proses sampai tombol dilepas

    // Ubah mode absensi di aplikasi web
    String Link = "http://192.168.57.33/absensi/ubahmode.php";
    HTTPClient http;
    WiFiClient client;

    Serial.println("Mengirim permintaan ke: " + Link);

    // Gunakan WiFiClient dalam pemanggilan begin
    http.begin(client, Link);

    int httpCode = http.GET();
    if (httpCode > 0) {
      // Jika httpCode lebih besar dari 0, berarti request terkirim
      String payload = http.getString();
      Serial.println("Response: " + payload);
      Serial.println("Berhasil mengakses link.");
    } else {
      // Jika httpCode kurang atau sama dengan 0, berarti ada kesalahan
      Serial.println("Gagal mengakses link.");
      Serial.printf("Error code: %d\n", httpCode);
      Serial.println(http.errorToString(httpCode).c_str());
    }
    http.end();
  }

  // Matikan lampu LED
  digitalWrite(LED_PIN, LOW);
  delay(100); // Tambahkan sedikit delay untuk menghindari debounce

  if (!mfrc522.PICC_IsNewCardPresent())
    return;

  if (!mfrc522.PICC_ReadCardSerial())
    return;

  // Tambahkan pesan debugging untuk melihat ukuran UID
  Serial.print("UID Size: ");
  Serial.println(mfrc522.uid.size);

  String IDTAG = "";
  for (byte i = 0; i < mfrc522.uid.size; i++) {
    IDTAG += String(mfrc522.uid.uidByte[i], HEX);
  }

  // Tambahkan pesan debugging untuk melihat UID yang terbaca
  Serial.print("IDTAG: ");
  Serial.println(IDTAG);

  // Nyalakan lampu LED
  digitalWrite(LED_PIN, HIGH);
  delay(1000);

  // Kirim nomor kartu RFID untuk disimpan ke tabel tmprfid
  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("Connection Failed");
    return;
  }

  // Pastikan URL request GET sudah benar
  String Link = "http://192.168.57.33/absensi/kirimkartu.php?nokartu=" + IDTAG;
  HTTPClient http;
  http.begin(client, Link);

  int httpCode = http.GET();
  if (httpCode > 0) {
    String payload = http.getString();
    Serial.println(payload);
  } else {
    Serial.println("Gagal mengirim kartu RFID.");
    Serial.printf("Error code: %d\n", httpCode);
    Serial.println(http.errorToString(httpCode).c_str());
  }
  http.end();
}
