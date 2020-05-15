#!/bin/bash

baseurl=https://example.alis-asp.nl/alis/api/
authtoken=27c340e57a4d73fbb0f86947abe13d49
setid=123

#
# Using Content-Type application/x-www-form-urlencoded
#

# We pass authToken and setId in the query string and put results in the POST body
# We let curl do encoding by using --data-urlencode
curl "${baseurl}storeResults?authToken=${authtoken}&setId=${setid}" \
  --data-urlencode results@../results-new.json

# Alternatively, we can also put authToken and setId in the POST body
# We _could_ use -d (or --data) for authToken and setId because they are alphanumeric only and don't need URL-encoding
# for results, we really need to make sure data is properly encoded
curl "${baseurl}storeResults" \
  -d authToken="$authtoken" --data setId="$setid" \
  --data-urlencode results@../results-new.json

# If you're sure results content is already properly encoded, you can also use -d, like so
curl "${baseurl}storeResults" \
  -d authToken="$authtoken" -d setId="$setid" \
  -d results='%5B%7B%22date%22%3A+%222020-02-20%22%7D%5D'

#
# Using Content-Type multipart/form-data
#

# Instead of using -d (or --data), we use -F (or --form)
# This is a bit awkward in curl CLI, but in principal this works just as well as URL-encoding
# We're putting authToken in the query string, and setId in the POST body just to demonstrate that it doesn't matter
# where they are.
# Note that we're NOT using results=@results-new.json, which would upload the file
curl "${baseurl}storeResults?authToken=${authtoken}" \
  -F setId="$setid" \
  --form "results=<../results-new.json"
