<?php include ('db.php')?>

<?php
    $result = pg_query("SELECT * FROM Customer");

    echo "aaaaa";
    while ($row = pg_fetch_array($result)) {
    // This will loop through each row, now use your loop here
        echo "a";
        echo "<p>" . $row['custUsername'] . "</p>";
    }
?>