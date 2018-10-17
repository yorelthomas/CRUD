<?php

require_once('Employee.php');

if (!isset($_GET['id'])) {
    header('Location: /index.php');
    exit();
}

$employee = new Employee($_GET['id']);

if (!empty($_POST)) {
    $employee->firstName = $_POST['firstName'];
    $employee->lastName = $_POST['lastName'];
    $employee->email = $_POST['email'];
    $employee->phone = $_POST['phone'];
    $employee->salary = $_POST['salary'];
    $employee->Update();
    header('Location: /index.php');
    exit();
}

$form = file_get_contents('form.html');

$search = [
    '{{action}}',
    '{{id}}',
    '{{firstName}}',
    '{{lastName}}',
    '{{phone}}',
    '{{email}}',
    '{{salary}}',
];

$replace = [
    'update.php',
    $_GET['id'],
    $employee->firstName,
    $employee->lastName,
    $employee->phone,
    $employee->email,
    $employee->salary,
];

$form = str_replace($search, $replace, $form);
echo $form;