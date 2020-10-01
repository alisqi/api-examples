#!/bin/bash

baseurl=https://example.alis-asp.nl/alis/api/
authtoken=27c340e57a4d73fbb0f86947abe13d49
setid=123

# Edit one result using the keyField and editOnly parameters
curl "${baseurl}storeResults" \
  -H "Authorization: Bearer ${authtoken}" \
  -d setId="$setid" -d keyField=batchnumber_ -d editOnly=true \
  --data-urlencode results@../results-edit.json
