<?php
$host = "localhost";
$port = "5432";
$dbname = "game_rankings";
$dbuser = "postgres";

// Connection string without a password
$conn_string = "host=$host port=$port dbname=$dbname user=$dbuser";

$dbconn = pg_connect($conn_string);

if (!$dbconn) {
    echo "Error: Unable to connect to the database.\n";
} else {
    echo "Connected to the database successfully!\n";
}
?>