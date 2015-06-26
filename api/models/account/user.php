<?php

namespace models {

//require 'plugins/db/db.php';

  class user {


    public function get_user($unid) {

      $db = new \db\db();
      $conn = $db->get_db_conn();

      $stmt = $conn->prepare("SELECT * FROM users WHERE unid = ?");
      $stmt->bind_param("s", $unid);
      $stmt->execute();
      $result = $stmt->get_result();

      if($result)
        $return = $result->fetch_assoc();

      return $return;
    }


  }
}

?>
