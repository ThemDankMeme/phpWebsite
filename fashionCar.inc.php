<?php
include_once 'retrieve.inc.php';
    $GLOBALS['img']['fashion'] = retrieve(1);
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner" style="background-color: #4f5050">
        <div class="carousel-item active">
            <div class="d-flex justify-content-center">
                <img src="<?php print_r($GLOBALS['img']['fashion'][0])?>" class="d-block w-50" alt="..." height="200px" >
            </div>
        </div>
        <div class="carousel-item">
            <div class="d-flex justify-content-center">
                <img src="<?php print_r($GLOBALS['img']['fashion'][1])?>" class="d-block w-50" alt="..." height="200px">
            </div>
        </div>
        <div class="carousel-item">
            <div class="d-flex justify-content-center">
                <img src="<?php print_r($GLOBALS['img']['fashion'][2])?>" class="d-block w-50" alt="..." height="200px">
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

