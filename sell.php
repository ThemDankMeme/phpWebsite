<?php
if (!session_id()) session_start();
if (!$_SESSION['logon']){
    header("Location:index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="own_js/sellItems.js"></script>
    <script type="text/javascript" src="own_js/signup.js"></script>
</head>
<body>
<?php include 'header.inc.php' ?>
<div class="container">
<form method="post" enctype="multipart/form-data" action="upload.inc.php">
    <div class="row">
        <div class="form-group col-md-4">
            <label for="product_name">Product</label>
            <input type="text"  class="form-control" id="product_name" name="product_name" placeholder="What is your Product" required>
        </div>
        <div class="form-group col-md-4">
            <label for="category">Category</label>
            <select id="category" class="form-control" name="category" required>
                <option name="fashion" selected value="fashion">Fashion</option>
                <option name="technology" value="technology">Technology</option>
                <option name="entertainment" value="entertainment">Entertainment</option>
                <option name="vehicle" value="vehicle">Vehicle</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="quantity">Quantity</label>
            <input type="number" maxlength="2" name="quantity" class="form-control" id="quantity" placeholder="Enter Quantity" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-7">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" placeholder="Email address" class="form-control" onfocusout="validateEmail(document.validate.email)" required>
        </div>
        <div class="form-group col-md-3">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" id="price" placeholder="Enter Price" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-7">
            <label for="image" class="form-label">Upload Product Image</label>
            <input name="image" class="form-control" type="file" accept=".png, .jpg, .jpeg, .webp, .gif" id="image">
        </div>

    </div>
    <button type="submit" class="btn btn-primary" >SELL</button>
</form>
</div>
</body>
</html>