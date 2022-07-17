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
    foreach($details as $test) {
        print $test["custusername"];
        print $test["custUsername"];
    }

    $sql2 = 'SELECT * FROM Customer';
    $stmt2 = $pdo->prepare($sql);
    $stmt2->execute();
    $details = $stmt2->fetch(PDO::FETCH_OBJ);

    echo "c";
    print "d";
    print_r($details->custusername);
?>