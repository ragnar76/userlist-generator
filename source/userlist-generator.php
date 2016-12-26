<?php
	// add your credentials here
	$servername = "localhost";
	$username = "";
	$password = "";
	$dbname = "";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	
	// used for the stupid password generator later
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";

	// at the end of next line, there is a limit. change it four your needs
	$sql = "Select * from names WHERE `forename` <>'' and `surname`<>'' ORDER by RAND() LIMIT 250";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	    	
	    	// shuffle the chars (from above) to generate a password with 8 chars
	    	$password = substr( str_shuffle( $chars ), 0, 8 );
	        
	    	// spit out the rows from mysql. change this for your needs
	        echo 
	        $row["forename"][0]."_".$row["surname"]. ";".		// sam - made from the first char from forname
	        $row["forename"]. ";".								// forname
	        $row["surname"]. ";".								// surname
	        "umschulung". ";".									// maildomain
	        "VPN-Users". ";".									// OU
	        $password. ";".										// password
	        "<br>\n";
	    }
	} else {
	    // nothing found
	    echo "0 results";
	}
	$conn->close();
?>
