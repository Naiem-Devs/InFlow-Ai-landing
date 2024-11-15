<?php
// include database and object files
include_once '../config/database.php';
include_once 'stat/api/objects/Swapf_stat.php';

require '/var/www/eng_inflows/vendor/autoload.php';
use \Mailjet\Resources;

$type = "";
if (isset($_REQUEST["type"]) ) {
  $type = $_REQUEST["type"];
}

$firstName = "";
if (isset($_REQUEST["firstName"]) ) {
  $firstName = $_REQUEST["firstName"];
}

$lastName = "";
if (isset($_REQUEST["lastName"]) ) {
  $lastName = $_REQUEST["lastName"];
}

$subject = "";
if (isset($_REQUEST["subject"]) ) {
  $subject = $_REQUEST["subject"];
}

$text = "";
if (isset($_REQUEST["text"]) ) {
  $text = $_REQUEST["text"];
}

if (isset($_REQUEST["email"]) ) {
  $email_to = $_REQUEST["email"];
  
  if ($email_to != "") {
	  
	  $message = $text;

	  $mj = new \Mailjet\Client('69763d1aa12a5270a07d3e099634bd68','88d16dd4c662482b76aab65645d565dd',true,['version' => 'v3.1']);
	  $body = [
		'Messages' => [
		  [
			'From' => [
			  'Email' => "akane@inflows.io",
			  'Name' => "CoChemist UI"
			],
			'To' => [
			  [
				'Email' => "info@inflowsai.com",
				'Name' => "Info InflowsAI"
				/*'Email' => "amalinovski@yahoo.com",
				'Name' => "AM"*/
			  ]
			],
			'Subject' => $subject,
			'TextPart' => "",
			'HTMLPart' => $message,
			'CustomID' => "AppGettingStartedTest"
		  ]
		]
	  ];
	  
	  $database = new Database();
	  $db = $database->getConnection();
	  $swapf_stat = new Swapf_stat($db);
	  if ( "$type" == "SUB" ) {
	      $dbres = $swapf_stat->write_Sub($email);
	  }
	  if ( "$type" == "UPG" ) {
	      $dbres = $swapf_stat->write_Upgrade($email,$firstName,$lastName,$subject,$message);
	  }
		
	  $response = $mj->post(Resources::$Email, ['body' => $body]);
	  $response->success() && var_dump($response->getData());
	  //echo "type=$type";
  }
}
?>
