@echo off
echo off

set JAVA_HOME=C:\Java\jdk-11.0.10

rem Default values

set DefaultServicePort=9080
set DefaultServicePath=ServiceHelloDeployTomcat-1.0.0

rem Don't need to modify from this point

set SleepTime=10

set ServicePort=
set ServicePath=

setlocal enableextensions enabledelayedexpansion

if [%1%]==[] (
	set /p ServicePort="Type service port [%DefaultServicePort%]: "
	if [!ServicePort!]==[] (
		set ServicePort=%DefaultServicePort%
	)
) else (
	set ServicePort=%1%
)

if [%2%]==[] (
	set /p ServicePath="Type service lookup port [%DefaultServicePath%]: "
	if [!ServicePath!]==[] (
		set ServicePath=%DefaultServicePath%
	)
) else (
	set ServicePath=%2%
)

set JAR_FILE=04-Client\target\ClientServiceHello-1.0.0-jar-with-dependencies.jar

set ENDPOINT=http://localhost:%ServicePort%/%ServicePath%/serviceHello

set ARGS="SMI Rocks"

"%JAVA_HOME%"\bin\java -jar %JAR_FILE% --endPoint %ENDPOINT% --arg %ARGS%

pause
