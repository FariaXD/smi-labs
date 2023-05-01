@echo off
echo off

set JAVA_HOME=C:\Java\jdk-11.0.10

set JAR_FILE=04-Client\target\ClientServiceBook-1.0.0-jar-with-dependencies.jar

set CONF_DIRECTORY=04-Client\conf

"%JAVA_HOME%"\bin\java -jar %JAR_FILE% --conf %CONF_DIRECTORY%

pause
