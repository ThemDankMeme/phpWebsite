<?php
if (!session_id()) session_start();
if ($_SESSION['logon']){
    header("Location:index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8">
    <title>nico-web</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="own_js/login.js"></script>
    <script type="text/javascript" src="own_js/signup.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="extra.css">
    <style>
        b {
            margin-left: 15px;
            font-size: larger;
        }
    </style>
</head>
<body style="margin-left: 25%;margin-top: 5%; background-color:#262624">
<div id="login-body">
    <form name="validate">
        <div class="form-structure">
            <h1>LOGIN FOR NICO's SITE</h1>
            <hr>
            <label for="email"><b>EMAIL</b></label>
            <input id="email" type="email" placeholder="Email address" name="email" onfocusout="validateEmail()" required>
            <label for="pwd"><b>PASSWORD</b></label>
            <input id="pwd" type="password" minlength=8 placeholder="Password" name="pwd" onfocusout="password()" required>
            <div class="buttons">
                <button type="button" onclick="window.location.href='index.php'" id="cancel">CANCEL</button>
                <button type="submit" id="submit" onclick="postData()">SUBMIT</button>
            </div>
        </div>
    </form>
    <a href="signup.php" style="text-decoration: none; margin-left: 50px ">Not Registered?</a>
</div>


</body>
</html>
