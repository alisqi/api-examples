<?php

require_once 'vendor/autoload.php';

$client = new GuzzleHttp\Client();

/**
 * Edit one result using the keyField and editOnly parameters
 * 
 * Contrary to the code in storeResults.php, we'll add authToken and setId to the post body instead of URL query string.
 * This is just to show that it doesn't matter.
 */
$response = $client->request('POST', 'https://example.alis-asp.nl/alis/api/storeResults', [
	'form_params' => [
		'authToken'	=> '27c340e57a4d73fbb0f86947abe13d49',
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
