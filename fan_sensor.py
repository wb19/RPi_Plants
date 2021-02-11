#!/usr/bin/env python

#Author: Wahida Hussain
#This program uses the Adafruit library to allow a DHT11 temperature and humidity
#sensor to take readings. The logic: if the temperature exceeds X'Celcius, the fan
#will be turned on for Y seconds.

import RPi.GPIO as GPIO
import Adafruit_DHT
from time import sleep

fan_GPIO = 4 #We use 7th physical pin (GPIO 4) to control the fan
GPIO.setmode(GPIO.BCM)
GPIO.setup(fan_GPIO, GPIO.OUT)

# Set sensor type
sensor = Adafruit_DHT.DHT11
# We will use the 11th physical pin (GPIO 17) to read data from sensor
sensor_GPIO = 17
humidity, temperature = Adafruit_DHT.read_retry(sensor, sensor_GPIO)

def set_fan(state):
    if state:
        GPIO.output(fan_GPIO, False)
    else:
        GPIO.output(fan_GPIO, True)

#the fan will be activated if the temperature is more than 27'C.
if (temperature >= 27):
    print('It is hot!!! Temp={0:0.1f}*C  Humidity={1:0.1f}%'.format(temperature, humidity))
    print("Fan activated to cool the system.")
    set_fan(True)
    sleep(10)   #fan is activated for n seconds 
else:
    set_fan(False)
    print('Temp is fine. Temp={0:0.1f}*C  Humidity={1:0.1f}%'.format(temperature, humidity))

GPIO.cleanup()



