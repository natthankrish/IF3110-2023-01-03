#!/bin/bash

# Prompt the user for a password
read -p "Enter a password for mysql environment: " PASSWORD
echo
read -p "Enter the username for admin: " ADMIN_USERNAME
read -p "Enter the password for admin: " ADMIN_PASSWORD

# Create a new .env file with the entered password
cat <<EOF > .env
# Environment variables for mysql
MYSQL_USER=moments
MYSQL_ROOT_PASSWORD=\$PASSWORD
MYSQL_PORT=3306
MYSQL_HOST=db-moments
MYSQL_DATABASE=moments
MYSQL_PASSWORD=\$PASSWORD

# Environment variables for admin
ADMIN_USERNAME=\$ADMIN_USERNAME
ADMIN_PASSWORD=\$ADMIN_PASSWORD
ADMIN_EMAIL=\$ADMIN_USERNAME@gmail.com
EOF

echo
echo ".env file created successfully!"
