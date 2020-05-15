#!/bin/bash

baseurl=https://example.alis-asp.nl/alis/api/
authtoken=27c340e57a4d73fbb0f86947abe13d49
setid=123

# Get results using the URL provided by the in-app documentation
curl "${baseurl}getResults?authToken=${authtoken}&setId=${setid}&filter=%7B%22status_%22%3A%5B%7B%22value%22%3A3%7D%5D%7D"

# Alternatively, let curl url-encode your hand-crafted filter
# This example uses the undocumented filter short-hand form {"field":"value"} instead of {"field":[{"value":"value"]}
curl "${baseurl}getResults?authToken=${authtoken}&setId=${setid}" \
  -G --data-urlencode filter='{"status_":3}'
