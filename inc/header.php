<?php
                                              #-----------------------------#
                                              #     Author - MI SHAJIB      #
                                              #-----------------------------#

#----------------------------------------------------
# Define File Path
# Include Session.php class.
#----------------------------------------------------
    $filePath = realpath(dirname(__FILE__));
    include_once $filePath.'/../lib/Session.php';
    Session::init();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Registration System with OOP</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
