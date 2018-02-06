#!/usr/bin/bash

old_version="$1"
new_version="$2"      
program_path="$6"

filename="config.xml"
cd $program_path/
for i in *
do
	if [ -f "$i"  ]
	then
		if [ $i = $filename ]
		then 
			 sed -i 's/version="'$new_version'"/version="'$old_version'"/' $i
		fi	
	fi
done



		
	











