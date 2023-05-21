<?php
session_start(); // Start the session
session_unset();
session_destroy();
header("location: index.html");
