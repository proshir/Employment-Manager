<?php

if (isset($_POST['employees'])) {

    require_once('dbconn.php');

    $employees = $_POST['employees'];

    $delete_query = "TRUNCATE TABLE Employee2City";
    $result = $conn->query($delete_query);
    //loop through employees and update city_id in employee2city table
    foreach ($employees as $employee) {
        $employee_id = $employee['id'];
        $city_id = $employee['city_id'];
        $update_query = "INSERT INTO Employee2City (employee_id, city_id) Values($employee_id,$city_id)";
        $result = $conn->query($update_query);
    }

    // close connection
    $conn->close();
}
?>
