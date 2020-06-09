<?php




if($_POST) {

    $contactName = trim(stripslashes($_POST['contactName']));
    $contactEmail = trim(stripslashes($_POST['contactEmail']));
    $contactSubject = trim(stripslashes($_POST['contactSubject']));
    $contactMessage = trim(stripslashes($_POST['contactMessage']));

    // Check Name
    if (strlen($contactName) < 2) {
        $error['contactName'] = "Please enter your name.";
    }
    // Check Email
    if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $contactEmail)) {
        $error['contactEmail'] = "Please enter a valid email address.";
    }
    // Check Message
    if (strlen($contactMessage) < 10) {
        $error['contactMessage'] = "Please enter your message. It should have at least 15 characters.";
    }
    // Subject
    if ($contactSubject == '') { $contactSubject = "Contact Form Submission"; }


    if (!$error) {
		
		$link = mysqli_connect("localhost", "avnkum6_db", "iammicky", "avnkum6_db");

		if($link === false){
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}
		
		//$contactName = mysqli_real_escape_string($link, $_REQUEST['contactName']);
		//$contactEmail = mysqli_real_escape_string($link, $_REQUEST['contactEmail']);
		//$contactSubject = mysqli_real_escape_string($link, $_REQUEST['contactSubject']);
		//$contactMessage = mysqli_real_escape_string($link, $_REQUEST['contactMessage']);
		
		
		
		$sql = "INSERT INTO contact (contactName, contactEmail, contactSubject, contactMessage) VALUES ('$contactName', '$contactEmail', '$contactSubject', '$contactMessage')";
		if(mysqli_query($link, $sql)){
			echo "Your message was sent, thank you!";
		} else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
 
		// Close connection
		mysqli_close($link);
		
        
    } # end if - no validation error

    else {

        $response = (isset($error['contactName'])) ? $error['contactName'] . "<br /> \n" : null;
        $response .= (isset($error['contactEmail'])) ? $error['contactEmail'] . "<br /> \n" : null;
        $response .= (isset($error['contactMessage'])) ? $error['contactMessage'] . "<br />" : null;
        
        echo $response;

    } # end if - there was a validation error

}

?>