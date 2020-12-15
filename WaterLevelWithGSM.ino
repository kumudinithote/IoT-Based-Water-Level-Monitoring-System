#include<SoftwareSerial.h>
SoftwareSerial client(5,6); //RX and TX for wifi module
SoftwareSerial mySerial(8, 7);  //RX and TX for gsm module
const int trigPin = 9;
const int echoPin = 10;
long duration;
int distance;
int distance2;
String webpage="";
int i=0,k=0;
String readString;
int x=0;

boolean No_IP=false;
String IP="";
char temp1='0';

String name="<p>Data</p>";   //22
String dat="<p>Data Received Successfully.....</p>";     

void check4IP(int t1)
{
  int t2=millis();
  while(t2+t1>millis())
  {
    while(client.available()>0)
    {
      if(client.find("WIFI GOT IP"))
      {
        No_IP=true;
      }
    }
  }
}

void get_ip()
{
  IP="";
  char ch=0;
  while(1)
  {
    client.println("AT+CIFSR");
    while(client.available()>0)
    {
      if(client.find("STAIP,"))
      {
        delay(1000);
        Serial.print("IP Address:");
        while(client.available()>0)
        {
          ch=client.read();
          if(ch=='+')
          break;
          IP+=ch;
        }
      }
      if(ch=='+')
      break;
    }
    if(ch=='+')
    break;
    delay(1000);
  }
  Serial.print(IP);
  Serial.print("Port:");
  Serial.println(80);
}

void connect_wifi(String cmd, int t)
{
  int temp=0,i=0;
  while(1)
  {
    Serial.println(cmd);
    client.println(cmd);
    while(client.available())
    {
      if(client.find("OK"))
      i=8;
    }
    delay(t);
    if(i>5)
    break;
    i++;
  }
  if(i==8)
  Serial.println("OK");
  else
  Serial.println("Error");
}

void wifi_init()
{
      connect_wifi("AT",100);
      connect_wifi("AT+CWMODE=3",100);
      connect_wifi("AT+CWQAP",100);
      connect_wifi("AT+RST",1000);
      check4IP(5000);
      if(!No_IP)
      {
        Serial.println("Connecting Wifi....");
        connect_wifi("AT+CWJAP=\"username\",\"password\"",700);         //provide your WiFi username and password here
      }
      else
        {
        }
      Serial.println("Wifi Connected");
      get_ip();
      connect_wifi("AT+CIPMUX=1",100);
      connect_wifi("AT+CIPSERVER=1,80",100);
}

void sendwebdata(String webPage)
{
    int ii=0;
     while(1)
     {
      unsigned int l=webPage.length();
      Serial.print("AT+CIPSEND=0,");
      client.print("AT+CIPSEND=0,");
      Serial.println(l+2);
      client.println(l+2);
      delay(100);
      Serial.println(webPage);
      client.println(webPage);
  
      while(client.available())
      {
        if(client.find("OK"))
        {
          ii=11;
          break;
        }
      }
      if(ii==11)
      break;
      delay(100);
     }
}

void setup()
{
   mySerial.begin(115200);
   Serial.begin(9600);
   client.begin(9600);
   pinMode(trigPin, OUTPUT); // Sets the trigPin as an Output
   pinMode(echoPin, INPUT); // Sets the echoPin as an Input
   
   wifi_init();
   Serial.println("System Ready..");
}

void loop()
{
  k=0;
  Serial.println("Please Refresh your Page");
  while(k<1000)
  {
   k++;
   
   while(client.available())
   {
    if(client.find("0,CONNECT"))
    {
      Serial.println("Start Printing");
      Send();
      Serial.println("Done Printing");
      delay(1000);
    }
   
  }
  delay(1);
 }
}

void Send()
{
     // delay(2000);
      delay(1000);
      digitalWrite(trigPin,LOW);
      delayMicroseconds(2);
      digitalWrite(trigPin,HIGH);
      delayMicroseconds(10);
      digitalWrite(trigPin,LOW);  //newline added
      duration = pulseIn(echoPin,HIGH);
      distance= duration*0.034/2;
      distance2 = distance;
      if(distance2 >= 10 || distance2 <=0)
      {
         Serial.println("Tank Empty \n");
        Serial.println("Distance = ");
        Serial.println(distance2);
        //Code for sending sms
        mySerial.println("AT+CMGF=1"); //sets gsm module to text mode
        delay(100);
        mySerial.println("AT+CMGS=\"+1xxxxxxxxxx\"\r"); // Replace x with your mobile number(not the number which is inserted in to gsm module)
        delay(100);
        mySerial.println("Tank is about to Empty! Please start the water supply to fill the tank.");
        delay(100);
        mySerial.println((char)26);// ASCII code of CTRL+Z
        delay(2000);
      }
      else if(distance2 <=2)
      {
        Serial.println("Tank filling \n");
        Serial.print("Distance = ");
        Serial.println(distance2);
        //Code for sending sms
        mySerial.println("AT+CMGF=1"); //sets gsm module to text mode
        delay(100);
        mySerial.println("AT+CMGS=\"+1xxxxxxxxxx\\"\r"); // Replace x with your mobile number(not the number which is inserted in to gsm module)
        delay(100);
        mySerial.println("Tank is filling! Please turn off the water supply ");
        delay(100);
        mySerial.println((char)26);// ASCII code of CTRL+Z
        delay(2000);
      }
      else{
        Serial.println("Current Water Level:");
        Serial.print(distance2);
        Serial.print("\n");
        delay(100);
    }
      webpage = "1010|"; //change id according to the bins table from database
      webpage += distance;
      sendwebdata(webpage);
      client.println("AT+CIPCLOSE=0");
}
