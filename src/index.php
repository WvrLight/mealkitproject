<?php include ('db.php')?>

<?php
    $sql = 'SELECT * FROM Customer';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    echo "a";
    print "b";
    foreach($details as $test) {
        print $test["custusername"];
    }
?>