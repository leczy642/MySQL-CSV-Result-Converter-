<?php
// This application requires index.php and conveterscript.php to work

// first we need to insert  data into a Mysql database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csvconvertdb";

//  to connect to the databae we will be creating an instance of
// the MySQLi constructor which takes 4 parameters, the server name, username,
//password (in my case is blank), and database name in my case is called csvconvertdb.
$conn = new MySQLi ($servername, $username, $password, $dbname);

//we will create an if condition that goes off when the submit button is clicked
//we don't want to keep populating the database each time we refresh the browser



//we will insert multiple values into the mysql database
//you can also achieve the same result using simple arrays
$sql = "INSERT INTO userdata (name, phone_number, age, sex, city )
		VALUES 	('Alice Tyson', '325226115', '21', 'female', 'Newyork'),
				('Merissa Stone','12522546','24','Female','San Diego'),
				('Tom ford','222565656','28','male','Boston'),
				('Brad Stone','223545654','29','male','Texas'),
				('Luke page','1234895446','35','male','Los angeles'),
				('Bill stone','232323222','29','Male','Alaska'),
				('katie miller','989524542','25','female','Boston'),
				('Hassan Ahmed','726481927','32','Male','Abuja')";

				(mysqli_query($conn, $sql));

// we are inserting multiple values at the sametime, making it look like

//If we view our databas we can see that the values have been added, we can begin working on how
//to display the data for the user, which we are going to convert to CSV.

// [picture]show the picture of your Mysql database

//so now let's start retrieving the data we wish to convert from Mysql.
$sql = "SELECT * FROM userdata";
$result = $conn->query($sql);

//'SELECT *' simply means to select all fields from our table known as userdata
//you can replace the '*' with the name of the fields you want display.

echo ("<table>
			  <tr>
				<th>User ID</th>
				<th>Name</th>
				<th>Phone Number</th>
				<th>Age</th>
				<th>Sex</th>
				<th>City</th>
			  </tr>");

$file = fopen("userdata.csv","w");
while ($row = $result->fetch_assoc()){
		$dbuserid = $row["userid"];
		$dbname = $row["name"];
		$dbphone = $row["phone_number"];
		$dbage = $row["age"];
		$dbsex = $row["sex"];
		$dbcity = $row["city"];

		// so we create HTML table elements to make our data more presentable

		echo ("
			  <tr>
				<td>$dbuserid</td>
				<td>$dbname</td>
				<td>$dbphone</td>
				<td>$dbage</td>
				<td>$dbsex</td>
				<td>$dbcity</td>
				</tr>

		       ");
 	}
//in the above we createda  while loop to traversea all the databseelements we are retrieving
//the fetch_assoc () function returns an associative array that corresponds  to the rows
// beign fetched and NULL if there are no rows to return


// To make our values appear more refined we will put them in tables and add some styling
//add the table code below and after it include the css code for the table
//[create a table for line 63 and add some css styling]

// Now we will begin the conversion by first calling he fopen() function. This function takes
// two parameters, the first is the filename and the second is the file which can be 'r', 'a', 'w',
// or 'x'

//No we want to convert and download the CSV file when we click the convert and download button
//So to do that, we set an if condition that sets to tru when the button is clicked




?>
<!--Here we need to call our HTML tags and Link our stylesheets, which we called stylesheet.css -->
<!DOCTYPE html>
<html>
<head>

<link href="style.css" rel="stylesheet">
</head>
<body>
<tr><td><form method = 'post' action ='converterscript.php'>
	<input type = 'submit' name = 'submit' class='button' value ='Convert and Download'/>
	</form></td></tr>
</table>
</body>
</html>
