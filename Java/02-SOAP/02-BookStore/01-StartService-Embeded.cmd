@echo off
echo off

set JAVA_HOME=C:\Java\jdk-11.0.10

set JAR_FILE=03-DeployEmbeded\target\ServiceBookDeployStandalone-1.0.0-jar-with-dependencies.jar

set ENDPOINT=http://0.0.0.0:8082/serviceBookStore

set CONF_DIRECTORY=03-DeployEmbeded\conf

%JAVA_HOME%\bin\java -jar %JAR_FILE% --conf %CONF_DIRECTORY% --endPoint %ENDPOINT%

pause
