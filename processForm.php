
<?php
//configure for below
//let's make it so we can use MySQLi
$mysqli = new mysqli("localhost", "UserGiftForm", "Nev3rUseTh1sP4ssw0rdEverAgain!", "OnlineGiftForm");

if(mysqli_connect_errno()) {
    printf("Connection failed: %s\n", mysqli_connect_error());
    exit();
}

//Start up with our functions
function check_email_address($email) {
  $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      }
      else if
(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
                 str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }
      if ($isValid && !(checkdnsrr($domain,"MX") || 
 ↪checkdnsrr($domain,"A")))
      {
         // domain not found in DNS
         $isValid = false;
      }
   }
   return $isValid;
}

//Get the Gift Amount pieces
  //one time donations
  $oneTimeGiftAmount = $_POST['oneTimeDonationValue'];

  //recurring donations
  $recurringGiftPerDonationAmount = $mysqli->real_escape_string($_POST['recurringDonationValue']);
  $recurringGiftNumberOfPayments = $mysqli->real_escape_string($_POST['numberOfPayments']);
  $recurringGiftFrequency = $mysqli->real_escape_string($_POST['paymentFrequency']);
  //calculate their total gift. We want to do it again to avoid javascript related errors or changes.
  $totalGiftAmount = $recurringGiftPerDonationAmount * $recurringGiftNumberOfPayments;
  
  //now let's get the values of the checkboxes starting with Scholarships
  if(!empty($_POST['scholarship_list'])) {
    $scholarships_selected = array();
    foreach($_POST['scholarship_list'] as $scholarship) {
      //check the values and add to the array accordingly
      switch ($scholarship) {
        case 'Good_Men_Good_Citizens':
            $scholarships_selected['GoodMenGoodCitizens'] = "Good Men, Good Citizens Scholarship";
        break;

        case 'Class_Of_2012':
            $scholarships_selected['ClassOf2012'] = "Class of 2012 Scholarship IHO Mr. Jason M. Ferguson &rsquo;96";
        break;

        case 'Class_Of_2011':
            $scholarships_selected['ClassOf2011'] = "Class of 2011 Scholarship IHO Ms. Anita Garland";
        break;

        case 'Class_Of_2010':
            $scholarships_selected['ClassOf2010'] = "Class of 2010 Scholarship IHO Mrs. Dottie Fahrner";
        break;

        case 'Class_Of_2009':
            $scholarships_selected['ClassOf2009'] = "Class of 2009 Scholarship";
        break;

        case 'Class_Of_2008':
            $scholarships_selected['ClassOf2008'] = "Class of 2008 Scholarship IHO Ms. Gerry Pettus";
        break;

        case 'Class_Of_2007':
            $scholarships_selected['ClassOf2007'] = "Class of 2007 Scholarship IHO Lt. Gen. Sam Wilson";
        break;

        case 'Class_Of_2006':
            $scholarships_selected['ClassOf2006'] = "Class of 2006 Scholarship IMO Peter C. Bance Jr.";
        break;

        case 'Class_Of_2005':
            $scholarships_selected['ClassOf2005'] = "Class of 2005 Scholarship IMO Prof. Lee Cohen";
        break;

        case 'Class_Of_2004':
            $scholarships_selected['ClassOf2004'] = "Class of 2004 Scholarship IMO C. Frazier &rsquo;04 &amp; IHO W. Simms";
        break;

        case 'Class_Of_2003':
            $scholarships_selected['ClassOf2003'] = "Class of 2003 Scholarship IHO Ralph A. Crawley";
        break;

        case 'Class_Of_1980':
            $scholarships_selected['ClassOf1980'] = "Class of 1980 Endowed Scholarship";
        break;

        case 'Class_Of_1961':
            $scholarships_selected['ClassOf1961'] = "Class of 1961 Good Men Good Citizens Scholarship";
        break;

        case 'Class_Of_1960':
            $scholarships_selected['ClassOf1960'] = "Class of 1960 Good Men Good Citizens Scholarship";
        break;

        case 'Class_Of_1958':
            $scholarships_selected['ClassOf1958'] = "Class of 1958 Summer College Endowment Fund";
        break;

        case 'Class_Of_1954':
            $scholarships_selected['ClassOf1954'] = "Class of 1954 Wilson Center Lecture Series";
        break;

        case 'Class_Of_1953':
            $scholarships_selected['ClassOf1953'] = "Class of 1953 Scholarship Endowment";
        break;

        case 'Class_Of_1951':
            $scholarships_selected['ClassOf1951'] = "Class of 1951 Memorial Scholarship";
        break;

        case 'Other':
            $scholarships_selected['OtherScholarship'] = $mysqli->real_escape_string($_POST['specinstr']);
        break;

        default:
          //they didn't select one of the given ones.
          break;
      }
    }
  }


$userEmail = $mysqli->real_escape_string($_POST['usersEmail']);
//check the user's email address
if (check_email_address($userEmail) == true) {
    $to = $userEmail;
    $headers = 'From: noreply@hsc.edu' . "\r\n" . 'Reply-To:webmaster@hsc.edu' . 'X-Mailer: PHP/' . phpversion();
    $subject = "Your Donation was Received!";
    $message = "Your donation was received. On behalf of Hampden-Sydney, we would like to thank you for your donation.";
    //we have composed our message. Now let's send it on. Commented out for development sake.
    //if(mail($to, $subject, $message, $headers)) {
        //echo("<p>Message sent!</p>");
    //} else {
        //echo "<p>Message delivery failed :( </p>";
   //}
} else {
    echo "The e-mail was invalid";
}

?>