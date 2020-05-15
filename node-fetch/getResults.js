#!/usr/bin/env node

const fetch = require('node-fetch');

const authToken = '27c340e57a4d73fbb0f86947abe13d49';
const setId = 123;

// Get results using the URL provided by the in-app documentation
fetch(`https://example.alis-asp.nl/alis/api/getResults?authToken=${authToken}&setId=${setId}` +
	`&filter=%7B%22status_%22%3A%5B%7B%22value%22%3A3%7D%5D%7D`
)
	.then(res => res.json())
	.then(json => console.log(json));
