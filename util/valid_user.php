<?php

if (!isset($_SESSION['is_valid_user'])) {
    echo "You are not logged in.";
    header("Location: . ");  
}
    
?>


