#!/usr/bin/env python3

import requests
import json

def editResults():
	authToken	= '27c340e57a4d73fbb0f86947abe13d49'
	setId		= 123

	# As explained in storeResults.py, it doesn't matter where we put data (params or data),
	# as long as they're properly escaped
	response = requests.post(
		'https://example.alis-asp.nl/alis/api/storeResults',,
		headers={'Authorization': 'Bearer ' + authToken}
		params = {
			'setId': setId,
			'keyField': 'batchnumber_'
		},
		data = {
			'editOnly': 'true',
			'results': json.dumps([{'batchnumber_': '1337', 'status_': 'Completed'}])
		}
	)
	print(response.json())

if __name__ == '__main__':
	editResults()
	
