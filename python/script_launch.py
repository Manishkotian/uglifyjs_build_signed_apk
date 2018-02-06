#!/usr/bin/python
import time 
import os
import os.path
import subprocess
from subprocess import call
from subprocess import PIPE
import sys
'''
def function_automate():
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
        else:
            print "Either file is missing or is not readable"
'''

     
if __name__ == "__main__":
    argv = sys.argv
    argc  = len(argv)
    
    args = argv[1:len(argv)]

    print  args
    #print "length of args is " + str(len(args))

    #Create a text file for args
    logfile_path = args[8]+"/"+args[7]+".txt"
    logfile_handle = open(logfile_path,'w')

    # launch bash shell script to git pull and uglify
    system_command = "bash build_android_1.sh "+ args[0] + " " +  args[1]+ " " +  args[2]+ " " +  args[3]+ " " +  args[4]+ " " +  args[5]+ " " +  args[6]+ " " +  args[7]
    p = subprocess.Popen( [system_command],stdout=subprocess.PIPE,stderr=subprocess.PIPE, shell=True)
    ret_value = p.wait()
    print ret_value

    # Read output of the shell script
    outs, errors = p.communicate()
    logfile_handle.write(outs)
    logfile_handle.write("\n")
    logfile_handle.flush()
    print( "Script output: "+outs)
    # Check status of the above bash command
    fname = args[3]+"/"+args[4]+".txt"
    if os.path.isfile(fname) and os.access(fname, os.R_OK):
        f1 = open(fname, 'r')
        lines = f1.readline()
        os.remove(fname)
        if int(lines) == 1 :
            logfile_handle.write("\n")
            logfile_handle.write("git clone authentication failed(Access denied)")
            logfile_handle.write("\n")
            logfile_handle.write("\n")
            logfile_handle.flush()
            os._exit(1)
        elif int(lines) == 2:
            logfile_handle.write("\n")
            logfile_handle.write("problem with js filename")
            logfile_handle.write("\n")
            logfile_handle.write("\n")
            logfile_handle.flush()
            os._exit(1)
        f1.close()
    else:
        retries = 0
        

        while retries <= 10:
            fileBuildStat = args[5] + "/BuildStatus.txt"
            print "polling on " + fileBuildStat 

            buildStat = -1
            if os.stat(fileBuildStat).st_size != 0:
                buildStatBuffRdr = open(fileBuildStat, 'r')
                a1 = buildStatBuffRdr.readline()
                print "a1 is" + a1
                if(int(a1) == 0):
                    buildStat = 0
                    buildStatBuffRdr.close()    
                    break
                
                else:
                    time.sleep(30)
                    retries += 1
                    buildStatBuffRdr.close()        
	os.remove(fileBuildStat)
        print "stage creating signed APK start \n"
        file1 = args[5]+"/platforms/android/build/outputs/apk/android-release-unsigned.apk"
        if os.path.isfile(file1) and os.access(file1, os.R_OK):
            system_command2 = "bash build_android_2.sh "+ args[0] + " " +  args[1]+ " " +  args[2]+ " " +  args[3]+ " " +  args[4]+ " " +  args[5]+ " " +  args[6]+ " " +  args[7]
            print system_command2
            command2 = subprocess.Popen( [system_command2],stdout=subprocess.PIPE, stderr=subprocess.PIPE, shell=True)
            ret_value_command2 = command2.wait()
            print "came out of command2.wait()"
            print ret_value_command2
            outs1, errors1 = command2.communicate()
            logfile_handle.write("stage creating signed APK start\n")
            logfile_handle.write(outs1)
            print outs1
            logfile_handle.write("\n")
            logfile_handle.flush()
            print("command2 output is " + outs1)
            print("Error command2 output is " + errors1)
            file4 = args[3]+"/"+args[4]+".txt"
            reader3 = open(file4, 'r')
            a1 = reader3.readline()
            reader3.close()
            os.remove(file4)
            logfile_handle.write("\n")
            logfile_handle.write("\n")
            logfile_handle.flush()
            if (int(a1) == 0):
                logfile_handle.write("apk file build successfully")
                logfile_handle.write("\n")
                logfile_handle.flush()
                os._exit(0)
            elif (int(a1) == 3):
                logfile_handle.write("keystore not found")
                logfile_handle.write("\n")
                logfile_handle.flush()
                os._exit(1)
            elif (int(a1) == 4):
                logfile_handle.write("zipalign command failed")
                logfile_handle.write("\n")
                logfile_handle.flush()
                os._exit(1)   
        else:
            print "running third shellscript"
            system_command3 = "bash build_android_3.sh "+ args[0] + " " +  args[1]+ " " +  args[2]+ " " +  args[3]+ " " +  args[4]+ " " +  args[5]+ " " +  args[6]+ " " +  args[7]
            command3 = subprocess.Popen( [system_command3],stdout=subprocess.PIPE, stderr=subprocess.PIPE, shell=True)
            ret_value_command3 = command3.wait()
            print ret_value_command3
            outs2, errors2 = command3.communicate()
            logfile_handle.write(outs2)
            logfile_handle.write("\n")
            logfile_handle.flush()
            print("command3 output is " + outs2)
            print("Error command3 output is " + errors2)
            logfile_handle.write("\n")
            logfile_handle.write("ionic build android failed")
            logfile_handle.write("\n")
            logfile_handle.flush()
            os._exit(1)     

        logfile_handle.close()

