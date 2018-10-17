<?php

require_once('dbConfig.php');


class Employee
{
    private $id,
        $firstName,
        $lastName,
        $email,
        $phone,
        $salary;

    private $db; // database

    const SETTABLE = ['firstName', 'lastName', 'email', 'phone', 'salary'];

    function __construct($id=0) {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);
        if(!$this->db) {
            throw new Exception($db->connect_error, $db->connect_errno);
        }

        $id = intval($id);

        if($id) {
            $sql = "SELECT * FROM employees WHERE id=" . $id;
            $result = $this->db->query($sql);

            $row = $result->fetch_assoc();
            if ($row) {
                $this->id = $row['id'];
                $this->firstName = $row['first_name'];
                $this->lastName = $row['last_name'];
                $this->email = $row['email'];
                $this->phone = $row['phone'];
                $this->salary = $row['salary'];
            }
        }
    }

    public function __set($name, $value)
    {
        if(in_array($name, static::SETTABLE)) {
            $this->$name = $value;
        }
    }

    public function __get($name)
    {
        if(isset($this->$name) && in_array($name, static::SETTABLE)) {
            return $this->$name;
        } else {
            return;
        }
    }

    public function Create() {
        $sql = "INSERT INTO employees SET 
            first_name=?, 
            last_name=?, 
            email=?, 
            phone=?, 
            salary=?";

        $stmnt = $this->db->prepare($sql);
        $stmnt->bind_param("sssss", $this->firstName, $this->lastName, $this->email, $this->phone, $this->salary);
        $success = $stmnt->execute();
        
        $this->id = $stmnt->insert_id;

        $stmnt->close();
    }

    public function Update() {
        $stmnt = $this->db->prepare("UPDATE employees SET 
            first_name=?, 
            last_name=?, 
            email=?, 
            phone=?, 
            salary=? 
            WHERE id=?");
        $stmnt->bind_param("ssssii", $this->firstName, $this->lastName, $this->email, $this->phone, $this->salary, $this->id);
        $stmnt->execute();
        $stmnt->close();
    }

    public function Destroy() {
        $sql = "DELETE FROM employees WHERE id=" . $this->id;
        $result = $this->db->query($sql);
    }

    public static function getAll() {
        $db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);
        if ($db->connect_error) {
            throw new Exception($db->connect_error, $db->connect_errno);
        }

        $employees = [];
        $sql = "SELECT * FROM employees";
        $result = $db->query($sql);
        while ($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }
        $db->close();

        return $employees;
    }

}