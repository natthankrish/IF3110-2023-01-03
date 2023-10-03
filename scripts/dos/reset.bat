@echo off
setlocal

REM Delete .env file
if exist ".env" (
    del ".env"
    echo .env deleted successfully.
) else (
    echo .env does not exist.
)
echo.

REM Delete mysql folder
set "folderName=mysql"

REM Combine the current path and the mysql folder
set "folderPath=%cd%\%folderName%"

REM Check if the folder exists before attempting to delete it
if exist "%folderPath%" (
    rmdir /s /q "%folderPath%"
    echo mysql folder deleted successfully.
) else (
    echo mysql folder does not exist.
)
echo.

endlocal

REM Delete the Docker image with the tag "moments:latest"
docker rmi moments:latest