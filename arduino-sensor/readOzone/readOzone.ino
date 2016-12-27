int ozonePin = 0;     // potentiometer wiper (middle terminal) connected to analog pin 3
                       // outside leads to ground and +5V
int ozone = 0;           // variable to store the value read

void setup()
{
  Serial.begin(9600);          //  setup serial
}

void loop()
{
  ozone = analogRead(ozonePin);    // read the input pin
  Serial.println(ozone);             // debug value
  delay(1000);
}
