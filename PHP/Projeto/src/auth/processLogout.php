﻿<?php
session_start();
session_destroy();
$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME');
$serverPort = 81;
header("Location: http://$serverName:$serverPort/examples-smi/Projeto/src");
?>