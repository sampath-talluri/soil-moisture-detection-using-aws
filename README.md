# soil-moisture-detection-using-aws

Board connection:

We connect jumper cable from AO pin in NodeMCU to AO pin in soil sensor

We connect jumper cable from D0 pin in NodeMCU to INN pin in single channel relay of input side

We connect jumper cable from 3.3V pin in NodeMCU to Vcc pin in soil sensor

We connect jumper cable from GND pin in NodeMCU to GND pin in soil sensor

We connect jumper cable from GND and VCC pin in Single channel relay  to Usb cable

We connect battery positive to CP in single channel relay of output side

We connect battery negative to motor negative

We connect motor positive to NC in single channel relay of output side

Insert code:

First we connect all the components in the board 
Then we connect usb cable to NodeMCU the other end to the computer
We should have Arduino software installed in your system and we have a Arduino structure to upload the code to NodeMCU
We just change the ssid, password and IP to connect to wifi.
Once the code is uploaded we go to tools->screen monitoring in Arduino software we get a output which return IP address and soil moisture value and -1
Then we power supply the single channel relay to computer

Cloud connectivity 

1. Create an account in AWS Educate.
2. Sign in to the AWS Management Console and open the Amazon RDS console.
3. In the upper-right corner of the AWS Management Console, choose the AWS Region in which you want to create the DB instance.
4. In the navigation pane, choose Databases. Choose Create database.
5. In Choose a database creation method, choose Standard Create.
6. In Engine options, choose MySQL.
7. To enter your master password, do the following:
a. In the Settings section, open Credential Settings.
b. Clear the Auto generate a password check box.
c. (Optional) Change the Master username value and enter the same password in Master password and Confirm password.
8. Choose Create database.
Note:
1. Set Public accessibility to YES
2. Now you can connect the database form MySQL Workbench from your system and can create schema and tables.

It takes 10-15 minutes to creat database

Then we open the Mysql workbench in computer 
Connect the AWS RDS to Mysql by using server name, username and password.
We get connected to cloud.

We also use Xampp server to monitor the data locally in our system.
 Once the cloud is connected to Mysql and the data starts uploading to the cloud once the data is uploaded successfully we get the output in Arduino bode with soil moister value and motor status ON/OFF and also return 200 and ok which says the data is uploaded successfully.

Once we go to Mysql and retrieve the values from the cloud we get the Id, date, time and moisture value and motor status printed.
