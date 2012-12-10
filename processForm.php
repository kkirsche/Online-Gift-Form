
<?php
//configure for below
//let's make it so we can use MySQLi. This is an example for local host only. NEVER use this type of database name, password, etc. in a production environment.
$mysqli = new mysqli("localhost", "UserGiftForm", "Nev3rUseTh1sP4ssw0rdEverAgain!", "OnlineGiftForm");

if(mysqli_connect_errno()) {
    printf("Connection failed: %s\n", mysqli_connect_error());
    exit();
}

//Start up with our functions
function check_email_address($email) {
    //Give them the benefit of the doubt that it is a correct email address
    $isValid = true;
    $atIndex = strrpos($email, "@");
    if (is_bool($atIndex) && !$atIndex) {
      $isValid = false;
    } else {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64) {
         // local part length exceeded
         $isValid = false;
      } else if ($domainLen < 1 || $domainLen > 255) {
         // domain part length exceeded
         $isValid = false;
      } else if ($local[0] == '.' || $local[$localLen-1] == '.') {
         // local part starts or ends with '.'
         $isValid = false;
      } else if (preg_match('/\\.\\./', $local)) {
         // local part has two consecutive dots
         $isValid = false;
      } else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      } else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      } else if
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

        if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
        {
            // domain not found in DNS
            $isValid = false;
        }
    }
   return $isValid;
}

function check_Credit_Card($cc, $extra_check = false){
    $cards = array(
        "visa" => "(4\d{12}(?:\d{3})?)",
        "amex" => "(3[47]\d{13})",
        "jcb" => "(35[2-8][89]\d\d\d{10})",
        "maestro" => "((?:5020|5038|6304|6579|6761)\d{12}(?:\d\d)?)",
        "solo" => "((?:6334|6767)\d{12}(?:\d\d)?\d?)",
        "mastercard" => "(5[1-5]\d{14})",
        "switch" => "(?:(?:(?:4903|4905|4911|4936|6333|6759)\d{12})|(?:(?:564182|633110)\d{10})(\d\d)?\d?)",
    );
    $names = array("Visa", "American Express", "JCB", "Maestro", "Solo", "Mastercard", "Switch");
    $matches = array();
    $pattern = "#^(?:".implode("|", $cards).")$#";
    $result = preg_match($pattern, str_replace(" ", "", $cc), $matches);
    if($extra_check && $result > 0){
        $result = (validatecard($cc))?1:0;
    }
    return ($result>0)?$names[sizeof($matches)-2]:false;
}

//Get the Gift Amount pieces
  //one time donations
  $oneTimeGiftAmount = $_POST['oneTimeDonationValue'];

  //recurring donations
  $recurringGift = array();
  $recurringGift['donationAmount'] = $mysqli->real_escape_string($_POST['recurringDonationValue']);
  $recurringGift['numberOfPayments'] = $mysqli->real_escape_string($_POST['numberOfPayments']);
  $recurringGift['paymentFrequency'] = $mysqli->real_escape_string($_POST['paymentFrequency']);
  //calculate their total gift. We want to do it again to avoid javascript related errors or changes.
  $recurringGift['totalGiftAmount'] = $recurringGift['donationAmount'] * $recurringGift['numberOfPayments'];
  
  //create the array to store our checkbox values.
  $selected_items = array();
    //now let's get the values of the checkboxes starting with Scholarships
    if(!empty($_POST['list-items'])) {
        foreach($_POST['list-items'] as $listItem) {
        //check the values and add to the array accordingly
            switch ($listItem) {
                //Begin Scholarships
                case 'Good_Men_Good_Citizens':
                    $selected_items['GoodMenGoodCitizens'] = "Good Men, Good Citizens Scholarship";
                break;

                case 'Class_Of_2012':
                    $selected_items['ClassOf2012'] = "Class of 2012 Scholarship IHO Mr. Jason M. Ferguson &rsquo;96";
                break;

                case 'Class_Of_2011':
                    $selected_items['ClassOf2011'] = "Class of 2011 Scholarship IHO Ms. Anita Garland";
                break;

                case 'Class_Of_2010':
                    $selected_items['ClassOf2010'] = "Class of 2010 Scholarship IHO Mrs. Dottie Fahrner";
                break;

                case 'Class_Of_2009':
                    $selected_items['ClassOf2009'] = "Class of 2009 Scholarship";
                break;

                case 'Class_Of_2008':
                    $selected_items['ClassOf2008'] = "Class of 2008 Scholarship IHO Ms. Gerry Pettus";
                break;

                case 'Class_Of_2007':
                    $selected_items['ClassOf2007'] = "Class of 2007 Scholarship IHO Lt. Gen. Sam Wilson";
                break;

                case 'Class_Of_2006':
                    $selected_items['ClassOf2006'] = "Class of 2006 Scholarship IMO Peter C. Bance Jr.";
                break;

                case 'Class_Of_2005':
                    $selected_items['ClassOf2005'] = "Class of 2005 Scholarship IMO Prof. Lee Cohen";
                break;

                case 'Class_Of_2004':
                    $selected_items['ClassOf2004'] = "Class of 2004 Scholarship IMO C. Frazier &rsquo;04 &amp; IHO W. Simms";
                break;

                case 'Class_Of_2003':
                    $selected_items['ClassOf2003'] = "Class of 2003 Scholarship IHO Ralph A. Crawley";
                break;

                case 'Class_Of_1980':
                    $selected_items['ClassOf1980'] = "Class of 1980 Endowed Scholarship";
                break;

                case 'Class_Of_1961':
                    $selected_items['ClassOf1961'] = "Class of 1961 Good Men Good Citizens Scholarship";
                break;

                case 'Class_Of_1960':
                    $selected_items['ClassOf1960'] = "Class of 1960 Good Men Good Citizens Scholarship";
                break;

                case 'Class_Of_1958':
                    $selected_items['ClassOf1958'] = "Class of 1958 Summer College Endowment Fund";
                break;

                case 'Class_Of_1954':
                    $selected_items['ClassOf1954'] = "Class of 1954 Wilson Center Lecture Series";
                break;

                case 'Class_Of_1953':
                    $selected_items['ClassOf1953'] = "Class of 1953 Scholarship Endowment";
                break;

                case 'Class_Of_1951':
                    $selected_items['ClassOf1951'] = "Class of 1951 Memorial Scholarship";
                break;

                case 'Other_Scholarship':
                    $selected_items['OtherScholarship'] = $mysqli->real_escape_string($_POST['specinstr']);
                break;

                //Begins Academics
                case 'Atkinson_Museum':
                    $selected_items['AtkinsonMuseum'] = "Atkinson Museum";
                break;

                case 'Bortz_Library':
                    $selected_items['BortzLibrary'] = "Bortz Library";
                break;

                case 'Culture_and_Community':
                    $selected_items['CultureAndCommunity'] = "Culture and Community";
                break;

                case 'Wilson_Center':
                    $selected_items['WilsonCenter'] = "the Wilson Center";
                break;

                case 'Other_Academic_Area':
                    $selected_items['OtherAcademics'] = $mysqli->real_escape_string($_POST['specinstr']);
                break;

                //Begin Athletics
                case 'Baseball_Big_Hitters_Club':
                    $selected_items['BaseballBigHittersClub'] = "Baseball Big Hitters Club";
                break;

                case 'Basketball_Roundball_Club':
                    $selected_items['BasketballRoundballClub'] = "Basketball Roundball Club";
                break;

                case 'Cross_Country_Harriers':
                    $selected_items['CrossCOuntryHarriers'] = "Cross Country Harriers";
                break;

                case 'Everett_Stadium':
                    $selected_items['EverettStadium'] = "Everett Stadium";
                break;

                case 'Football_Gridiron_Club': 
                    $selected_items['FootballGridironClub'] = "Football Gridiron Club";
                break;

                case 'Golf_Hole_In_One_Club':
                    $selected_items['GolfHoleInOneClub'] = "Golf Hole In One Club";
                break;

                case 'Kirk_Athletic_Center':
                    $selected_items['KirkAthleticCenter'] = "Kirk Athletic Center";
                break;

                case 'Lacrosse_Face_Off_Club':
                    $selected_items['LacrosseFaceOffClub'] = "Lacrosse Face Off Club";
                break;

                case 'Rugby_Club':
                    $selected_items['RugbyClub'] = "Rugby Club";
                break;

                case 'Soccer_Goal_Club':
                    $selected_items['SoccerGoalClub'] = "Soccer Goal Club";
                break;

                case 'Swimming_Club':
                    $selected_items['SwimmingClub'] = "Swimming Club";
                break;

                case 'Tennis_Racquet_Club':
                    $selected_items['TennisRacquetClub'] = "Tennis Racquet Club";
                break;

                case 'unrestricted':
                    $selected_items['Unrestricted'] = "Unrestricted Hampden-Sydney Fund";
                break;

                default:
                  //they didn't select one of the given values, they changed a value (XSS) or did something mean. We don't wanna touch those fields or values.
                  break;
              }
          }
          //we also want to have the special instructions, just in case.
          $selected_items['SpecialInstructions'] = $mysqli->real_escape_string($_POST['specinstr']);
    }

    //make an array of the user information
    $userInfo = array();
    $userInfo['firstName'] = $mysqli->real_escape_string($_POST['usersFirstName']);
    $userInfo['lastName'] = $mysqli->real_escape_string($_POST['usersLastName']);
    $userInfo['address1'] = $mysqli->real_escape_string($_POST['usersStreetAddress']);
    $userInfo['address2'] = $mysqli->real_escape_string($_POST['usersSecondaryAddress']);
    $userInfo['city'] = $mysqli->real_escape_string($_POST['usersCity']);
    $userInfo['country'] = $mysqli->real_escape_string($_POST['usersCountry']);
    $userInfo['phoneNumber'] = $mysqli->real_escape_string($_POST['usersPhoneNumber']);
    $userInfo['email'] = $mysqli->real_escape_string($_POST['usersEmail']);
    //check the user's email address
    if (check_email_address($userInfo['email']) == true) {
        $to = $userInfo['email'];
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