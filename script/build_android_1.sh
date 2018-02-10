#!/usr/bin/bash

old_version="$1"
new_version="$2"
git_lab_https="$3"
apk_path="$4"
app_name="$5"      
program_path="$6"
git_pull_directory="$7"

keystore_name="your_keystore_name"

git_project_directory="$git_pull_directory/$app_name"

android_release_path="$program_path/platforms/android/build/outputs/apk/"
	
js_directory="$git_project_directory/www/js/" 
 
suffix="js"

js_backup="$git_project_directory/jsbackup/" 
 
uglifyd_js="$git_project_directory/uglifyd_js"

base()
{
	
	cd $git_project_directory/

	mkdir jsbackup
	chmod -R 777 jsbackup
	
	mkdir uglifyd_js
        chmod -R 777 uglifyd_js

	cd $1
	for f in *
	do
			extension=`echo "$f" | cut -d '.' -f2`
			if [ -f "$1$f" ]
	 		then
				if [ $extension = $suffix ]
				then
					cd $1
					cp -fR $f $uglifyd_js/"${f%.js}".js
					cp -fR $f $js_backup"${f%.js}".js
					printf "uglifying $f\n"
					uglify "$f"
					mv  $js_backup"${f%.js}"1.js $uglifyd_js/"${f%.js}".js
					rm -Rf $js_backup"${f%.js}".js
	 			else
					cd $apk_path/
					status=2
					echo "$status" > $app_name.txt
					cd $git_pull_directory/
					rm -R -f $app_name
					exit 1
				fi
			elif [ -d "$1$f" ]
			then
				echo ""
				echo "***uglifying folder $f***"
				echo 
				uglifydir $js_directory$f/ $f
			fi
		
	done
}



uglify()
{
	
	 uglifyjs $js_backup"${f%.js}".js > $js_backup"${f%.js}"1.js

}

uglifydir()
{
	cd $1
	for f in *
	do
			extension=`echo "$f" | cut -d '.' -f2`
			if [ -f "$1$f" ]
	 		then
				if [ $extension = $suffix ]
				then
					test -d $uglifyd_js/$2 || mkdir $uglifyd_js/$2 && cp -fR $f $uglifyd_js/$2/"${f%.js}".js
					cp -fR $f $js_backup"${f%.js}".js
					printf "uglifying $f\n"
					uglify "$f"
					mv  $js_backup"${f%.js}"1.js $uglifyd_js/$2/"${f%.js}".js
					rm -Rf $js_backup"${f%.js}".js
	 			else
					cd $apk_path/
					status=2
					echo "$status" > $app_name.txt
					cd $git_pull_directory/
					rm -R -f $app_name
					exit 1
				fi
			elif [ -d "$1$f" ]
			then
				echo ""
				echo "***uglifying folder $f***"
				echo 
				uglifydir $1$f/  $2/$f
			fi
	done
}
version()
{
	filename="config.xml"
	cd $program_path/
	for i in *
	do
		if [ -f "$i"  ]
		then
			if [ $i = $filename ]
			then 
					 sed -i 's/version="'$old_version'"/version="'$new_version'"/' $i
					

			fi	
		fi
	done
}

move_files()
{
	rm -Rf $js_directory*
	mv -f $git_project_directory/uglifyd_js/* $js_directory
	rm -Rf $program_path/www/*
	mv -f  $git_project_directory/www/* $program_path/www/	
	retval_www=$?
	if [ $retval_www -eq 0 ]
	then
		echo "www file replaced in path  $program_path/www/ successfully"
	else
		echo "*** www file replacing to path  $program_path/www/ failed "
	fi
}





printf "\n*********************GIT CLONE************************\n"
printf "\n***CLONING TO FOLDER:  $app_name\n"
printf "\n"
cd $git_pull_directory/
rm -Rf *
git clone $git_lab_https || sleep 2m; kill $! 
retval=$?
for d in *
do
	if [ -d "$app_name" ] 
	then 
		if [ $retval -ne 0 ]
		then
			echo "git clone successfull"
		else
			cd $apk_path/
			status=1
			echo "$status" > $app_name.txt
			cd $git_pull_directory/
			rm -R -f $app_name
			exit 1
		fi
			
	else
			cd $apk_path/
			status=1
			echo "$status" > $app_name.txt
			cd $git_pull_directory/
			rm -R -f $app_name
			exit 1

	fi
done

printf "\n*****************UGLIFYING THE JAVASCRIPT FILES******************\n"
cd $git_project_directory/
base "$js_directory"
cd $git_project_directory/
rm -R -f jsbackup

printf "\n*****************REPLACING VERSION NUMBER*************\n"
printf "\nchanging version number from $old_version to $new_version\n"
version

printf "\n***************MOVING UGLIFYD JS FILES*************\n"

move_files

cd $program_path/www/js/
echo "var VERSION = $new_version;" > version.js
retval_version=$?
if [ $retval_version -eq 0 ]
then 
	echo "version.js file has been created in path $program_path/www/js/ successfully"
else
	echo "****version.js file creation failed in path $program_path/www/js/"
fi

cd $program_path/
echo "1" > BuildStatus.txt
retval_buildstatus=$?
if [ $retval_buildstatus -eq 0 ]
then 
	echo "BuildStatus text file has been created in path $program_path/ successfully" 
else
	echo "***BuildStatus text file creation failed in path $program_path/"
fi

cd $apk_path/
cd ..
echo "$program_path/" > Input.txt
retval_input=$?
working_dir=$(pwd)
if [ $retval_input -eq 0 ]
then 	
	echo "input.txt file has been created in path $working_dir/ successfully"
else
	echo "***input.txt file creation failed in path $working_dir/"
fi






		
	











