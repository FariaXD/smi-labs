@echo off
echo off

set JAVA_HOME=C:\Java\jdk1.8.0_202

set JAR_FILE=04-Hello-Client-CLI\target\ServiceHelloClientCLI-1.0.0-jar-with-dependencies.jar

set END_POINT=http://localhost:7080/ServiceHelloImplementationTomcat-1.0.0/hello?WSDL

%JAVA_HOME%\bin\java -jar %JAR_FILE% -e %END_POINT% -a "SMI Rocks - Tomcat"

pause
