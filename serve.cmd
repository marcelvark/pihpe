@echo off

rem   This is just to make my life easier. It starts PHP and opens the browser.
rem   -------------------------------------------------------------------------

rem   I recommend you put this file in a higher folder, and use:
rem   cd "website"
rem   to make it the current directory. Then start your PHP development server:
start "PHP" "C:\php-7.0.24-Win32-VC14-x86\php.exe" -S localhost:8080 -c php.ini
rem   You may use a local php.ini file to override default PHP settings.

rem   Target a specific browser by adding its name between start and localhost:
start http://localhost:8080