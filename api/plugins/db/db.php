<?php

namespace db {

  class db {


    public function get_db_conn() {

      GLOBAL $logger;
      $logger->info("[" . time() . "]" . "opening a database connection");

      $db = new \mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

      if($db->connect_error) {

        $logger->info("[" . time() . "]" . "connection to database: failure");
        return null;
      }
      else {

        $logger->info("[" . time() . "]" . "connection to database: success");
        return $db;
      }
    }

  }
}


?>
