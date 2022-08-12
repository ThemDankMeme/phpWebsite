<?php
$GLOBALS["argon"]=["pass"=>["method"=>"argon2i", "version"=>"v=19", "spec"=>"m=65536,t=4,p=1"]];
$GLOBALS["config"] =["database" => ["host" => "wheatley.cs.up.ac.za",
    "dbname" => "u18059288",
    "user"=>"u18059288",
    "pass"=>"BLTWTB4Q45KIHNFPRJBODJ3LEXSCZHDU"]];
class Database{
    protected $conn=null;
    public static function connection(): Database
    {
        static $instance = null;
        if($instance===null)
            $instance = new Database();
        return $instance;
    }
    private function __construct()
    {
        $host=$GLOBALS["config"]["database"]["host"];
        $db = $GLOBALS["config"]["database"]["dbname"];
        $username=$GLOBALS["config"]["database"]["user"];
        $password =$GLOBALS["config"]["database"]["pass"];
        try{
            $this->conn = new PDO("mysql:host=$host; dbname=$db", $username, $password);
            $this->conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $message = "Connection Success: ".$username." at ".date_create()->format('Y-m-d H:i:s');
            error_log($message);
        }
        catch (PDOException $err){
            $message = "Connection Failed: ".$username." at ".date_create()->format('Y-m-d H:i:s')." with error ".$err->getMessage();
            error_log($message);
        }
    }
    public function __destruct()
    {
        $this->conn =null;
    }
    public function addUser($name, $surname, $mail, $cell, $pwd, $country, $province, $city, $address): bool
    {
        session_start();
        $table = $GLOBALS["config"]["database"]["dbname"];
        $pwdHash=$this->hashPassword($pwd);
        $arr = $this->cleanPassword($pwdHash);
        $pwdHash = $arr[4]."$".$arr[5];
        try {
            $sql = "INSERT INTO $table.users (first_name, last_name, email, cellphone, password) VALUES (?, ?, ?, ?, ?)";
            if (!$this->confirmMail($mail)) {
                error_log("Failed to add: " . $mail . " already exists.");
                echo "<script type='text/javascript'>alert('Account already exists: $mail');</script>";
                return false;
            }
            else {
                $query = $this->conn->prepare($sql);
                $query->execute([$name, $surname, $mail, $cell, $pwdHash]);
                $sql = "SELECT user_id FROM $table.users WHERE email=?";
                $query = $this->conn->prepare($sql);
                $query->execute([$mail]);
                $user_id = $query->fetch();
                $user_id = $user_id[0];
                $country_id = $this->addEntity('country', $country);
                $province_id = $this->addEntity('province', $province);
                $city_id = $this->addEntity('city', $city);
                $sql = "INSERT INTO $table.address (country_id, province_id, city_id, street, user_id) VALUES (?,?,?,?,?)";
                $query =$this->conn->prepare($sql);
                $query->execute([$country_id, $province_id, $city_id, $address, $user_id]);
                return true;
            }

        }
        catch (PDOException $err){
            error_log("Failed to add user - Error:  ".$err->getMessage()." at ".date_create()->format('Y-m-d H:i:s'));
            return false;
        }
    }
    public function sellItem($prod_name, $mail, $price, $amount, $category): bool{
        $table = $GLOBALS["config"]["database"]["dbname"];
        try {
            $sql = "SELECT user_id FROM $table.users WHERE email=?";
            $query = $this->conn->prepare($sql);
            $query->execute([$mail]);
            $user_id = $query->fetch();
            $user_id = $user_id[0];
            $category_id = $this->searchID('category', $category);
            if (isset($_FILES['image'])) {
                $sql = "INSERT INTO $table.products (product_name, seller_id, product_price, amount, photo_name, photo, category_id) 
                        VALUES (?,?,?,?,?,?,?)";
                $query = $this->conn->prepare($sql);
                $query->execute([$prod_name, $user_id, $price, $amount,
                    $_FILES['image']['name'] ,file_get_contents($_FILES['image']['tmp_name']), $category_id]);
            } else {
                $sql = "INSERT INTO $table.products (product_name, seller_id, product_price, amount, category_id) VALUES (?,?,?,?,?)";
                $query = $this->conn->prepare($sql);
                $query->execute([$prod_name, $user_id, $price, $amount, $category_id]);
            }
            return true;
        }
        catch (PDOException $err){
            error_log("Failed to list new product - Error:  ".$err->getMessage()." at ".date_create()->format('Y-m-d H:i:s'));
            return false;
        }
    }
    public function retrieveItem($cat_id) :array{
        $table = $GLOBALS["config"]["database"]["dbname"];
        try{
            $sql = "SELECT product_name, product_price, amount, photo_name, photo, users.first_name, categories.category_name, users.email
                    FROM $table.products 
                    INNER JOIN users ON products.seller_id=users.user_id 
                    INNER JOIN categories ON products.category_id=categories.category_id 
                    WHERE products.category_id=?";
            $query = $this->conn->prepare($sql);
            $query->execute([$cat_id]);
            $json['status']="success";
            for ($i=0; $i<3; ++$i){
                $res = $query->fetch();
                $json['data'][]= ['seller_name'=> $res[5], 'category'=>$res[6], 'prod_name'=>$res[0],
                    'price'=>$res[1], 'amount'=>$res[2], 'photo_name'=>$res[3], 'photo'=>base64_encode($res[4]), 'email'=>$res[7]];
            }
        }
        catch (PDOException $err){
            error_log("Failed to retrieve - Error:  ".$err->getMessage()." at ".date_create()->format('Y-m-d H:i:s'));
            $json['status']='failed';
        }
        return $json;
    }
    public function addEntity($type, $value): int{
        $table = $GLOBALS["config"]["database"]["dbname"];
        $res = $this->searchID($type, $value);
        if($res==0) {
            $sql ='';
            if($type=='country'){
                $sql = "INSERT INTO $table.countries (country_name) VALUES (?)";
            }
            elseif ($type=='province'){
                $sql = "INSERT INTO $table.provinces (province_name) VALUES (?)";
            }
            elseif ($type=='city'){
                $sql = "INSERT INTO $table.cities (city_name) VALUES (?)";
            }
            $query = $this->conn->prepare($sql);
            $query->execute([$value]);
            $res = $this->searchID($type, $value);
        }
        return $res;
    }
    private function searchID($type, $val):int
    {
        $table = $GLOBALS["config"]["database"]["dbname"];
        $sql='';
        if($type=='country')
            $sql = "SELECT country_id FROM $table.countries WHERE country_name=?";
        elseif ($type=='province')
            $sql = "SELECT province_id FROM $table.provinces WHERE province_name=?";
        elseif ($type=='city')
            $sql = "SELECT city_id FROM $table.cities WHERE city_name=?";
        elseif ($type=='address')
            $sql = "SELECT address_id FROM $table.address WHERE street=?";
        elseif ($type=='category'){
            $sql = "SELECT category_id FROM $table.categories WHERE category_name=?";
        }
        $query = $this->conn->prepare($sql);
        $query->execute([$val]);
        if($query->rowCount()==0)
            return 0;
        else{
            $res = $query->fetch();
            return $res[0];
        }
    }

    private function hashPassword($pwd): string
    {
        return password_hash($pwd,PASSWORD_ARGON2I);
    }
    private function cleanPassword($pwd):array
    {
        return explode('$', $pwd);
    }
    private function confirmMail($mail): bool
    {
        $table = $GLOBALS["config"]["database"]["dbname"];
        $sql = "SELECT email FROM $table.users WHERE email=?";
        $val = $this->conn->prepare($sql);
        $val->execute([$mail]);
        if($val->rowCount()!=0)
            return false;
        else return true;
    }
    public function findUser($mail, $pwd):string
    {
        $valid = $this->confirmMail($mail);
        if($valid)
            return "NoUser";
        else{
            try {
                $table = $GLOBALS["config"]["database"]["dbname"];
                $sql = "SELECT password FROM $table.users where email=?";
                $val = $this->conn->prepare($sql);
                $val->execute([$mail]);
                $result = $val->fetch();
                $pwdHash = "$".$GLOBALS["argon"]["pass"]["method"]."$".$GLOBALS["argon"]["pass"]["version"]."$".$GLOBALS["argon"]["pass"]["spec"]."$".$result[0];
                if(password_verify($pwd, $pwdHash)){
                    return $mail;
                }
                else
                    return "InvalidPassword";
            }
            catch (PDOException $err) {
                error_log("Failed at Login: ".$err->getMessage()." at ".date_create()->format('Y-m-d H:i:s'));
                return "";
            }
        }
    }
    public function userName($mail):string{
        if(!$this->confirmMail($mail)){
            $table = $GLOBALS["config"]["database"]["dbname"];
            $sql = "SELECT first_name FROM $table.users where email=?";
            $val = $this->conn->prepare($sql);
            $val->execute([$mail]);
            $result = $val->fetch();
            return $result[0];
        }
        else
            return "";
    }
    public function selectUser($mail):array
    {
        $sql = "SELECT * FROM users where email=?";
        $val = $this->conn->prepare($sql);
        $val->execute([$mail]);
        return $val->fetchAll();
    }

    public function changePassword($mail, $pwd, $pwdNew):bool{
        if(!$this->confirmMail($mail)){
            $sql = "SELECT users.password FROM users where email=?";
            $val = $this->conn->prepare($sql);
            $val->execute([$mail]);
            $result = $val->fetch();
            $pwdHash = "$".$GLOBALS["argon"]["pass"]["method"]."$".$GLOBALS["argon"]["pass"]["version"]."$".$GLOBALS["argon"]["pass"]["spec"]."$".$result[0];
            if(password_verify($pwd, $pwdHash)){
                $pwdHash=$this->hashPassword($pwdNew);
                $arr = $this->cleanPassword($pwdHash);
                $pwdHash = $arr[4]."$".$arr[5];
                $sql = "UPDATE users SET users.password =? WHERE users.email=?";
                $val = $this->conn->prepare($sql);
                $val->execute([$pwdHash, $mail]);
                return true;
            }
            else return false;
        }
        else return false;
    }
}
?>
