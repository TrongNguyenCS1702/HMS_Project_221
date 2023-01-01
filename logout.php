<?php
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['std_id']);
header("Location: login.php");