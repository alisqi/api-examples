<?php

require_once 'vendor/autoload.php';

$authToken	= "27c340e57a4d73fbb0f86947abe13d49";
$setId		= 133;

$client = new GuzzleHttp\Client();

// Get results using the URL provided by the in-app documentation
$response = $client->request('GET', "https://example.alis-asp.nl/alis/api/getResults?authToken=$authToken&setId=$setId");

echo "Status {$response->getStatusCode()} {$response->getReasonPhrase()}\n";

$body = $response->getBody();
if (in_array('application/json', $response->getHeader('Content-Type'))) {
	$body = json_decode($body, true);
}

echo "Body\n" . print_r($body, true);
