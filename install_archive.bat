@echo off
mkdir temp
robocopy upload temp /E
cd temp
set PATH=%PATH%;%ProgramFiles%\7-Zip\
7z u -tzip -mx1 _temp.zip *
cd ..
copy /Y temp\_temp.zip install.zip
rd /s /q temp
exit;
