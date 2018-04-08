<?php
// This application requires index.php and conveterscript.php to work

//  to connect to the databae we will be creating an instance of
// the MySQLi constructor which takes 4 parameters, the server name, username,
//password (in my case is blank), and database name in my case is called csvconvertdb.
$conn = new MySQLi ("localhost", "root", "", "csvconvertdb");

// open the file "demosaved.csv" for writing
//$file = fopen('demosaved16.csv', 'w');
//we need to send the CSv file directly to the browser without opening in an external file.
//so we create a file pointer connected to the output stream
$document = fopen('php://output', 'w');

//we need to prepare the file for download rather than being displayed
//So we create output headers
header('Content-Type: text/csv; charset=utf-8');
//so lets add a time stamp to give the file a unique value each time it is downloaded 
header('Content-Disposition: attachment; filename=userdata_'.date("H:i:s").'.csv');
 
// save the column headers. We have created 6 columns to reflect what's stored in the database
//they will appear as the row header in the csv file when viewed after downloading
fputcsv($document, array('ID', 'Name', 'Phone', 'Age', 'Sex', 'City'));




//  to connect to the databae we will be creating an instance of
// the MySQLi constructor which takes 4 parameters, the server name, username,
//password (in my case is blank), and database name in my case is called csvconvertdb.
$conn = new MySQLi ("localhost", "root", "", "csvconvertdb");

//so now let's start retrieving the data we wish to convert from Mysql. 
$sql = "SELECT * FROM userdata";
$result = $conn->query($sql);


while ($row = $result->fetch_assoc()) {
	fputcsv($document, $row);
}

// so the next thing we need to do is add random numbers to our downloaded file so that
// it gets a unique file name each time file is downloaded so we would add a time stamp 
 
?>
