#!/bin/bash

baseurl=https://example.alis-asp.nl/alis/api/
authtoken=27c340e57a4d73fbb0f86947abe13d49
setid=123

# Get results using the URL provided by the in-app documentation
# We can put the access token in the query string, though that's not recommended
curl "${baseurl}getResults?access_token=${authtoken}&setId=${setid}&filter=%7B%22status_%22%3A%5B%7B%22value%22%3A3%7D%5D%7D"

# Alternatively, let curl url-encode your hand-crafted filter
# This example uses the undocumented filter short-hand form {"field":"value"} instead of {"field":[{"value":"value"]}
# Also, let's put the token in the appropriate header for better security
curl "${baseurl}getResults?setId=${setid}" \
  -H "Authorization: Bearer ${authtoken}" \
  -G --data-urlencode filter='{"status_":3}'
