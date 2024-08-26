<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Rankings</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    $host = "127.0.0.1";
    $port = "5432";
    $dbname = "game_rankings";
    $dbuser = "game_rankings";
    $password = "changethispostgresspassword";
    $conn_string = "host=$host port=$port dbname=$dbname user=$dbuser password=$password";

    $dbconn = pg_connect($conn_string);

    if (!$dbconn) {
        // TODO redirect to error page from here
        echo "Error: Unable to connect to the database.\n";
    } else {
        // SQL query to fetch data from the 'game' table
        $result = pg_query($dbconn, "SELECT game, rating FROM game");

        if (!$result) {
            echo "An error occurred while executing the query.\n";
            exit;
        }

        $table_data = pg_fetch_all($result);

        echo "<table class='table'>";
        $table_header_displayed = false;
        foreach ($table_data as $row) {
            // table header row
            if (!$table_header_displayed) {
                echo "<tr>";
                // because the keys are the same for every row from the table,
                // we can use the keys from any row from the table to
                // create table headers and avoid making another SQL request to get the table's attributes
    
                // also there are no hard-coded <th> elements here, so if the "columns" from table_data
                // that should be displayed change, this html table will not need to be updated
                // because the columns of this table are built dynamically
                $keys = array_keys($row);
                foreach ($keys as $key) {
                    echo "<th class='table-header'>" . htmlspecialchars($key) . "</th>";
                }
                echo "</tr>";
                $table_header_displayed = true;
            }
            echo "<tr>";
            // table data rows
            foreach ($row as $key => $value) {
                echo "<td class='table-data'>" . htmlspecialchars($value) . "</td>";
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
</body>

</html>