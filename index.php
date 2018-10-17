<?php

require_once('Employee.php');

$employees = Employee::getAll();

$tbody = '';
foreach ($employees as $employee) {
    $tbody .= "<tr>";
    $tbody .= '<td scope=" row ">' . $employee['id'] . '</td>';
    $tbody .= '<td>' . $employee['first_name'] . ' ' . $employee['last_name'] . '</td>';
    $tbody .= '<td>' . $employee['phone'] . '</td>';
    $tbody .= '<td>' . $employee['email'] . '</td>';
    $tbody .= '<td><span class="input-group-addon">$</span>' . $employee['salary'] . '</td>';
    $tbody .= '<td>
                                        <a href="/read.php?id=' . $employee['id'] . '">View</a> 
                                        <a href="/update.php?id=' . $employee['id'] . '">Edit</a> 
                                        <a href="/destroy.php?id=' . $employee['id'] . '">Delete</a>
                                        </td>';
    $tbody .= "</tr>";
}

$html = file_get_contents('employee_list.html');
$html = str_replace('{{tbody}}', $tbody, $html);
echo $html;
