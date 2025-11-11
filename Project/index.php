<?php
include "view/header.php";

$page = $_GET['page'] ?? 'item';

if ($page == "item") {
    include "view/item_view.php";
} elseif ($page == "student") {
    include "view/student_view.php";
} elseif ($page == "loan") {
    include "view/loan_view.php";
} else {
    echo "<h2>Page not found</h2>";
}

include "view/footer.php";
?>
