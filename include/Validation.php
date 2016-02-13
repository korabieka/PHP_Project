<?php
	require("dbconnection.php");

	class Validation{

		public $dbobj;
		public $susers;
		public $users;
		public $emails;
		public $rooms;
		public $exts;

		function __construct(){
			$this->dbobj = new dbconnection();
			$this->susers = $this->dbobj->SelectColumn('uname','user','admin','true');
			$this->users = $this->dbobj->SelectColumn('uname','user',null,null);
			$this->emails = $this->dbobj->SelectColumn('email','user',null,null);
			$this->rooms = $this->dbobj->SelectColumn('rname','room',null,null);
			// $exts = $dbobj->SelectColumn('ename','extension',null,null);
		}

		function ifUserExists($uname){
			foreach($this->users as $user)
				if($uname == $user)
					return true;
			return false;
		}

		function ifSuperUser($uname){
			foreach($this->susers as $suser)
				if($uname == $suser)
					return true;
			return false;
		}

		function ifEmailExists($email){
			foreach($this->emails as $uemail)
				if($email == $uemail)
					return true;
			return false;
		}

		function ifRoomExists($rname){
			foreach($this->rooms as $room)
				if($rname == $room)
					return true;
			return false;
		}

		// function ifExtExists($ename){
		// 	foreach($exts as $ext)
		// 		if($enanme == $ext)
		// 			return true;
		// 		return false;
		// }


	}





?>