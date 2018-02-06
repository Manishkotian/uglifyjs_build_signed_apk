#!/usr/bin/bash

old_version="$1"
new_version="$2"
git_lab_https="$3"
apk_path="$4"
app_name="$5"      
program_path="$6"
git_pull_directory="$7"
build_id="$8"

keystore_name="vivikta"

git_project_directory="$git_pull_directory/$app_name"

android_release_path="$program_path/platforms/android/build/outputs/apk/"
	
js_directory="$git_project_directory/www/js/" 
 
suffix="js"

js_backup="$git_project_directory/jsbackup/" 
 
uglifyd_js="$git_project_directory/uglifyd_js"

status=0


buildandroid()
{
	prefix="android-release-unsigned"
	cd $android_release_path
	for f in *
	do
		releasename=`echo "$f" | cut -d '.' -f1`
		if [ $releasename = $prefix ]
		then
			printf "\nmoving $f\n"
			mv $android_release_path"${f%.apk}".apk $program_path/"$app_name"_"$new_version"_unsigned.apk 
			retval_moving_apk=$?
			if [ $retval_moving_apk -eq 0 ]
			then
				echo "moved $f successfully"
			else
				echo "***moving $f failed***"
			fi
		fi
	done			
	cd $program_path/
	echo "before jarsigner"
	jarsigner -verbose -sigalg SHA1withRSA -digestalg SHA1 -keystore "$keystore_name".keystore "$app_name"_"$new_version"_unsigned.apk -storepass vivikta alias_name >> test.txt
	retval=$?	
	echo "after jarsigner" 	
	if [ $retval -ne 0 ]
	then
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
		cd $program_path/
		rm -Rf test.txt
		rm -R -f "$app_name"_"$new_version"_unsigned.apk
		cd $apk_path/
		status=3
		echo "$status" > $app_name.txt
		echo "jarsigner command failed"
		exit 1
	fi
	echo "Before Zip Align" >> test.txt
	zipalign -v 4 "$app_name"_"$new_version"_unsigned.apk "$build_id".apk >> test.txt 
	retval=$?
	echo "After Zip align" >> test.txt
	echo $retval >> test.txt
	if [ $retval -ne 0 ]
	then
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
		cd $program_path/
		rm -Rf test.txt
		rm -R -f "$app_name"_"$new_version"_unsigned.apk
		rm -R -f "$build_id".apk
		cd $apk_path/
		status=4
		echo "$status" > $app_name.txt
		exit 1
	fi

	echo "apk file build successfully"
	
	
}

buildandroid

cd $apk_path/
echo "$status" > $app_name.txt

cd $program_path/
rm -Rf test.txt
rm -Rf "$app_name"_"$new_version"_unsigned.apk

mv "$build_id".apk $apk_path/
retval_move_apk=$?
if [ $retval_move_apk -eq 0 ]
then 
	echo "moved apk successfully" 
else 
	echo "***moved apk file failed" 
fi

exit 0




		
	











