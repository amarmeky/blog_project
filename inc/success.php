<?php
    if(isset($_SESSION['success'])){
        foreach($_SESSION['success'] as $success){
            echo "<div class='alert alert-success'>$success</div>";
        }
        unset($_SESSION['success']);
    }
?>