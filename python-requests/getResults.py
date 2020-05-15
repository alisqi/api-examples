#!/usr/bin/env python3

import requests

def getResults():
	authToken	= '27c340e57a4d73fbb0f86947abe13d49'
	setId		= 123

	response = requests.get(
		'https://example.alis-asp.nl/alis/api/getResults?authToken={authToken}&setId={setId}&filter=%7B%22status_%22%3A%5B%7B%22value%22%3A3%7D%5D%7D'.format(
			authToken = authToken, setId = setId
		)
	)
	print(response.json())

if __name__ == '__main__':
	getResults()
