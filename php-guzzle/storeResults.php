<?php

require_once 'vendor/autoload.php';

$client = new GuzzleHttp\Client([
	'base_uri'	=> 'https://example.alisqi.com/api/',
	'query'		=> [
		'setId' => 123,
	],
	'headers'	=> [
		'Authorization' => "Bearer $authToken",
	],
]);

/**
 * Using Content-Type application/x-www-form-urlencoded
 * See http://docs.guzzlephp.org/en/stable/quickstart.html#sending-form-fields
 * 
 * We're sending authToken and setId in the query string, but we could also add them to form_params
 */
$response = $client->request('POST', 'storeResults', [
	'form_params' => [
		'results'	=> file_get_contents(__DIR__ . '/../results-new.json'),	// this file already contains JSON-formatted data
	],
]);

/**
 * Using Content-Type multipart/form-data
 * See http://docs.guzzlephp.org/en/stable/quickstart.html#sending-form-files
 */ 
$response = $client->request('POST', 'storeResults', [
	'multipart' => [
		[
			'name'		=> 'results',
			'contents'	=> file_get_contents(__DIR__ . '/../results-new.json'),
		]
	],
]);

/**
 * Handle the response
 */
echo "Status {$response->getStatusCode()} {$response->getReasonPhrase()}\n";

$responseBody = $response->getBody();
if (in_array('application/json', $response->getHeader('Content-Type'))) {
	$responseBody = json_decode($responseBody, true);
}

if ($response->getStatusCode() == 200) {
	$ri = 0;
	foreach ($responseBody as $error) {
		echo "Result $ri: " . ($error ? "Error! '$error'" : 'Success') . "\n";
		$ri += 1;
	}
} else {
	echo "Uh oh!\n" . print_r($responseBody, true);
}
