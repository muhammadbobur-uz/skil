<?php

require '../config.php';

class analiz {

    public $con;
    public $secret;

    public function __construct() {
        $this->secret = new security();
        $this->con = new mysqli($this->secret->servername, $this->secret->username, $this->secret->password, $this->secret->database);
    }
// jhdsjahsdhshfkahewfkahewkuf
    public function select() {
        $sql = "SELECT * FROM client";
        $res = $this->con->query($sql);

        while ($row = mysqli_fetch_assoc($res)) {
            $prnt[] = $row;
            echo '<pre>' . print_r($prnt, 1) . '</pre>';
        }
    }

    public function create() {
        $sql = "create table example (id int(11), name varchar(35), phone varchar(30))";
        $res = $this->con->query($sql);
    }

    public function insert($id, $name, $phone) {
        echo $id . '<br>' . $name . '<br>' . $phone;
        $sql = "insert into example values($id,'$name','$phone')";
        $res = $this->con->query($sql);
    }

    public function send_sms($phone, $message) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->secret->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            "login" => $this->secret->login,
            "pwd" => $this->secret->pwd,
            "CgPN" => $this->secret->CgPN,
            "CdPN" => $phone,
            "text" => $message
                        ], JSON_UNESCAPED_UNICODE));
        $result = json_decode(curl_exec($ch), true);
        curl_close($ch);
    }

}

$data = new analiz();
echo $data->select();
//$data3 = new analiz();
//$data3->insert(45, 'Ali', +998911234567)
$data2 = new analiz();
$data2->send_sms('998909968395', 'A3caerfverthyj576uj')
//var_dump($prnt)
?>