<?php include ('db.php')?>
<?php
    $id = $_GET['id'];

    $sql = "SELECT * FROM Customer WHERE id = " . $id;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "
            <form method='post'>
            <input type='hidden' class='customerId' name='custId' value='" . $id . "'>
            <div class='popupEdit'>
					<h2>Editing my profile</h2>
					<input type='button' class='close' name='close' value='×' onclick=" . "closeView('profileEdit')" . ">
					<div class='content'>
					<label> Name:</label>
						<input type='text' name='fullName' class='prodContent' value='" . $row['custfullname'] . "' required/><br>
					<label> Delivery address:</label>
						<textarea name='userAddr' class='textareaDesc' rows='4' required>" . $row['custaddress'] ."</textarea><br>
					<label> Contact number:</label>
						<input type='text' name='userNum' class='prodContent' value='" . $row['custnumber'] . "' required/><br><br><br>
					<div align='right' style='margin-right: 30px'>
						<input type='submit' name='submit' value='Update' class='loginbtn'>
					</div>
					</div>
			</div>
            </form>
        ";
    }
?>