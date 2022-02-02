#!/usr/bin/env python3

import requests

def getResults():
	authToken	= '27c340e57a4d73fbb0f86947abe13d49'
	setId		= 145

	# We may put the authentication token in the query string, though that's not recommended
	#response = requests.get(
	#	'https://example.alisqi.com/api/getResults?access_token={authToken}&setId={setId}&filter=%7B%22status_%22%3A%5B%7B%22value%22%3A3%7D%5D%7D'.format(
	#		authToken = authToken, setId = setId
	#	)
	#)
	#print(response.json())
	
	# The recommended method is to use the Authorization header
	# This applies to every API operation
	requests.get(
		'http://localhost:8008/alis/api/getResults?setId={setId}'.format(setId=setId),
		headers={'Authorization': 'Bearer ' + authToken}
	)

if __name__ == '__main__':
	getResults()
