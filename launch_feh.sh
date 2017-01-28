#!/bin/bash

# Just a simple script to check if feh is currently running.  If it is then we need to stop it and start a new instance. 
# If it's not running then let's start it.  Make sure to place this in the same directory as the filemanager.php script
# files.txt is simply the name of the text file generated by the filemanager.php.


export HOME=/home/pi/

if [[ `pgrep feh` != '' ]]; then
	echo 'The playlist is currently running'
	echo 'Process ID is:' `pgrep feh`
	killall feh
	DISPLAY=:0 feh -D 8 -f ./files.txt

else
	DISPLAY=:0 feh -D 8 -f ./files.txt
fi
