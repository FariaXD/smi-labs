#!/bin/bash

cd 03-DeployJetty

mvn jetty:run -Djetty.http.port=8083
