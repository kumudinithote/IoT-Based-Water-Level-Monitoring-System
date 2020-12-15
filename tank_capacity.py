#!/usr/bin/env python
import mysql.connector
import urllib2
import time

db = mysql.connector.connect(
  host="192.168.64.2",
  user="root",
  password="KUmu20@#",
  database="application"
)

cur = db.cursor()

while 1:
    response = urllib2.urlopen("http://192.168.0.20/") #ip address fetched from arduino code
    page_source = response.read()
    id = page_source.split('|')[0]
    distance = page_source.split('|')[1]
    intdist = int(distance)
    if (19-intdist)<0:
        level=0
    else:
        level = str((100.0*(float)(18-intdist))/18.0)
    try:
        cur.execute("""UPDATE tanks set tank_capacity_filled = %s where tank_id = %s""",(level, id))
        db.commit()
        print("Data Commited")
        print(level)
        print(intdist)

    except:
        print("Rollback")
    time.sleep(1)

db.close()
