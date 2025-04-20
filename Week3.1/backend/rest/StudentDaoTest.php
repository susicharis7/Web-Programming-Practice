<?php
require_once 'dao/StudentDao.php';

$dao = new StudentDao(); 


// TEST getAll()
echo "<h2>All Students: </h2>";
$allStudents = $dao->getAll();
echo "<pre>";
print_r($allStudents);
echo "<pre>";



// TEST get_by_id()
echo "<h2>Get By ID: <h2>";
$id = 3;
$singleStudent = $dao->get_by_id($id);
echo "<pre>";
print_r($singleStudent);
echo "<pre>";


// TEST insert()
echo "<h2>Insert new student:</h2>";
$newStudent = [
    'first_name' => 'Haris',
    'last_name' => 'Susic',
    'email' => 'haris.susic@ibu.edu.ba',
    'year' => 1
];

$insertId = $dao->insert($newStudent);
echo "Inserted student with ID: $insertId<br>";










?>