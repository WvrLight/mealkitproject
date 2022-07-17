<?php include ('db.php')?>

<?php
    $sql = 'SELECT * FROM Customer';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    echo "a";
    print "b";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // This will loop through each row, now use your loop here
        print $row["custusername"];
        print $row["custUsername"];
    }
?>