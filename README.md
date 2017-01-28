# RP-iControl
Raspberry Pi/TV control and automation


Various scripts that I am working on to be able control and integrate control of Raspberry Pi's and the TV's they are connected to.  Currently you will find the following:

* Filemanager.php

This is a flat file, file upload script that I have made some modifications to.  Check the comments for more information.  Currently allows you to drag and drop files to be uploaded to a directory on the pi that this is running on.  I currently use this to manage slides on our lobby tv.  The content changes every few weeks or so and I wanted to be able to give our communications department a way that they could manage this content themselves.  This will only show JPG's in the directory but can be easily modified to show whatever.  I am integrating this with the feh program in order to create a seamless slideshow creation/integration.  This script generates a playlist based on the current directory and feeds it into feh.  If feh is currently running, then it will restart it with the new content.  This still needs some work to make update/deletions happen in real time, however for now you can simply refresh the page to ensure that the latest content is being shown on the tv.

* Functions.php

This holds some of our global functions for now.  
