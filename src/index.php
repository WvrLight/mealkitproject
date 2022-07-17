<?php include ('db.php')?>

<?php
    $sql = 'SELECT * FROM Customer';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $details = $stmt->fetch(PDO::FETCH_OBJ);

    echo "a";
    print "b\n";
    foreach($details as $row) {
        print $test->custusername;
        echo "-----";
        print $test->custUsername;
        echo "-----";
        print $test["custusername"];
        echo "-----";
        print $test["custUsername"];
    }
?>