<?php

    session_start();

    session_unset();
    session_destroy();

    header("Location: http://localhost/Registration%20System/login.php");




?>