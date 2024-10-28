<?PHP

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techsolutionsbd_billling_demo";
 

//mysqli_set_charset('utf8');
$con = mysqli_connect($servername, $username, $password, $dbname);

mysqli_set_charset($con, "UTF8");
if (!$con) {
    // print_r($connection);
	// echo "Connection Failure!";
}
else{
	// echo "Successfully Connected";
}
?> 