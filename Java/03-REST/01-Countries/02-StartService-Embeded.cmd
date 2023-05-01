@echo off
echo off

set JAVA_HOME=C:\Java\jdk-11.0.10

set JAR_FILE=04-DeployEmbeded\target\ServiceCountriesDeployStandalone-1.0.0-jar-with-dependencies.jar

set PORT=8084

%JAVA_HOME%\bin\java -jar %JAR_FILE% --port %PORT%

pause
