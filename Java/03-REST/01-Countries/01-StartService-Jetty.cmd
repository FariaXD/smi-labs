@echo off
echo off

set JAVA_HOME=C:\Java\jdk-11.0.10

cd 03-DeployJetty

mvn jetty:run -Djetty.http.port=8083

pause