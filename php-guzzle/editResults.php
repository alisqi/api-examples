<?php

require_once 'vendor/autoload.php';

$client = new GuzzleHttp\Client();

/**
 * Edit one result using the keyField and editOnly parameters
 * 
 * Contrary to the code in storeResults.php, we'll add both the authentication token and setId to the post body,
 * just to show that both are supported.
 */
$response = $client->request('POST', 'https://example.alis-asp.nl/alis/api/storeResults', [
	'form_params' => [
		'access_token'	=> '27c340e57a4d73fbb0f86947abe13d49',
		'setId'		=> 133,
		'keyField'	=> 'batchnumber_',
		'editOnly'	=> 'true',
		'results'	=> json_encode([	// same content as ../results-edit.json, but inline to show how it's done
			[
				'batchnumber_'	=> '1337',
				'status_'		=> 'Completed',
			]
		]),
	],
]);
