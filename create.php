<?php

require_once('Employee.php');

if (!empty($_POST)) {
    $employee = new Employee();

    $employee->firstName = $_POST['firstName'];
    $employee->lastName = $_POST['lastName'];
    $employee->email = $_POST['email'];
    $employee->phone = $_POST['phone'];
    $employee->salary = $_POST['salary'];

    $employee->Create();
    
    header('Location: /index.php');
} else {
    $form = file_get_contents('form.html');
    $form = preg_replace('/{{.*}}/', '', $form);
    echo $form;
}

