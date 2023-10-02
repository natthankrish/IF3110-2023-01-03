#!/bin/bash

# Prompt the user for a password
read -s -p "Enter a password for mysql environment: " PASSWORD

# Create a new .env file with the entered password
cat <<EOL > .env
# Environment variables for mysql
MYSQL_USER=root
MYSQL_ROOT_PASSWORD=$PASSWORD
MYSQL_PORT=3306
MYSQL_HOST=db-moments
MYSQL_DATABASE=moments
MYSQL_PASSWORD=$PASSWORD
EOL

echo -e "\n.env file created successfully!"