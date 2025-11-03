<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Store</title>
</head>

<body>
    <?php
        require __DIR__ . '/starterfiles/data/functions.php';

        // displays the desired query results in a table
        function displayQueryResults(array $results): void {
            if(empty($results)) {
                echo("<p><em>No results found.</em></p>");
                return;
            }

            echo("<table border='1' cellpadding='6' cellspacing='0' style='border-collapse: collapse;'>");
            foreach ($results as $row) {
                echo("<tr>");
                foreach($row as $value) {
                    echo("<td>" . htmlspecialchars($value) . "</td>");
                }
                echo("<tr>");
            }
            echo("</table>");
            
            echo("<br>");
        }
    ?>

    <h2>Unit Test 1 — Formats</h2>
    <?php
        displayQueryResults(formats_all());
    ?>
    <hr>

    <h2>Unit Test 2 — Records JOIN</h2>
    <?php
        displayQueryResults(records_all());
    ?>
    <hr>

    <h2>Unit Test 3 — Insert</h2>
    <?php
        echo("<p>" . record_insert() . "</p>");
    ?>
    <hr>
</body>

</html>