#!/usr/bin/env python3

import requests

def storeResults():
	authToken	= '27c340e57a4d73fbb0f86947abe13d49'
	setId		= 123

	response = requests.post(
		'https://example.alis-asp.nl/alis/api/storeResults',
		params = {'authToken': authToken, 'setId': setId},
		data = {'results': open('../results-new.json').read()}
	)
	print(response.json())
	
	# Alternatively, we can also put authToken and setId in data instead of params
	response = requests.post(
		'https://example.alis-asp.nl/alis/api/storeResults',
		data = {
			'authToken': authToken,
			'setId': setId,
			'results': open('../results-new.json').read()
		}
	)
	print(response.json())

if __name__ == '__main__':
	storeResults()
	