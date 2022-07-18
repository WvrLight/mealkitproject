<?php
    session_destroy();

    echo "<script>alert('Logout successful.');</script>";
    echo "<script>window.location.href='index.php'</script>";
?>