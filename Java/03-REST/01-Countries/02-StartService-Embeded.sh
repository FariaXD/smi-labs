#!/bin/bash

JAR_FILE="04-DeployEmbeded/target/ServiceCountriesDeployStandalone-1.0.0-jar-with-dependencies.jar"

PORT="8084"

${JAVA_HOME}/bin/java -jar ${JAR_FILE} --port ${PORT}