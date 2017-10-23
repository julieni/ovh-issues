#!/bin/bash

OVH_APP_KEY="iE3vL3mgAtLZg00l"

curl -XPOST -H"X-Ovh-Application: $OVH_APP_KEY" -H "Content-type: application/json" \
https://eu.api.ovh.com/1.0/auth/credential  -d '{
    "accessRules": [
        {
            "method": "GET",
            "path": "/me"
        }
    ],
    "redirection":"https://www.ovh.com/"
}'
