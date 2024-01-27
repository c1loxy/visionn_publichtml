<?php

$method = $_SERVER['REQUEST_METHOD'];

//Script Foreach
$c = true;
/*$message ='<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Template</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f0f0f0;">

  <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
    <tr>
      <td align="center">
        <table role="presentation" width="600" cellspacing="0" cellpadding="15" style="margin: 20px 0; background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
          <tr>
            <td>';*/
if ( $method === 'POST' ) {

	$project_name = trim($_POST["project"]);
	$admin_email  = trim($_POST["admin_email"]);
	$form_subject = trim($_POST["form_subject"]);
	$name =  trim($_POST["name"]);
	$client =  trim($_POST["client"]);
    
    
	foreach ( $_POST as $key => $value ) {
		if ( $value != "" && $key != "project_name" && $key != "admin_email" && $key != "form_subject" ) {
$message .= " 
".ucfirst($key)."
".$value."
";	
		}
	}
} else if ( $method === 'GET' ) {

	$project_name = trim($_GET["project"]);
	$admin_email  = trim($_GET["admin_email"]);
	$form_subject = trim($_GET["form_subject"]);
	$name =  trim($_GET["name"]);
	$client =  trim($_POST["client"]);

	foreach ( $_GET as $key => $value ) {
		if ( $value != "" && $key != "project_name" && $key != "admin_email" && $key != "form_subject" ) {
$message .= " 
".ucfirst($key)."
".$value."
";		
		}
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

/*$message .='     </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>

</body>
</html>';*/
function adopt($text) {
	return '=?UTF-8?B?'.Base64_encode($text).'?=';
}

$mail_subject = "#" . $ticket . " | ". $name . " | " . $project_name;

$combinedRecipients = $admin_email . "," . $client;
$headers = "MIME-Version: 1.0" . PHP_EOL .
"Content-Type: text/html; charset=utf-8" . PHP_EOL .
'From: '.adopt($project_name).' <'.$admin_email.'>' . PHP_EOL .
'Reply-To: '.$admin_email.'' . PHP_EOL;

mail($combinedRecipients, adopt($mail_subject), $message, $headers );

//mail($admin_email, adopt($mail_subject), $message, $headers );
//mail($client, adopt($project_name), $message, $headers );
