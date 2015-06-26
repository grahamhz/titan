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

      if($result) {

        $return = $result->fetch_assoc();
      }

      $stmt->close();

      return $return;
    }




    public function edit_user_pw($unid, $password) {

      $db = new \db\db();
      $conn = $db->get_db_conn();

      $password = password_hash($password, PASSWORD_DEFAULT);

      $stmt = $conn->prepare("UPDATE users SET password = ? WHERE unid = ?");
      $stmt->bind_param("ss", $password, $unid);

      $error = null;

      if(!$stmt->execute()) {

        $error = $conn->error;
      }

      $stmt->close();

      return $error;
    }


  }
}

?>
