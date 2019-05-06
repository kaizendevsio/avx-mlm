<?php
//INITIALZE CONNECTION STRING
header('Access-Control-Allow-Origin: *');
$_isDebug = true;

if ($_isDebug == false)
{
    $host = 'localhost';
    $db   = 'u527436058_dherb';
    $user = 'u527436058_dherb';
    $pass = 'acts2:38';
    $charset = 'utf8mb4';
}
else{
    $host = 'localhost';
    $db   = 'u527436058_dherb';
    $user = 'xeon09';
    $pass = 'acts2:38';
    $charset = 'utf8mb4';

}

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
	$pdo = new PDO($dsn, $user, $pass, $options);
    //echo 'connection success!';
}
catch (\PDOException $e) {
	throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>