<?php

require_once('Employee.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $employee = new Employee($id);
    $employee->Destroy();
}
header('Location: /index.php');