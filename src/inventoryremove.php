<?php include ('db.php')?>
<?php
    if (!isset($_SESSION['isadmin'])) {
        echo "<script>window.location.href='login.php'</script>";
    }

    $id = $_GET['id'];

    $sql = "SELECT * FROM Product WHERE id = " . $id;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "
        <form method='post'>
        <div class='popupRemove'>
            <h2>Removing MEAL-KIT</h2>
            <input type='hidden' class='productID' name='productId' value='" . $id . "'>
            <input type='button' class='close' name='close' value='×' onclick='" . "closeView('formRemove')" . ">
            <div class='content'>
                <label>Please confirm removal of the selected mealkit: <b>" . $row['productname'] . "</b></label>
                <div align='right' style='margin-right: 30px'>
                    <input type='submit' name='submitRemove' value='Confirm' class='loginbtn'>
                </div>
            </div>
        </div>
        </form>";
    }
?>