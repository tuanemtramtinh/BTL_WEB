<?php

define("BASE_URL", dirname($_SERVER['SCRIPT_NAME']));
define("ADMIN_ID", '00000000000');

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
  'lifetime' => 1800,
  'domain' => 'localhost',
  'path' => '/',
  'secure' => true,
  'httponly' => true
]);


// if ($_GET['url']) {
//   $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
//   if ($url[0] === 'admin' || $url[1] === 'admin') {
//     session_name('admin_session');
//   } else {
//     session_name('user_session');
//   }
// }

session_start();

// if (isset($_SESSION['used_id'])) {
//   if (!isset($_SESSION['last_regeneration'])) {
//     regenerate_session_id_loggedin();
//   } else {
//     $interval = 60 * 30;
//     if (time() - $_SESSION['last_regeneration'] >= $interval) {
//       regenerate_session_id_loggedin();
//     }
//   }
// } else {
//   if (!isset($_SESSION['last_regeneration'])) {
//     regenerate_session_id();
//   } else {
//     $interval = 60 * 30;
//     if (time() - $_SESSION['last_regeneration'] >= $interval) {
//       regenerate_session_id();
//     }
//   }
// }

if (!isset($_SESSION['last_regeneration'])) {
  regenerate_session_id();
} else {
  $interval = 60 * 30;
  if (time() - $_SESSION['last_regeneration'] >= $interval) {
    regenerate_session_id();
  }
}

function regenerate_session_id()
{
  session_regenerate_id(true);
  $_SESSION['last_regeneration'] = time();
}

// function regenerate_session_id_loggedin() {
//   session_regenerate_id(true);

//   $userId = $_SESSION['userId'];
//   $newSessionId = session_create_id();
//   $sessionId = $newSessionId . '_' . $userId;
//   session_id($sessionId);

//   $_SESSION['last_regeneration'] = time();
// }
