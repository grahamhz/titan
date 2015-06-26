<?php

namespace controllers {

  require 'models/account/user.php';

  class loginCtrl {

    public function login($req, $res) {

      $res->headers->set('Content-Type', 'application/json');

      $body = json_decode($req->getBody(), true);

      $userModel = new \models\user();
      $user = $userModel->get_user($body['unid']);

      if(!$user || $body['password'] !== $user['password']) {

        $res->setStatus(401);
      }
      else {

        $res->headers->set('Content-Type', 'application/json');
        $resBody = array();
        array_push($resBody, $user);
        $res->setBody(json_encode($resBody));
      }

      return $res;

    }


  }
}

?>
