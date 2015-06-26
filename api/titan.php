<?php
//load in the slim php framework
require 'vendor/autoload.php';

require 'config/db_config.php';
require 'controllers/account/loginCtrl.php';

require 'plugins/db/db.php';

//create instance of slim
$titan = new \Slim\Slim(array(
  'mode' => 'development',
  'log.enabled' => 'true',
  'log.level' => \Slim\Log::DEBUG
));

$logger = $titan->log;

$titan->get("/main", function() use($logger) {
  echo "main page";
});

$titan->get("/login", function() {
  echo "login page";
});

$titan->post("/login", function() use($titan) {
  $login = new \controllers\loginCtrl();
  $login->login($titan->request, $titan->response);
});

$titan->run();

?>
