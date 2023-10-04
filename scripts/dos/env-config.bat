@echo off
setlocal enabledelayedexpansion

REM Prompt the user for a password
set /p "PASSWORD=Enter a password for mysql environment: "
echo.
set /p "ADMIN_USERNAME=Enter the username for admin: "
set /p "ADMIN_PASSWORD=Enter the password for admin: "

REM Create a new .env file with the entered password
(
  echo # Environment variables for mysql
  echo MYSQL_USER=moments
  echo MYSQL_ROOT_PASSWORD=!PASSWORD!
  echo MYSQL_PORT=3306
  echo MYSQL_HOST=db-moments
  echo MYSQL_DATABASE=moments
  echo MYSQL_PASSWORD=!PASSWORD!
  echo.
  echo # Environment variables for admin
  echo ADMIN_USERNAME=!ADMIN_USERNAME!
  echo ADMIN_PASSWORD=!ADMIN_PASSWORD!
  echo ADMIN_EMAIL=!ADMIN_USERNAME!@gmail.com
) > .env

echo.
echo .env file created successfully!