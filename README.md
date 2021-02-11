# RPi_Plants
Automatic plant watering system using Raspberry Pi &amp; Python

Prototype 1 (basic): Uses crontab which triggers the watering a specified time each day. This is a base prototype design for plants that require regular watering.

Prototype 2 (intermediate): Prototype 2 builds on Prototype 1, and includes these additional features:
1. Automated cooling fan system that is activated when the internal temperature of the enclosure exceeds a specified temperature treshold.</li>
2. Remote access via a web interface to allow user to manually activate the pump or cool the enclosure. The webpage also shows the timestamp of the last watering.

Hardware Used:

1.	Raspberry Pi 3B 
2.	16GB micro SD card with NOOBs installed
3.	5V micro USB charger for the Pi
4.	5V Relay Module
5.	Male-to-Male Jumper cables
6.	USB Alligator clips 
7.	Mini submersible pump
8.	Piping tube

Additional hardware used for Prototype 2:

9. PC Cooling fan
10. DHT11 temperature and humidity sensor
