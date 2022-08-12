<?php
include_once 'config.inc.php';
class validateLogin{
    private $instance=null;
    private function __construct(){
        $this->instance = Database::connection();
    }
    public function __destruct(){
        $this->instance = null;
    }
    public static function connection(): validateLogin{
        static $instance = null;
        if($instance===null)
            $instance = new validateLogin();
        return $instance;
    }
    public function validate($POST):string{
        $_POST = $POST;
        $mail = $this->test_user($_POST["email"]);
        $pwd = $this->test_user($_POST["pwd"]);
        $valid = $this->beforeSubmit($mail, $pwd);
        if (!$valid) {
            $json = ["status" => "failed", "message" => "Not so quick..."];
        }
        else {
            $user = $this->instance->findUser($mail, $pwd);
            if ($user == "NoUser") {
                $json = ["status" => "failed", "message" => "user"];
            } elseif ($user == "InvalidPassword") {
                $json = ["status" => "failed", "message" => "invalid"];
            } elseif ($user == "") {
                $json = ["status" => "failed", "message" => "unexpected"];
            } else {
                if (!session_id())
                    session_start();
                $_SESSION['email'] = $mail;
                $_SESSION['start'] = time();
                $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
                $_SESSION['logon'] = true;
                $_SESSION['user'] = $this->instance->userName($mail);
                setcookie("email", $_SESSION['email'], time()+(30*60));
                $json = ["status" => "success"];
            }
        }
        return json_encode($json);
    }
    private function test_user($value): string
    {
        $value = trim($value);
        $value = stripcslashes($value);
        return htmlspecialchars($value);
    }

    private function beforeSubmit($mail, $pwd): bool
    {
        if ($mail != $_POST["email"])
            return false;
        elseif ($pwd != $_POST["pwd"])
            return false;
        else return true;
    }
}
?>