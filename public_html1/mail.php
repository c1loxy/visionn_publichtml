<?php

$method = $_SERVER['REQUEST_METHOD'];

//Script Foreach
$c = true;
if ( $method === 'POST' ) {

	$project_name = trim($_POST["project_name"]);
	$admin_email  = trim($_POST["admin_email"]);
	$form_subject = trim($_POST["form_subject"]);
	$Email =  trim($_POST["Email"]);
    
    
	foreach ( $_POST as $key => $value ) {
		//if ( $value != "" && $key != "project_name" && $key != "admin_email" && $key != "form_subject" ) {
$message .= "
$key
$value
			";	
		//}
	}
} else if ( $method === 'GET' ) {

	$project_name = trim($_GET["project_name"]);
	$admin_email  = trim($_GET["admin_email"]);
	$form_subject = trim($_GET["form_subject"]);
	$Email =  trim($_GET["Email"]);

	foreach ( $_GET as $key => $value ) {
	//	if ( $value != "" && $key != "project_name" && $key != "admin_email" && $key != "form_subject" ) {
			$message .= "
			$key 
			$value
			";
	//	}
	}
}

// Function to generate the next sequential 4-digit ticket number
function generateTicketNumber() {
    // Define a file to store the current ticket number
    $filename = 'ticket_counter.txt';

    // Check if the file exists, and read the current ticket number
    if (file_exists($filename)) {
        $counter = intval(file_get_contents($filename));
    } else {
        // If the file doesn't exist, start from 1
        $counter = 1;
    }

    // Format the counter with leading zeros to ensure 4 digits
    $formattedCounter = sprintf("%05d", $counter);

    // Increment the counter for the next ticket
    $counter++;

    // Save the updated counter back to the file with a newline
    file_put_contents($filename, $counter . PHP_EOL);

    return $formattedCounter;
}

// Example of using the function
$ticket = generateTicketNumber();

function adopt($text) {
	return '=?UTF-8?B?'.Base64_encode($text).'?=';
}

$mail_subject = "#" . $ticket . " | " . $project_name;

$headers = "MIME-Version: 1.0" . PHP_EOL .
"Content-Type: text/html; charset=utf-8" . PHP_EOL .
'From: '.adopt($project_name).' <'.$admin_email.'>' . PHP_EOL .
'Reply-To: '.$admin_email.'' . PHP_EOL;

mail($admin_email, adopt($mail_subject), $message, $headers );

mail($Εmail, adopt($project_name), $message, $headers );
