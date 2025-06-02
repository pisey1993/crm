@echo off
cd /d "C:\laragon2\www\crm"

echo ========================================
echo Updating Git repository at C:\laragon2\www\crm
echo ========================================

git pull origin main

echo.
echo Update complete.
pause
