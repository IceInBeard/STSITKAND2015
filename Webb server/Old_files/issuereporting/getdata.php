

<?php
// CONNECT TO THE DATABASE
$DB_NAME = 'Reporting';
$DB_HOST = '';
$DB_USER = 'root';
$DB_PASS = '';

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

// Mata ut en händelse från databasen
$query = "SELECT * FROM report";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);


// Tom array som ska fyllas med arrayer som motsvarar rader i databasen
$data = array();


// Skapa en array beståendes av arrayer som motsvarar varje rad i basabasen



if (mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_assoc($result)) {

        $data[] = $row;
        //array_push($data,array_values($row));

    }
}
// Räkna ut antal rader i databasen

//print_r($data);
$count_rows = count($data);



//print_r(gettype($data));

// CLOSE CONNECTION

mysqli_close($mysqli);

echo json_encode($data);


?>