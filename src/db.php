<?php
    $host = "ec2-54-147-33-38.compute-1.amazonaws.com";
    $user = "isxqfjvqxikzgi";
    $password = "68caf5ad66f41d0a317537024df0fab062f31ac69fad182c63f2bac77eebb287";
    $dbname = "dcsk7ps77u1kk2";
    $port = "5432";

    try {
        $dsn = "pgsql:host=" . $host . ";port=" . $port .";dbname=" . $dbname . ";user=" . $user . ";password=" . $password . ";";

        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
    }
    catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
?>