#!/usr/bin/env node

const fetch = require('node-fetch');
const querystring = require("querystring");

const authToken = '27c340e57a4d73fbb0f86947abe13d49';
const setId = 123;

/**
 * Instead of using URLSearchParams or FormData, let's encode by hand this time!
 * Don't forget to include the Content-Type header
 * 
 * authToken and setId don't need escaping due to their contents, but results
 * certainly does!
 */
const results = [{		// same as ../results-edit.json
  "batchnumber_": "1337",
  "status_": "Completed"
}];

fetch(`https://example.alis-asp.nl/alis/api/storeResults`, {
	method:	'POST',
	headers:	{
		'Content-Type':	'application/x-www-form-urlencoded',
	},
	body:	`authToken=${authToken}&setId=${setId}&keyField=batchnumber_&editOnly=true` +
		`&results=` + querystring.escape(JSON.stringify(results))
})
	.then(res => res.json())
	.then(json => console.log(json));
