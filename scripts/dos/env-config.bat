@echo off
setlocal enabledelayedexpansion

REM Prompt the user for a password
set /p "PASSWORD=Enter a password for mysql environment: "

REM Create a new .env file with the entered password
(
  echo # Environment variables for mysql
  echo MYSQL_USER=root
  echo MYSQL_ROOT_PASSWORD=!PASSWORD!
  echo MYSQL_PORT=3306
  echo MYSQL_HOST=db-moments
  echo MYSQL_DATABASE=moments
  echo MYSQL_PASSWORD=!PASSWORD!
) > .env

echo.
echo .env file created successfully!