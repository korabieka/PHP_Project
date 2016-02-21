<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  $_orders = "../layout/orders.php";
  require_once("../include/Validation.php"); // deconnection already included in Validation
  $dbobj = new dbconnection();
  $vobj = new Validation();

  session_start();
  if(!isset($_SESSION['uid'])){
    echo "You are not authoriezed to enter this page. You have to login first";
    exit;
  }

  $uid = $_SESSION['uid'];
  // if(!$vobj->ifSuperUserId($uid)){
  //   echo "You are not authoriezed to enter this page. Only for admins.";
  //   exit;
  // }

  $procOrds = $dbobj->SelectColumn('oid','orders','processing',1);

  $flag = true;
  do{

    foreach ($procOrds as $outoid) {
      $outOrds = $dbobj->Select("SELECT `oid` FROM `orders` WHERE `processing`=0 AND `oid`='$outoid'");
      if(isset($outOrds[0])){
        $flag = false;
        $oid = $outOrds[0];
        break;
      }
      // sleep(1);
    }
    clearstatcache();
    sleep(1);

  }while($flag);
  // // do{
  //  // $updated_processing = $dbobj->SelectColumn('processing','orders','oid',$oid);
 //    $aliveOrds = $dbobj->SelectColumn('oid','orders','alive',1);
 //    // foreach ($aliveOrds as $aoid) {
 //      // $outOrd = $dbobj->Select("SELECT `oid` from `orders` WHERE `alive`=0 AND `oid`='$aiod");
 //      // $outOrder = $outOrd[0];
 //    }
 //    sleep(1);
  // }while($processing == $updated_processing);
  ////////////////
  // sleep(1);
  // $oid = "5";
  // $response = array();
  // $response['oid'] = $oid;
    $outOrd = array();
    // $outOrd['data'] = $aliveOrds;
    $outOrd['oid'] = $oid['oid'];
    // $outOrd['oid'] = 55;
  echo json_encode($outOrd);
// $response = array();
// $response['lastModified'] = "zasdfas";
// $response['msg'] = "sdgs";
// echo json_encode($response);

?>