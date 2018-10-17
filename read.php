<?php

require_once('Employee.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $employee = new Employee($id);

    $html = file_get_contents('employee_view.html');

    $search = [
        '{{firstName}}',
        '{{lastName}}',
        '{{phone}}',
        '{{email}}',
        '{{salary}}',
    ];

    $replace = [
        $employee->firstName,
        $employee->lastName,
        $employee->phone,
        $employee->email,
        $employee->salary,
    ];

    $html = str_replace($search, $replace, $html);

    echo $html;

} else {
    header('Location: /index.php');
    die();
}

