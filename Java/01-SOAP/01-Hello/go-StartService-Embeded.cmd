@echo off
echo off

set JAVA_HOME="C:\Program Files\Java\jdk-17.0.5"

set JAR_FILE=02-Hello-ServiceImplementation-Standalone\target\ServiceHelloImplementationStandalone-1.0.0-jar-with-dependencies.jar

set END_POINT=http://0.0.0.0:8081/serviceHello

%JAVA_HOME%\bin\java -jar %JAR_FILE% --endPoint %END_POINT%

pause
