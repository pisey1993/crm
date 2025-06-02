@echo off
cd /d "C:\laragon2\www\crm"

:: Prompt for a commit message
set /p msg=Enter commit message: 

echo.
echo Adding all changes...
git add .

echo.
echo Committing with message: %msg%
git commit -m "%msg%"

echo.
echo Pushing to current branch...
git push

echo.
echo Git push complete.
pause
