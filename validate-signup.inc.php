<?php
include_once 'config.inc.php';
$name = $surname = $mail = $pwd = $pwdR = $country = $province = $city = $address = $cell = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = test_user($_POST["name"]);
    $surname = test_user($_POST["surname"]);
    $country = test_user($_POST["country"]);
    $province = test_user($_POST["province"]);
    $city = test_user($_POST["city"]);
    $address = test_user($_POST["address"]);
    $mail = test_user($_POST["email"]);
    $cell = test_user($_POST["cell"]);
    $pwd = test_user($_POST["pwd"]);
    $pwdR = test_user($_POST["pwdR"]);
    $valid = beforeSubmit($name, $surname, $country, $province, $city, $address, $mail, $cell, $pwd, $pwdR);
    if(!$valid){
        echo "Not so quick...";
    }
    else{
        $instance = Database::connection();
        $temp = $instance->addUser($name, $surname, $mail, $cell, $pwd, $country, $province, $city, $address);
        if($temp){
            echo "<script type='text/javascript'>alert('User created: $name');</script>";
            $message = "Account Created: ".$mail." at ".date_create()->format('Y-m-d H:i:s');
            error_log($message);
            header('Location: login.php');
        }
        else{
            echo "<script type='text/javascript'>alert('Failed to create account for: $mail');</script>";
        }
        die();
    }
}

function test_user($value): string
{
    $value = trim($value);
    $value = stripcslashes($value);
    return htmlspecialchars($value);
}
function beforeSubmit($name, $surname, $country, $province, $city, $address, $mail, $cell, $pwd, $pwdR): bool
{
    if($name!= $_POST["name"])
        return false;
    elseif ($surname!= $_POST["surname"])
        return false;
    elseif ($country!= $_POST["country"])
        return false;
    elseif ($province!= $_POST["province"])
        return false;
    elseif ($city!= $_POST["city"])
        return false;
    elseif ($address!= $_POST["address"])
        return false;
    elseif ($mail!= $_POST["email"])
        return false;
    elseif ($cell!= $_POST["cell"])
        return false;
    elseif ($pwd!= $_POST["pwd"])
        return false;
    elseif ($pwdR!= $_POST["pwdR"])
        return false;
    else
        return true;
}
?>