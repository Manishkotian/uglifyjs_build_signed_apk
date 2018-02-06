import time 
import os
import os.path
from subprocess import call

while True:
    print("This prints once in 5 seconds.")
    time.sleep(5)   # Delay for 5 seconds.

    if os.path.isfile('Input.txt') and os.access('Input.txt', os.R_OK):
    	print "File exists and is readable"
        f1 = open('Input.txt','r')
        lines= f1.readline()
	line = lines.rstrip('\n')
        f1.close()
        os.remove('Input.txt')
        call("(ionic build android --release)",shell=True,cwd=line)
	f2 = open(os.path.join(line,'BuildStatus.txt'),'w')
	f2.write("0")
	f2.close()
	call("(sudo -S pkill -9 -f java)",shell=True)    
    else:
        print "Either file is missing or is not readable"

     
