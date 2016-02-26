<!DOCTYPE HTML> 
<html>
<head>
</head>
<body> 

<?php
require_once ( 'testing.php' );

$ip = $hostname = "";

if (isset($_POST["submit"]))
{
	$ip=$_POST['ip'];
	$hostname=$_POST['hostname'];
doRDNS($ip,$hostname);
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
   $ip = test_input($_POST["ip"]);
   $hostname = test_input($_POST["hostname"]);
}

function test_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2>Set RDNS Zone Lazily</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   IP: <input type="text" name="ip">
   <br><br>
   Hostname: <input type="text" name="hostname">
   <br><br>
   <input type="submit" name="submit" value="Submit"> 
</form>
<?php
echo "Setting RDNS for ".$ip." PTR to ".$hostname.".";
?>

</body>
</html>




