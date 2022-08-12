<?php
include_once 'config.inc.php';
$product_name = $category = $quantity = $email = $price = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $product_name = test_user($_POST['product_name']);
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $email = test_user($_POST['email']);
    $price = $_POST['price'];
    $valid = beforeSubmit($product_name, $email);
    if(!$valid){
        echo "Not so quick...";
    }
    else{
        $instance = Database::connection();
        $imageName = $_FILES['image']['name'];
        $imageFileType = strtolower(pathinfo($imageName,PATHINFO_EXTENSION));
        $temp = false;
        if ($_FILES["image"]["size"] > 204800000)
            echo "<script type='text/javascript'>alert('Image too Large: $imageName');</script>";
        elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" && $imageFileType!= "webp") {
            echo "<script type='text/javascript'>alert('File type Not supported: $imageFileType');</script>";
        }else
            $temp = $instance->sellItem($product_name, $email, $price, $quantity, $category);
        if($temp){
            echo "<script type='text/javascript'>alert('Item Listed: $product_name');</script>";
            header('Location: index.php');
        }
        else{
            echo "<script type='text/javascript'>alert('Failed to list item: $product_name');</script>";
            header('Location: sell.php');
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
function beforeSubmit($product_name, $email): bool
{
    if ($email != $_POST["email"])
        return false;
    elseif ($product_name != $_POST["product_name"])
        return false;
    else return true;
}
?>