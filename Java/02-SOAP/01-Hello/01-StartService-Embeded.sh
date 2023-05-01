#!/bin/bash

JAR_FILE="03-DeployEmbeded/target/ServiceHelloDeployStandalone-1.0.0-jar-with-dependencies.jar"

ENDPOINT="http://0.0.0.0:8081/serviceHello"

${JAVA_HOME}/bin/java -jar ${JAR_FILE} --endPoint ${ENDPOINT}
