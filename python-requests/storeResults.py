#!/usr/bin/env python3

import requests

def storeResults():
	authToken	= '27c340e57a4d73fbb0f86947abe13d49'
	setId		= 123

	# We're putting setId in the URL and auth token in the form data just to show that it doesn't matter where data goes.
	# (The recommended method of using the token is the Authorization header as shown in getResults.py and below)
	response = requests.post(
		'https://example.alisqi.com/api/storeResults?setId={setId}'.format(setId=setId),
		data = {
			'access_token': authToken,
			'results': open('../results-new.json').read()
		}
	)
	print(response.json())
	
	# Alternatively, we can also put authToken and setId in data instead of params
	response = requests.post(
		'https://example.alisqi.com/api/storeResults',
		headers={'Authorization': 'Bearer ' + authToken}
		data = {
			'setId': setId,
			'results': open('../results-new.json').read()
		}
	)
	print(response.json())

if __name__ == '__main__':
	storeResults()
	
