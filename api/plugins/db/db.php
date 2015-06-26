<?php

namespace db {

  class db {


    public function get_db_conn() {

      GLOBAL $logger;
      $logger->info("[" . time() . "]" . "opening a database connection");

      $db = new \mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

      //$db = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

      if($db->connect_error) {

        $logger->info("[" . time() . "]" . "connection to database: failure");
        return null;
      }
      else {

        $logger->info("[" . time() . "]" . "connection to database: success");
        return $db;
      }
    }


    private function build_columns($query, $columns) {

      $count = count($columns);

      if($count > 0) {

        for($i = 0; $i < $count; $i++) {

          if($i === 0) {

            $query .= $columns[$i];
          }
          else {

            $query .= ", " . $columns[$i];
          }
        }

      }

      return $query;
    }


    private function build_tables($query, $tables) {

      $query .= " FROM ";

      $count = count($tables);

      if($count > 0) {

        for($i = 0; $i < $count; $i++) {

          if($i === 0) {

            $query .= $tables[$i];
          }
          else {

            $query .= ", " . $tables[$i];
          }
        }
      }

      return $query;
    }


    private function build_and_values($query, $and) {

      if(count($and) > 0) {

        $query .= " WHERE ";

        $first = true;

        foreach($and as $key => $val) {

          if($first) {

            $query .= $key . " = " . $val;
            $first = false;
          }
          else {

            $query .= " AND " . $key . " = " . $val;

          }
        }

      }

      return $query;
    }


    private function build_or_values($query, $or, $andCount) {

      if(count($or) > 0) {

        if($andCount <= 0) {

          $query .= " WHERE ";
        }
        else {

          $query .= " OR ";
        }

        $first = true;

        foreach($or as $key => $val) {

          if($first) {

            $query .= $key . " = " . $val;
            $first = false;
          }
          else {

            $query .= " OR " . $key . " = " . $val;

          }
        }
      }

      return $query;
    }



    public function db_get_one($columns, $tables, $and, $or) {

      GLOBAL $logger;

      $query = "SELECT ";
      $query = $this->build_columns($query, $columns);
      $query = $this->build_tables($query, $tables);
      $query = $this->build_and_values($query, $and);
      $query = $this->build_or_values($query, $or, count($and));

      $conn = $this->get_db_conn();

      $logger->info($conn);

      $result = $conn->query("SELECT * FROM users WHERE unid = 'u0889568'");

      $logger->info("[" . time() . "]" . "MySQL Query: " . $query);

      $logger->info("[" . time() . "]" . "MySQL Result: " . $conn->error);

      return $result;
    }




  }
}


?>
