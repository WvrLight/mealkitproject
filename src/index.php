<?php include ('db.php')?>

<?php
    $sql = 'SELECT * FROM Customer';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $details = $stmt->fetch(PDO::FETCH_OBJ);

    echo "a";
    print "b\n";
    foreach($details as $row) {
        print $row->custusername;
        echo "-----";
        print $row->custUsername;
        echo "-----";
        print $row["custusername"];
        echo "-----";
        print $row["custUsername"];
    }
?>