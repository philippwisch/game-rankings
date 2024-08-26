<?php
$host = "127.0.0.1";
$port = "5432";
$dbname = "game_rankings";
$dbuser = "game_rankings";
$password = "changethispostgresspassword";

// Connection string
$conn_string = "host=$host port=$port dbname=$dbname user=$dbuser password=$password";

$dbconn = pg_connect($conn_string);

if (!$dbconn) {
    // If connection fails, you can redirect to an error page or show an error message
    echo "Error: Unable to connect to the database.\n";
} else {
    // SQL query to fetch data from the 'game' table
    $result = pg_query($dbconn, "SELECT name, rating FROM game");

    if (!$result) {
        echo "An error occurred while executing the query.\n";
        exit;
    }

    // Fetching data as an associative array
    $table_data = pg_fetch_all($result);

    echo "<table>";

    $table_header_displayed = false;
    foreach ($table_data as $row) {

        // table header row
        // because the keys are the same for every row from the table,
        // we can use the keys from any row from the table to
        // automatically create table headers.
        // Advantages:
        // - no need for another SQL request to get the table's attributes
        // - the html table will automatically update if the table schema changes in the database
        if (!$table_header_displayed) {
            echo "<tr>";
            $keys = array_keys($row);
            foreach ($keys as $key) {
                echo "<th>" . htmlspecialchars($key) . "</th>";
            }
            echo "</tr>";
            $table_header_displayed = true;
        }
        echo "<tr>";

        // table data rows
        foreach ($row as $key => $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";

    // Free result resource
    pg_free_result($result);
}

// Closing the database connection
pg_close($dbconn);
?>