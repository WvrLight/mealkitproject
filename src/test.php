<?php
    $encrytedPass = password_hash('123', PASSWORD_DEFAULT);
    echo $encrytedPass;
?>