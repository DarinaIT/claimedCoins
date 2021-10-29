<?php

 include_once 'Database.php';
 class Voucher {
 	private $db;
 	public function __construct() {
 		 $this->db = new Database();
  }

  public function getAllVouchers(){
     $sql = "SELECT * FROM vouchers";
     $query = $this->db->pdo->prepare($sql);
     $query->execute();
     $result = $query->fetchAll();
     return $result;
  }


}

?>
