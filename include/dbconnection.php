<?php 
    class dbconnect{
        static $db;
        static $host = "localhost";
        static $username = "root";
        static $password = "1232102512";
        static $dbname = "CAFETERIA";
        private function __construct(){}

        static function CreateDatabaseResource(){
            if(isset($db))
                return $db;
            else
                return mysqli_connect(dbconnect::$host,dbconnect::$username,dbconnect::$password,dbconnect::$dbname);
        }
    }


    class dbconnection{
        public $db;

        function __construct(){
            $this->db = dbconnect::CreateDatabaseResource();
        }

        function SelectColumn($colname,$tblname,$attrname,$val){
            if($attrname == null)
                $query = "select `$colname` from `$tblname`";
            else
                $query = "select `$colname` from `$tblname` where `$attrname`='$val'";
            $res = $this->Select($query);
            if($res == false){
                return array();
            }
            $strArr = array();
            foreach ($res as $str) {
                array_push($strArr,$str[$colname]);
            }
            return $strArr;
        }

        function Select($query){
            $res = mysqli_query($this->db,$query);
            if($res == false){
                echo "ERROR";
                exit;
            }
            $arr = array();

            while($row = mysqli_fetch_assoc($res)){
                array_push($arr,$row);
            }
            return $arr;
        }

        function Update($query){
            $res = mysqli_query($this->db,$query);
            if($res == false){
                echo "ERROR";
                exit;
            }
        }

        function Delete($query){
            $res = mysqli_query($this->db,$query);
            if($res == false){
                echo "ERROR";
                exit;
            }
        }

        function Insert($query){
            $res = mysqli_query($this->db,$query);
            if($res == false){
                echo "ERROR";
                exit;
            }
        }
    }
?>
