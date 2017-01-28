<?php

// Resuable Functions for our image upload/playlist control app.

$curl = curl_init();

$hdmi1 = 'AAAAAgAAABoAAABaAw==';
$hdmi2 = 'AAAAAgAAABoAAABbAw==';
$hdmi3 = 'AAAAAgAAABoAAABcAw==';
$hdmi4 = 'AAAAAgAAABoAAABdAw==';
$power= 'AAAAAQAAAAEAAAAVAw==';


/*	Build a resuable CURL function in order to interact with a Sony TV.  Above this function, the variables that the TV will except in a POST request *should be listed and labeled appropriately.  Some Sony TV's have a built in Web Server that will accept POST requests to control various aspects of the *TV.  For our use we are taking advantage of the on/off and input selection functions.  I wrapped these up into a function to be used inside our image *upload/control app to make managing the assets as well as the TV much easier and more streamlined.  
*/


	function tv_remote($arg) { //Pass in an argument such as $power, $hdmi1, etc...

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://192.168.16.244/sony/IRCC",	// IP address of Sony TV
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "<?xml version=\"1.0\"?>\r<s:Envelope xmlns:s=\"http://schemas.xmlsoap.org/soap/envelope/\" s:encodingStyle=\"http://schemas.xmlsoap.org/soap/encoding/\">\r  <s:Body>\r    <u:X_SendIRCC xmlns:u=\"urn:schemas-sony-com:service:IRCC:1\">\r      <IRCCCode>$arg</IRCCCode>\r    </u:X_SendIRCC>\r  </s:Body>\r</s:Envelope>",
	  CURLOPT_HTTPHEADER => array(
	    "soapaction: \"urn:schemas-sony-com:service:IRCC:1#X_SendIRCC\"",
	    "x-auth-psk: 0000"
		  ),
		));

		curl_exec($curl);
		curl_close($curl);

	}

/*	Grab a dir listing from current directory and output filenames to text file, one per line to be feed into feh and used for a playlist.  Sort these in natural order so that we get 1,2,3,4,5..10 instead of 1,10,2,20..etc  */
	function reload_playlist() {

	$dir = './';
	$list = array_diff(scandir($dir), array('..', '.'));
	// $list = preg_grep("/^.*\.(php|sh|out)$/i", $list, PREG_GREP_INVERT);
	$list = preg_grep("/^.*\.(jpg)$/i", $list); // Sort through our array and remove anything that isnt a jpg.  This will remove any script files and directories and such from our results so that they dont show up in our "File Manager"

	foreach ($list as $file) {
		echo '<img class="thumbnail" src="'.$file.'"></img>';
		}

	// This bit of code allows us to take our array of image files in the directory and output it to a text file that can be feed into feh like so:
	// DISPLAY=:0 feh -D 8 -f ./files.txt

	$playlist = natsort($list);
	$playlist = implode('', $list);
	$playlist = str_replace(".jpg", ".jpg\n", $playlist);
	file_put_contents('files.txt', $playlist, true);
	echo 'Inside function';

	};

?>
