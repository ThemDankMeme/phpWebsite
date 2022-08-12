<?php
if (!session_id()) session_start();
if ($_SESSION['logon']){
    header("Location:index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>nico-web</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="own_js/signup.js"></script>
    <link rel="stylesheet" href="extra.css">
</head>
<body style="margin-left: 25%;margin-top: 5%; background-color: #262624">
<div id="signup-body">
    <form name="validate" method="post" action="validate-signup.inc.php" style="border: none">
        <div class="form-structure">
            <h1>ACCOUNT REGISTRATION</h1>
            <p>COMPLETE REGISTRATION TO ACCESS NICO's SITE.</p>
            <hr>
            <label for="name"><b>NAME</b></label>
            <input id="name" type="text" placeholder="First Name" name="name" onfocusout="validateName()" required>
            <label for="surname"><b>SURNAME</b></label>
            <input id="surname" type="text" placeholder="Last Name" name="surname" onfocusout="validateSurname()" required>

            <label for="country"><b>COUNTRY</b></label>
            <input id="country" type="text" placeholder="Country" name="country" required>
            <label for="province"><b>PROVINCE</b></label>
            <input id="province" type="text" placeholder="Province" name="province" required>
            <label for="city"><b>CITY</b></label>
            <input id="city" type="text" placeholder="City" name="city" required>
            <label for="address"><b>ADDRESS</b></label>
            <input id="address" type="text" placeholder="Delivery Address" name="address" required>

            <label for="email"><b>EMAIL</b></label>
            <input id="email" type="email" placeholder="Email address" name="email" onfocusout="validateEmail(document.validate.email)" required>
            <label for="cell"><b>CELL PHONE</b></label>
            <input id="cell" type="tel" placeholder="Contact Number" name="cell" required>

            <label for="pwd"><b>PASSWORD</b></label>
            <input id="pwd" type="password" minlength=8 placeholder="Password" name="pwd" onfocusout="password()" required>
            <label for="pwdR"><b>REPEAT PASSWORD</b></label>
            <input id="pwdR" type="password" minlength=8 placeholder="Repeat Password" name="pwdR" onfocusout="validatePassword()" required>
            <label>
                <input type="checkbox" name="tcs"> ACCEPT T's & C's (No need to read them)
            </label>
            <div class="buttons">
                <button type="button" onclick="window.location.href='index.php'" id="cancel">CANCEL</button>
                <button type="submit" id="submit">SUBMIT</button>
            </div>

        </div>
    </form>
</div>
</body>
</html>
