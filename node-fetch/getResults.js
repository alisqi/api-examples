#!/usr/bin/env node

const fetch = require('node-fetch');

const authToken = '27c340e57a4d73fbb0f86947abe13d49';
const setId = 123;

// Get results using the URL provided by the in-app documentation
fetch(`https://example.alis-asp.nl/alis/api/getResults?authToken=${authToken}&setId=${setId}`)
	.then(res => res.json())
	.then(json => console.log(json));
