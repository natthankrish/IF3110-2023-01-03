#!/bin/bash

# Delete .env file
if [ -f ".env" ]; then
    rm ".env"
    echo ".env deleted successfully."
else
    echo ".env does not exist."
fi

echo

# Delete mysql folder
folderName="mysql"

# Combine the current path and the mysql folder
folderPath="$(pwd)/$folderName"

# Check if the folder exists before attempting to delete it
if [ -d "$folderPath" ]; then
    rm -r "$folderPath"
    echo "mysql folder deleted successfully."
else
    echo "mysql folder does not exist."
fi

echo

# Delete the Docker image with the tag "moments:latest"
docker rmi moments:latest