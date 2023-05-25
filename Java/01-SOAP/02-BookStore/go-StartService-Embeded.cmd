@echo off
echo off

set JAVA_HOME=C:\Java\jdk1.8.0_202

set JAR_FILE=03-DeployStandalone\target\ServiceBookDeployStandalone-1.0.0-jar-with-dependencies.jar

set END_POINT=http://0.0.0.0:8082/serviceBookStore

set CONF_DIRECTORY=03-DeployStandalone\conf

%JAVA_HOME%\bin\java -jar %JAR_FILE% --conf %CONF_DIRECTORY% --endPoint %END_POINT%

pause
