<?php


if (!isset($_SESSION['is_valid_admin'])) {
    echo "Must be an administrator to view that page.";
    header('Location: .');
}

?>