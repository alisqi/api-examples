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
 * We're putting setId in the URL and authToken in the form data just to show that it doesn't matter where data goes.
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
 */
const form = new FormData();
form.append('authToken', authToken);
form.append('setId', `${setId}`);
form.append('results', fs.readFileSync('../results-new.json'));

fetch(`https://example.alis-asp.nl/alis/api/storeResults`, {
	method:	'POST',
	body:	form,
	headers:form.getHeaders()
})
	.then(res => res.json())
	.then(json => console.log(json));
