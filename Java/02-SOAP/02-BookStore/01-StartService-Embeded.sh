#!/bin/bash

JAR_FILE="03-DeployEmbeded/target/ServiceBookDeployStandalone-1.0.0-jar-with-dependencies.jar"

ENDPOINT="http://0.0.0.0:8082/serviceBookStore"

CONF_DIRECTORY="03-DeployEmbeded/conf"

${JAVA_HOME}/bin/java -jar ${JAR_FILE} --endPoint ${ENDPOINT} --conf ${CONF_DIRECTORY}