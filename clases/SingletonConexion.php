<?php
class SingletonConexion
{
    private static $instance = null;
    private $conn = null;

    public function __construct()
    {
        // if(_HOST_PAG_ == 'www.dnm.gov.ar' || _HOST_PAG_ == 'www1.dnm.gov.ar'){
        //     $this->conn = new PDO('mysql:host='._HOST_.';dbname='._BDD_, _USER_, _PASS_);
        //     $this->conn2 = new PDO('mysql:host='._HOST_.';dbname='._BDD2_, _USER_, _PASS_);
        // }else{
            
            $this->conn = mysqli_connect('localhost', 'root', '', 'estudio');
            // $this->conn2 = mysqli_connect(_HOST_, _USER_, _PASS_, _BDD2_);
        // }

    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new SingletonConexion;
        }
        return self::$instance;
    }
    public function getConnection()
    {
        return $this->conn;
    }
}
?>