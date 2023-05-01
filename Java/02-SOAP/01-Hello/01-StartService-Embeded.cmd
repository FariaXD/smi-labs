@echo off
echo off

set JAVA_HOME=C:\Java\jdk-11.0.10

set JAR_FILE=03-DeployEmbeded\target\ServiceHelloDeployStandalone-1.0.0-jar-with-dependencies.jar

set ENDPOINT=http://0.0.0.0:8081/serviceHello

"%JAVA_HOME%"\bin\java -jar %JAR_FILE% --endPoint %ENDPOINT%

pause
