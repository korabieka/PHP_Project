<?php 
    class dbconnect{
        static $db;
        static $host = "localhost";
        static $username = "ashour";
        static $password = "hussien660";
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

        function getRoomId($rname){
            $rid = $this->SelectColumn('rid','room','rname',$rname);
            return $rid[0];
        }

        function getActiveProductsRecords(){
            $arr = $this->Select("select `pid`,`pname`,`price`,`imgname`,`available`,`active` from `product`");
            $userArr = array();
            foreach ($arr as $row){                
                if($row['active'])
                    array_push($userArr, $row);
            }
            return $userArr;
        }

        function getActiveUsersRecords(){
            $arr = $this->Select("select `uid`,`uname`,`email`,`imgname`,`rid`,`ext`,`active`,`admin` from `user`");
            $userArr = array();
            foreach ($arr as $row){                
                if($row['active'])
                    array_push($userArr, $row);
            }
            return $userArr;
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

        function getError() {
            return "Standard Message: " . $db->getMessage() . "Standard Code: " . $db->getCode() . "DBMS/User Message: ". $db->getUserInfo() . "DBMS/Debug Message: " . $db->getDebugInfo();
        }
    }
?>
