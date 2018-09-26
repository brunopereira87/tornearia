<?php
if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
    echo "<p class='alert alert-success'>".$_SESSION['success']."</p>";
    unset($_SESSION['success']);
}

if(isset($_SESSION['erro']) && !empty($_SESSION['erro'])){
    echo "<p class='alert alert-success'>".$_SESSION['erro']."</p>";
    unset($_SESSION['erro']);
}
?>