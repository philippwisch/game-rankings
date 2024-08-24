<?php
$host = "127.0.0.1";
$port = "5432";
$dbname = "game_rankings";
$dbuser = "game_rankings";
$password = "changethispostgresspassword";

// Connection string without a password
$conn_string = "host=$host port=$port dbname=$dbname user=$dbuser password=$password";

$dbconn = pg_connect($conn_string);

if (!$dbconn) {
    echo "Error: Unable to connect to the database.\n";
} else {
    echo "Connected to the database successfully!\n";
}
?>