<?php
class SingletonConexion
{
    private static $instance = null;
    private $conn = null;

    public function __construct()
    {
        if(_HOST_PAG_ == 'estudio6.site'){
            $this->conn = mysqli_connect('localhost', 'c2721191_estudio', 'biseziDI17', 'c2721191_estudio');
        }else{
            $this->conn = mysqli_connect('localhost', 'root', '', 'estudio');
        }

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