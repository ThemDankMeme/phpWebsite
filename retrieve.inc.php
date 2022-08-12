<?php
include_once 'config.inc.php';
function retrieve($cat_id):array
{
    $conn = Database::connection();
    $json = $conn->retrieveItem($cat_id);
    $images[]="";
    for ($i=0; $i<3;++$i){
        $img = $json['data'][$i]['photo'];
        $name = $json['data'][$i]['photo_name'];
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $source = "data:image/$ext;base64,$img";
        $images[$i]=$source;
    }
    return $images;
}
function test_user($value): string
{
    $value = trim($value);
    $value = stripcslashes($value);
    return htmlspecialchars($value);
}
function beforeSubmit($search):bool
{
    if($search!= $_POST["search"])
        return false;
    else
        return true;
}
function search($value):array{
    $search = test_user($value);
    $instance = Database::connection();
    if($value=='fashion')
        return $instance->retrieveItem(1);
    elseif($value=='entertainment')
        return $instance->retrieveItem(2);
    elseif($value=='technology')
        return $instance->retrieveItem(3);
    elseif($value=='vehicle')
        return $instance->retrieveItem(4);
    return [];
}
?>
