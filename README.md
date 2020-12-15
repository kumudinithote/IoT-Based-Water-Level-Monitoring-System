# IoT-Based-Water-Level-Monitoring-System
IoT based water level Monitoring System and web application


SIoT-Based-Water-Level-Monitoring-System, include collection of data from different tanks and showing on the UI and generating shortest path using google direction api

PROJECT SETUP AND EXECUTION

Place the WMS-webApp folder under xampp/htdocs and run the localhost in the browser to access the website. Note: Xampp server used to setup database

Create database named application and import swm.sql in it to set up the database

Connect Arduino according to the circuit diagram in the report

Upload the Arduino code (.ino file) to Arduino microcontroller using Arduino ide

Change the Wi-Fi username and password in the Arduino code (.ino file) on line 104

Change mobile number in Arduino code (.ino file) on line 224. Replace ‘X’ with different number instead of the number inserted into GSM module

On the serial monitor, AT commands will be executed and an ip address will be generated. Copy the ip address and paste it in the browser new window

On the web app the level of trash in bin with id for eg:1010 will get updated

To find the capacity of garbage execute binCap.py, from the folder Python code, on the terminal as: python2 binCap.py. Execute it simultaneously with steps 6 and 7

Steps to compile and run the code.

1. Upload arduino code to microcontroller
2. Open serial monitor to check for IP and connection
3. Go to the default arduino ip page to check the water level
4. Run the tank_capacity.py by giving the command 
	 python ./tank_capacity.py 
to parse the water level from arduino to database
5. Login to web application
6. Check the web application for the updated water level
