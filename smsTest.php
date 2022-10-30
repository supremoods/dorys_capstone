<?php
// Required if your environment does not handle autoloading
require __DIR__ . '/vendor/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;


// Your Account SID and Auth Token from twilio.com/console
$sid = 'ACa0a073721ea86a9dff090cf5f3d55a23';
$token = '774e73c833339661e8836015c51605f3';
$client = new Client($sid, $token);

// Use the client to do fun stuff like send text messages!
$message = $client->messages->create(
    // the number you'd like to send the message to
    '+639150471026',
    [
        // A Twilio phone number you purchased at twilio.com/console
        'from' => '+17203106126',
        // the body of the text message you'd like to send
        'body' => 'Php is Dead!!!!!!!'
    ]
);

if($message){
    echo "Message Sent";
}else{
    echo "Message Failed";
}

?>