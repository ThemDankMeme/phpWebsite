<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="background-color: #4f5050">
<?php include_once 'header.inc.php'?>
<?php
if (!session_id()) session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include_once 'retrieve.inc.php';
    $res[]="";
    if($_POST['search']=='fashion'){
        $res = search('fashion');
    }
    elseif ($_POST['search']=='entertainment'){
        $res = search('entertainment');
    }
    elseif ($_POST['search']=='technology'){
        $res = search('technology');
    }
    elseif ($_POST['search']=='vehicle'){
        $res = search('vehicle');
    }
    else{
        echo("<h1>OOPS NO CODE FOR THAT</h1>");
    }
    $images[]="";
    for($i=0; $i<3;++$i){
        $img = $res['data'][$i]['photo'];
        $name = $res['data'][$i]['photo_name'];
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $source = "data:image/$ext;base64,$img";
        $images[$i]=$source;
    }


}
else
    echo('NOT working');
?>
<div class="container">
        <div class="col-lg-4" style="background-color: #f8f9fa">
            <div class="card" style="border-radius: 15px;">
                <div class="bg-image hover-overlay ripple ripple-surface ripple-surface-light"
                     data-mdb-ripple-color="light">
                    <img src="<?php print_r($images[0])?>" class="d-block w-50" alt="..." height="200px">
                </div>
                <div class="card-body pb-0">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p><a class="text-dark"><?php print_r($res['data'][0]['prod_name'])?></a></p>
                            <p class="small text-muted"><?php print_r($res['data'][0]['category'])?></p>
                        </div>
                        <div>
                            <div class="d-flex flex-row justify-content-end mt-1 mb-4 text-danger">
                                <?php print_r($res['data'][0]['seller_name'])?>
                            </div>
                            <p class="small text-muted"><?php print_r($res['data'][0]['email'])?></p>
                        </div>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body pb-0">
                    <div class="d-flex justify-content-between">
                        <p><a class="text-dark">R <?php print_r($res['data'][0]['price'])?></a></p>
                    </div>
                </div>
                <hr class="my-0" />
            </div>
        </div>
    <div class="col-lg-4" style="background-color: #f8f9fa">
        <div class="card" style="border-radius: 15px;">
            <div class="bg-image hover-overlay ripple ripple-surface ripple-surface-light"
                 data-mdb-ripple-color="light">
                <img src="<?php print_r($images[1])?>" class="d-block w-50" alt="..." height="200px">
            </div>
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between">
                    <div>
                        <p><a class="text-dark"><?php print_r($res['data'][1]['prod_name'])?></a></p>
                        <p class="small text-muted"><?php print_r($res['data'][1]['category'])?></p>
                    </div>
                    <div>
                        <div class="d-flex flex-row justify-content-end mt-1 mb-4 text-danger">
                            <?php print_r($res['data'][0]['seller_name'])?>
                        </div>
                        <p class="small text-muted"><?php print_r($res['data'][1]['email'])?></p>
                    </div>
                </div>
            </div>
            <hr class="my-0" />
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between">
                    <p><a class="text-dark">R <?php print_r($res['data'][1]['price'])?></a></p>
                </div>
            </div>
            <hr class="my-0" />
        </div>
    </div>
    <div class="col-lg-4" style="background-color: #f8f9fa">
        <div class="card" style="border-radius: 15px;">
            <div class="bg-image hover-overlay ripple ripple-surface ripple-surface-light"
                 data-mdb-ripple-color="light">
                <img src="<?php print_r($images[2])?>" class="d-block w-50" alt="..." height="200px">
            </div>
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between">
                    <div>
                        <p><a class="text-dark"><?php print_r($res['data'][2]['prod_name'])?></a></p>
                        <p class="small text-muted"><?php print_r($res['data'][2]['category'])?></p>
                    </div>
                    <div>
                        <div class="d-flex flex-row justify-content-end mt-1 mb-4 text-danger">
                            <?php print_r($res['data'][0]['seller_name'])?>
                        </div>
                        <p class="small text-muted"><?php print_r($res['data'][2]['email'])?></p>
                    </div>
                </div>
            </div>
            <hr class="my-0" />
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between">
                    <p><a class="text-dark">R <?php print_r($res['data'][2]['price'])?></a></p>
                </div>
            </div>
            <hr class="my-0" />
        </div>
    </div>
</div>
</body>
</html>
