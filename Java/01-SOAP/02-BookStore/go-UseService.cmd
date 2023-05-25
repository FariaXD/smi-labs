@echo off
echo off

set JAVA_HOME=C:\Java\jdk1.8.0_202

set JAR_FILE=04-Client\target\ServiceBookClient-1.0.0-jar-with-dependencies.jar

set CONF_DIRECTORY=04-Client\conf

%JAVA_HOME%\bin\java -jar %JAR_FILE% --conf %CONF_DIRECTORY%

pause
