#!/usr/bin/env python3

import requests

def getResults():
	authToken	= '27c340e57a4d73fbb0f86947abe13d49'
	setId		= 123

	response = requests.get(
		'https://example.alis-asp.nl/alis/api/getResults',
		params={'authToken': authToken, 'setId': setId}
	)
	print(response.json())

if __name__ == '__main__':
	getResults()
	