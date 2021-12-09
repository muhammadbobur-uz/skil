<?php

require '../config.php';

class analiz {

    public $con;
    public $secret;

    public function __construct() {
        $this->secret = new security();
        $this->con = new mysqli($this->secret->servername, $this->secret->username, $this->secret->password, $this->secret->database);
    }

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


}

$data = new analiz();
echo $data->select();
$data3 = new analiz();
$data3->insert(45, 'Ali', +998911234567)
//$data2 = new analiz();
//$data2->send_sms('998909968395', 'A3')
//var_dump($prnt)
?>
