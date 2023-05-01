#!/bin/bash

JAR_FILE="04-Client/target/ClientServiceBook-1.0.0-jar-with-dependencies.jar"

CONF_DIRECTORY="04-Client/conf"

${JAVA_HOME}/bin/java -Djavax.accessibility.assistive_technologies=" " -jar ${JAR_FILE} --conf ${CONF_DIRECTORY}
