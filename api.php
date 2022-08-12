<?php
include_once 'config.inc.php';
include_once 'validate-login.inc.php';
class API{
    private $instance=null;
    private function __construct(){
        $this->instance = Database::connection();
    }

    public function __destruct(){
        $this->instance=null;
    }

    public static function connection(): API{
        static $instance = null;
        if($instance===null)
            $instance = new API();
        return $instance;
    }

    public function checkValid($mail, $pwd):bool{
        $res = $this->instance->findUser($mail, $pwd);
        if($res==$mail)
            return true;
        else return false;
    }

    public function setGeneric($status, $code, $data):string{
        $json['status']=$status;
        $json['code']= $code;
        $json['timestamp']=time();
        $json['data']=['Error'=>$data];
        return json_encode($json);
    }
}
if($_SERVER['REQUEST_METHOD']=='POST') {
    $_POST = (json_decode(file_get_contents("php://input"), true));
    if (isset($_POST['type'])) {
        $instance = API::connection();
        if ($_POST['type'] == "login") {
            $login = validateLogin::connection();
            $res = $login->validate($_POST);
        }
        elseif ($_POST['type'] == "chat") {
            $res = $instance->setGeneric('Failed', 404, 'Method not yet implemented');
        }
        else {
            $res = $instance->setGeneric('Failed', 406, 'NO METHOD MATCHING FOUND');
        }
        echo $res;
        return $res;
    }
}
?>
