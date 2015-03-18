<?php
function db_connect() {
    $connectionArray = file('the_castle_of_aaarrrrggh');
    $server   = chop($connectionArray[0]);
    $username = chop($connectionArray[1]);
    $password = chop($connectionArray[2]);
    $database = chop($connectionArray[3]);

    //$connection = new mysqli($server, $username, $password, $database);
    //if($connection->connect_error) {die("Connection failed: " . $connection->connect_error);}
    //return $connection;
    try {
        $conn = new PDO('mysql:host='.$server.';dbname='.$database.';', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
    catch(PDOException $e) {
        return "Connection failed: " . $e->getMessage();
    }
}

function db_close($connection) {
    $connection->close();
}
?>