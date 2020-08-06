#!/usr/bin/env node

const FormData = require('form-data');
const fs = require('fs');
const fetch = require('node-fetch');
const { URLSearchParams } = require('url');

const authToken = '27c340e57a4d73fbb0f86947abe13d49';
const setId = 133;

/**
 * Using Content-Type application/x-www-form-urlencoded
 * See https://www.npmjs.com/package/node-fetch#post-with-form-parameters
 * 
 * We're putting setId in the URL and auth token in the form data just to show that it doesn't matter where data goes.
 * (The recommended method of using the token is the Authorization header as shown in getResults.js and below)
 */

const params = new URLSearchParams();
params.append('authToken', authToken);
params.append('results', fs.readFileSync('../results-new.json'));

fetch(`https://example.alis-asp.nl/alis/api/storeResults?setId=${setId}`, {
	method:	'POST',
	body:	params
})
	.then(res => res.json())
	.then(json => console.log(json));

/**
 * Using Content-Type multipart/form-data
 * See https://www.npmjs.com/package/node-fetch#post-with-form-data-detect-multipart
 * 
 * Also note that the Bearer authorization spec (https://tools.ietf.org/html/rfc6750#section-2.2)
 * says that clients "MUST NOT" put the token in the post body when using this content type!
 * Alis does support it, but the recommended method is to use the Authorization header.
 */
const form = new FormData();
form.append('authToken', authToken);
form.append('setId', `${setId}`);
form.append('results', fs.readFileSync('../results-new.json'));

fetch(`https://example.alis-asp.nl/alis/api/storeResults`, {
	method:	'POST',
	body:	form,
	// merge the form's headers (which contains the content-type) with the Authorization header
	headers:Object.assign(form.getHeaders(), {
		'Authorization': `Bearer ${authToken}`,
	}),
})
	.then(res => res.json())
	.then(json => console.log(json));
