<?php

namespace models {

//require 'plugins/db/db.php';

  class token {

    public function set_new_token($unid) {

      $token = bin2hex(openssl_random_pseudo_bytes(16));

      $db = new \db\db();
      $conn = $db->get_db_conn();
      $stmt = $conn->prepare('
      UPDATE users
      SET token_exp = NOW() + INTERVAL 2 DAY, token = ?
      WHERE unid = ?
      ');
      $stmt->bind_param("ss", $token, $unid);

      if(!$stmt->execute()) {

        throw new Exception($conn->error);
      }

      return $token;

    }

  }


}
