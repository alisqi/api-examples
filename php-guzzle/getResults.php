<?php

require_once 'vendor/autoload.php';

$authToken	= "27c340e57a4d73fbb0f86947abe13d49";
$setId		= 133;

$client = new GuzzleHttp\Client();

// Get results using the URL provided by the in-app documentation
// We may put the token in the query string, though that's not recommended.
$response = $client->request(
	'GET',
	"https://example.alisqi.com/api/getResults?access_token=$authToken&setId=$setId&filter=%7B%22status_%22%3A%5B%7B%22value%22%3A3%7D%5D%7D"
);

echo "Status {$response->getStatusCode()} {$response->getReasonPhrase()}\n";

$body = $response->getBody();
if (in_array('application/json', $response->getHeader('Content-Type'))) {
	$body = json_decode($body, true);
}

echo "Body\n" . print_r($body, true);

// The recommended method is to use the Authorization header
// This applies to every API operation
$client->request('GET', "https://example.alisqi.com/api/getResults?setId=$setId", [
	'headers' => [
		'Authorization' => "Bearer $authToken",
	]
]);
