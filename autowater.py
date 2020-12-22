#Author: Wahida Hussain
#This program activates the water pump (via a relay). The pump will
#run for 3 cycles (1 cycle = water for 3 seconds and pause for 5 seconds)
#At the end of the 3 cycles, the time & date will be logged into a txt file.

import RPi.GPIO as GPIO
from time import sleep
from datetime import datetime, date

#We will use the 3rd pin (GPIO 2) to control the relay/pump
GPIO.setmode(GPIO.BCM)
GPIO.setup(2, GPIO.OUT)
GPIO.output(2, GPIO.HIGH)

cycleCount = 1
while cycleCount <= 3: 
    GPIO.output(2, False)
    sleep(3) #activate pump for 3 seconds
    
    GPIO.output(2, True);
    sleep(5) #pause pump for 5 seconds
    
    cycleCount += 1

current_time = datetime.now().strftime("%H:%M:%S")
current_date = date.today().strftime("%d/%B/%Y")
    
#Append a new line to the log to record the time & date watered
newLog = 'Automatically watered at: ' + current_time + ' on ' + current_date + '\n'
with open('watering_log.txt', 'a') as myLog:
    myLog.write('\n')
    myLog.write(newLog)
    myLog.close()
    
GPIO.cleanup()
