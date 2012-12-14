<?php
session_start();
require("functions.php");
// ====================================================================================================// 
// ! Connect to MySQLi to allow escaping of inputs, and form processing.                               //
// ====================================================================================================//
$dbHostname = "localhost";
$dbUsername = "UserGiftForm";
$dbPassword = "Nev3rUseTh1sP4ssw0rdEverAgain!";
$dbDatabaseName = "OnlineGiftForm";
$mysqli = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbDatabaseName);

if(mysqli_connect_errno()) {
    printf("Connection failed: %s\n", mysqli_connect_error());
    exit();
}
// ====================================================================================================// 
// ! Do formKey() check to ensure that our form came form the right place                              //
// ====================================================================================================//
    //Create the formKey variable
    $formKey = new formKey();
    //let's check that it is correct
    if(!isset($_POST['form_key']) || !$formKey->validate()) {
        //Form key is invalid, show an error
        $error = 'Form key error!';
    } else {
        //Do the rest of your validation here
        $error = 'No form key error!';
    }

    if($error == "Form key error!") {
        die("There was an error with the form key. For your safety, the form was not processed. Please return to the donation form, and try again.");
    } else {
// ====================================================================================================// 
// ! Our formKey is correct, now let's get the form data                                               //
// ====================================================================================================//
        //Get the Gift Amount pieces
        //one time donations
        $oneTimeGiftAmount = $_POST['oneTimeDonationValue'];

        //recurring donations
        $recurringGift = array(
            "donationAmount" => $mysqli->real_escape_string($_POST['recurringDonationValue']),
            "numberOfPayments" => $mysqli->real_escape_string($_POST['numberOfPayments']),
            "paymentFrequency" => $mysqli->real_escape_string($_POST['paymentFrequency'])
        );
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
        $userInfo = array(
            "firstName" => $mysqli->real_escape_string($_POST['usersFirstName']),
            "lastName" => $mysqli->real_escape_string($_POST['usersLastName']),
            "address1" => $mysqli->real_escape_string($_POST['usersLastName']),
            "address2" => $mysqli->real_escape_string($_POST['usersSecondaryAddress']),
            "city" => $mysqli->real_escape_string($_POST['usersCity']),
            "country" => $mysqli->real_escape_string($_POST['usersCountry']),
            "phoneNumber" => $mysqli->real_escape_string($_POST['usersPhoneNumber']),
            "email" => $mysqli->real_escape_string($_POST['usersEmail'])
        );
        
        //Make an array of the credit card information
        $userCreditCardInfo = array(
            "nameOnCreditCard" => $mysqli->real_escape_string($_POST['nameOnCard']),
            "creditCardNumber" => $mysqli->real_escape_string($_POST['numberOnCard']),
            "creditCardSecurityCode" => $mysqli->real_escape_string($_POST['securityCodeOnCard']),
            "creditCardExpirationDate" => $mysqli->real_escape_string($_POST['expirationMonthOnCard'] . "/" . $_POST['expirationYearOnCard'])
        );
// ====================================================================================================// 
// ! Validate the data that we have taken from the form                                                //
// ====================================================================================================//
        if(check_Credit_Card($userCreditCardInfo['creditCardNumber'])) {
            $userCreditCardInfo['creditCardType'] = check_Credit_Card($userCreditCardInfo['creditCardNumber']);
        } else {
            echo "Invalid Credit Card Number";
        }



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

// ====================================================================================================// 
// ! Display the message of success or error                                                           //
// ====================================================================================================//

    }
?>