<?php
include("../Connection/connection.php");

$jobCategoryId = $_GET['job_category_id'] ?? "";

if ($jobCategoryId != "") {
    // You can customize this query to filter by category later
    $query = "SELECT * FROM tbl_technical_skills where job_category_id = $jobCategoryId";
    $res = $con->query($query);

    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            echo "<input type='checkbox' name='technical_skills[]' value='{$row['technical_skill_id']}'> {$row['technical_skill_name']}<br>";
        }
    } else {
        echo "<i>No technical skills available for this category.</i>";
    }
} else {
    echo "<i>Please select a category.</i>";
}
?>
