<?php

namespace controllers {

  require_once 'models/account/user.php';
  require_once 'models/account/token.php';

  class loginCtrl {

    public function login($req, $res) {

      $res->headers->set('Content-Type', 'application/json');
      $body = json_decode($req->getBody(), true);

      if(empty($body)) {

        $res->setStatus(400);
      }
      else {

        $userModel = new \models\user();
        $user = $userModel->get_user($body['unid']);

        if(!$user || !password_verify($body['password'], $user['password'])) {

          $res->setStatus(401);
        }
        else {

          if(strtotime($user['token_exp']) - time() <= 0) {

            //token expired
            $tokenModel = new \models\token();

            try {

              $user['token'] = $tokenModel->set_new_token($user['unid']);
            }
            catch(Exception $e) {

              $res->setStatus(500);
              $logger->error($e);
            }
          }

          $resBody = array();
          $resBody['unid'] = $user['unid'];
          $resBody['name'] = $user['name'];
          $resBody['email'] = $user['email'];
          $resBody['token'] = $user['token'];
          $res->setBody(json_encode($resBody));
        }
      }

      return $res;

    }






  }
}

?>
