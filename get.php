<?php require 'db_connect.inc.php' ?>
<?php
/*

The purpose of this script is to allow API access to the student_v2 table in the database.
This script will allow the user to query the student_v2 table using the following parameters:
- first_name
- last_name
- degree_program
- financial_aid
- gpa
- graduation_date
- email
- student_id
- phone

Here are some examples of how to use this script:

// http://localhost/lab9/lab9.php
// http://localhost/lab9/lab9.php?first_name=Joe"
// http://localhost/lab9/lab9.php?last_name=Smith"
// http://localhost/lab9/lab9.php?first_name=Joe&last_name=Smith"
// http://localhost/lab9/lab9.php?degree_program=Computer Science"
// http://localhost/lab9/lab9.php?degree_program=Computer Science&first_name=Joe"
// http://localhost/lab9/lab9.php?degree_program=Computer Science&last_name=Smith"
*/

// used for the SQL Query
$params = [];
// Used for the SQL Query parameters
$keys = [];

// Check if the first_name parameter is set
if (isset($_GET["first_name"])) {
    // Get the first name from the URL
    $first_name = $_GET["first_name"];
    // Add the first name to the parameters array
    array_push($params, "first_name=:first_name");
    // Add the first name to the keys array along with the value
    $keys["first_name"] = $first_name;
}

// Check if the last_name parameter is set
if (isset($_GET["last_name"])) {
    // Get the last name from the URL
    $last_name = $_GET["last_name"];
    // Add the last name to the parameters array
    array_push($params, "last_name=:last_name");
    // Add the last name to the keys array along with the value
    $keys["last_name"] = $last_name;
}

// Check if the degree_program parameter is set
if (isset($_GET["degree_program"])) {
    // Get the degree program from the URL
    $degree_program = $_GET["degree_program"];
    // Add the degree program to the parameters array
    array_push($params, "degree_program=:degree_program");
    // Add the degree program to the keys array along with the value
    $keys["degree_program"] = $degree_program;
}

// Check if the financial_aid parameter is set
if (isset($_GET["financial_aid"])) {
    // Get the financial aid from the URL
    $financial_aid = $_GET["financial_aid"];
    // Add the financial aid to the parameters array
    array_push($params, "financial_aid=:financial_aid");
    // Add the financial aid to the keys array along with the value
    $keys["financial_aid"] = $financial_aid;
}

// Check if the gpa parameter is set
if (isset($_GET["gpa"])) {
    // Get the gpa from the URL
    $gpa = $_GET["gpa"];
    // Add the gpa to the parameters array
    array_push($params, "gpa=:gpa");
    // Add the gpa to the keys array along with the value
    $keys["gpa"] = $gpa;
}

// Check if the graduation_date parameter is set
if (isset($_GET["graduation_date"])) {
    // Get the graduation date from the URL
    $graduation_date = $_GET["graduation_date"];
    // Add the graduation date to the parameters array
    array_push($params, "graduation_date=:graduation_date");
    // Add the graduation date to the keys array along with the value
    $keys["graduation_date"] = $graduation_date;
}

// Check if the email parameter is set
if (isset($_GET["email"])) {
    // Get the email from the URL
    $email = $_GET["email"];
    // Add the email to the parameters array
    array_push($params, "email=:email");
    // Add the email to the keys array along with the value
    $keys["email"] = $email;
}

// Check if the student_id parameter is set
if (isset($_GET["student_id"])) {
    // Get the student id from the URL
    $student_id = $_GET["student_id"];
    // Add the student id to the parameters array
    array_push($params, "student_id=:student_id");
    // Add the student id to the keys array along with the value
    $keys["student_id"] = $student_id;
}

if (isset($_GET["phone"])) {
    // Get the phone number from the URL
    $phone = $_GET["phone"];
    // Add the phone number to the parameters array
    array_push($params, "phone=:phone");
    // Add the phone number to the keys array along with the value
    $keys["phone"] = $phone;
}

// Check if there are any parameters
if (count($params) >= 1) {
    // If there are parameters, add the WHERE clause to the SQL Query
    $params_string = " WHERE " . implode(" and ", $params);
} else {
    // If there are no parameters, set the params string to NULL
    $params_string = Null;
}

// SQL Query
$sql = "SELECT * FROM student_v2" . $params_string;
// Prepare the SQL Query
$stmt = $db->prepare($sql);
// Execute the SQL Query with the key/value pairs for PDO
$stmt->execute($keys);
// Set the header to JSON
header('Content-Type: application/json; charset=utf-8');
// Return the JSON encoded result
echo json_encode(["count" => $stmt->rowCount(), "result" => $stmt->fetchAll()]);
?>
