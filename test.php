<?php
// API URL
$url = 'https://apibankingonesandbox.icicibank.com/api/v1/bbps/AgentLogin';

// Create a new cURL resource
$ch = curl_init($url);

// Setup request to send json via POST
$data = array(
    'loginHash' =>  'UkI3NlJCMTJBR1Q1Mjc3OTU3MjY6cGFzc3dvcmQ=',
    'APIKey'    =>  ''
);

// Attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

// Return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the POST request
$result = curl_exec($ch);
// Close cURL resource
curl_close($ch);

print_r($result);
