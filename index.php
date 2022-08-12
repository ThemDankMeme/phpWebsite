<?php
if (!session_id()) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="background-color: #4f5050">
    <?php include 'header.inc.php' ?>
    <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6" >
                    <?php include 'fashionCar.inc.php' ?>
                </div>
                <div class="col-lg-6" >
                    <?php include 'entertainmentCar.inc.php' ?>
                </div>
            </div>
            <div class="row" style="height: 200px">
                <div class="col-lg-6" >
                    <?php include 'vehicleCar.inc.php' ?>
                </div>
                <div class="col-lg-6" >
                    <?php include 'techCar.inc.php' ?>
                </div>
            </div>
            <div class="row" style="margin-inline-start: 25px; margin-top: 20px">
                <div class="col-lg-12">
                <a href="https://www.fnb.co.za/" target="_blank"><img src="img/fnb.png" class="img-fluid" alt=""></a>
                <a href="https://www.absa.co.za/personal/" target="_blank"><img src="img/absa.png" class="img-fluid" alt=""></a>
                <a href="https://www.capitecbank.co.za/" target="_blank"><img src="img/capitech.png" class="img-fluid" alt=""></a>
                <a href="https://www.nedbank.co.za/" target="_blank"><img src="img/nedbank.png" class="img-fluid" alt=""></a>
                </div>
            </div>
    </div>
</body>
</html>