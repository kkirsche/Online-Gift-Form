<?php
if(session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
require("functions.php");
// ====================================================================================================// 
// ! Connect to MySQLi to allow escaping of inputs, and form processing.                               //
// ====================================================================================================//
$dbHostname = "localhost";
$dbUsername = "UserGiftForm";
$dbPassword = "Nev3rUseTh1sP4ssw0rdEverAgain!";
$dbDatabaseName = "OnlineGiftForm";
$mysqli = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbDatabaseName);

if($mysqli->connect_errno) {
    printf("Connection failed: %s\n", $mysqli->connect_error());
    exit();
}

$isValid = true;
$errorMessage = "<h3>There was an error</h3><hr />";
// ====================================================================================================// 
// ! Do formKey() check to ensure that our form came form the right place                              //
// ====================================================================================================//
    //Create the formKey variable
    $formKey = new formKey();
    //let's check that it is correct
    if(!isset($_POST['form_key']) || !$formKey->validate()) {
        //Form key is invalid, show an error
        $isValid = false;
        $error = 'Form key error!';
    } else {
        //Do the rest of your validation here
        $error = 'No form key error!';
    }

    if($error == "Form key error!") {
        die("There was an error with the form key. For your safety, the form was not processed. Please return to the donation form, and try again. ");
    } else {

// ====================================================================================================// 
// ! Our formKey is correct, now let's get the form data                                               //
// ====================================================================================================//
        //get the donation type and then process the respective fields accordingly.
        $donationType = $_POST['donationType'];
        if($donationType == "oneTimeGift") {
            //Get the Gift Amount pieces
            //one time donations
            $totalGiftAmount = $_POST['oneTimeDonationValue'];
        } else if ($donationType == "recurringDonation") {
            //recurring donations
            $recurringGift = array(
                "donationAmount" => $_POST['recurringDonationValue'],
                "numberOfPayments" => $_POST['numberOfPayments'],
                "paymentFrequency" => $_POST['paymentFrequency']
            );
            //calculate their total gift. We want to do it again to avoid javascript related errors or changes.
            $totalGiftAmount = $recurringGift['donationAmount'] * $recurringGift['numberOfPayments'];
        } else {
            $isValid = false;
            $errorMessage .= "Sorry, there was an error. Please select one of the two types of donations. Please return to the first step and try again.<br />";
        }
        

  //create the array to store our checkbox values.
    //now let's get the values of the checkboxes starting with Scholarships
    if(!empty($_POST['list-items'])) {
        foreach($_POST['list-items'] as $listItem) {
        //check the values and add to the array accordingly
            switch ($listItem) {
                //Begin Scholarships
                case 'Good_Men_Good_Citizens':
                    $selected_items['GoodMenGoodCitizens'] = "Good Men, Good Citizens Scholarship";
                break;

                case 'Class_Scholarship':
                    $selected_items['ClassScholarship'] = "Class Scholarship";
                break;

                case 'Other_Scholarship':
                    $selected_items['OtherScholarship'] = $_POST['specinstr'];
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
                    $selected_items['OtherAcademics'] = $_POST['specinstr'];
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
          $selected_items['SpecialInstructions'] = $_POST['specinstr'];
    } else {
        //it's empty :(
        $isValid = false;
        $errorMessage .= "You did not choose a fund to donate to! Please choose where you would like to donate to on Step 3.<br />";
    }
        $strippedPhoneNumber = preg_replace("/[^0-9]/", "", $_POST['usersPhoneNumber']);

        //make an array of the user information
        $userInfo = array(
            "firstName" => $_POST['usersFirstName'],
            "lastName" => $_POST['usersLastName'],
            "fullName" => $_POST['usersFirstName'] . " " . $_POST['usersLastName'],
            "classYear" => $_POST['usersClassYear'],
            "selectedClassYearScholarship" => $_POST['classYearScholarshipSelection'],
            "address1" => $_POST['usersStreetAddress'],
            "address2" => $_POST['usersSecondaryAddress'],
            "fullAddress" => $_POST['usersStreetAddress'] . "\n" . $_POST['usersSecondaryAddress'],
            "city" => $_POST['usersCity'],
            "fullState" => $_POST['usersState'],
            "state" => convert_state_to_abbreviation($_POST['usersState']),
            "zipcode" => $_POST['usersZip'],
            "fullCountry" => $_POST['usersCountry'],
            "country" => convert_country_to_abbreviation($_POST['usersCountry']),
            "phoneNumber" => $strippedPhoneNumber,
            "email" => $_POST['usersEmail'],
            "specialInstructions" => $_POST['specinstr']
        );

        //these numbers should be percentages. A maximum of 100, minimum of 0.
        //For class years it's classOfXXXXAllocation with XXXX being the year
        // ( if is_numric on the posted item returns true ? Divide it by 100 : Else convert string to number and do something)
        $userAllocations = array(
            "unrestrictedAllocation" => ($_POST['unrestricted-Allocation'] / 100),
            "goodMenGoodCitizensAllocation" => ($_POST['Good_Men_Good_Citizens-Allocation'] / 100),
            "classYearScholarshipAllocation" => ($_POST['Class_Of_' . $userInfo['selectedClassYearScholarship'] . '-Allocation'] / 100),
            "atkinsonMuseumAllocation" => ($_POST['Atkinson_Museum-Allocation'] / 100),
            "bortzLibraryAllocation" => ($_POST['Bortz_Library-Allocation'] / 100),
            "cultureAndCommunityAllocation" => ($_POST['Culture_and_Community-Allocation'] / 100),
            "wilsonCenterAllocation" => ($_POST['Wilson_Center-Allocation'] / 100),
            "baseballBigHittersClubAllocation" => ($_POST['Baseball_Big_Hitters_Club-Allocation'] / 100),
            "basketballRoundballClubAllocation" => ($_POST['Basketball_Roundball_Club-Allocation'] / 100),
            "crossCountryHarriersAllocation" => ($_POST['Cross_Country_Harriers-Allocation'] / 100),
            "everettStadiumAllocation" => ($_POST['Everett_Stadium-Allocation'] / 100),
            "footballGridironClubAllocation" => ($_POST['Football_Gridiron_Club-Allocation'] / 100),
            "golfHoleInOneClubAllocation" => ($_POST['Golf_Hole_In_One_Club-Allocation'] / 100),
            "kirkAthleticCenterAllocation" => ($_POST['Kirk_Athletic_Center-Allocation'] / 100),
            "lacrosseFaceOffClubAllocation" => ($_POST['Lacrosse_Face_Off_Club-Allocation'] / 100),
            "rugbyClubAllocation" => ($_POST['Rugby_Club-Allocation'] / 100),
            "soccerGoalClubAllocation" => ($_POST['Soccer_Goal_Club-Allocation'] / 100),
            "swimmingClubAllocation" => ($_POST['Swimming_Club-Allocation'] / 100),
            "tennisRacquetClubAllocation" => ($_POST['Tennis_Racquet_Club-Allocation'] / 100),
            "otherAllocation" => (($_POST['Other_Scholarship-Allocation'] + $_POST['Other_Academic-Allocation']) / 100)
            );

        //next we want to get the amount of the total gift that will go to any one place.
        //To do this:   $finalAmountToAllocation = ($totalGiftAmount * $allocationPercentage) Allocation percentages are in decimal form. 1 = 100% .5 = 50%, etc.
        $userDonationAmountBasedOnAllocations = array(
            "unrestrictedFundDonationAmount" => ($totalGiftAmount * $userAllocations['unrestrictedAllocation']),
            "goodMenGoodCitizensDonationAmount" => ($totalGiftAmount * $userAllocations['goodMenGoodCitizensAllocation']),
            "classYearScholarshipDonationAmount" => ($totalGiftAmount * $userAllocations['classYearScholarshipAllocation']),
            "atkinsonMuseumDonationAmount" => ($totalGiftAmount * $userAllocations['atkinsonMuseumAllocation']),
            "bortzLibraryDonationAmount" => ($totalGiftAmount * $userAllocations['bortzLibraryAllocation']),
            "cultureAndCommunityDonationAmount" => ($totalGiftAmount * $userAllocations['cultureAndCommunityAllocation']),
            "wilsonCenterDonationAmount" => ($totalGiftAmount * $userAllocations['wilsonCenterAllocation']),
            "baseballBigHittersClubDonationAmount" => ($totalGiftAmount * $userAllocations['baseballBigHittersClubAllocation']),
            "basketballRoundballClubDonationAmount" => ($totalGiftAmount * $userAllocations['basketballRoundballClubAllocation']),
            "crossCountryHarriersDonationAmount" => ($totalGiftAmount * $userAllocations['crossCountryHarriersAllocation']),
            "everettStadiumDonationAmount" => ($totalGiftAmount * $userAllocations['everettStadiumAllocation']),
            "footballGridironClubDonationAmount" => ($totalGiftAmount * $userAllocations['footballGridironClubAllocation']),
            "golfHoleInOneClubDonationAmount" => ($totalGiftAmount * $userAllocations['golfHoleInOneClubAllocation']),
            "kirkAthleticCenterDonationAmount" => ($totalGiftAmount * $userAllocations['kirkAthleticCenterAllocation']),
            "lacrosseFaceOffClubDonationAmount" => ($totalGiftAmount * $userAllocations['lacrosseFaceOffClubAllocation']),
            "rugbyClubDonationAmount" => ($totalGiftAmount * $userAllocations['rugbyClubAllocation']),
            "soccerGoalClubDonationAmount" => ($totalGiftAmount * $userAllocations['soccerGoalClubAllocation']),
            "swimmingClubDonationAmount" => ($totalGiftAmount * $userAllocations['swimmingClubAllocation']),
            "tennisRacquetClubDonationAmount" => ($totalGiftAmount * $userAllocations['tennisRacquetClubAllocation']),
            "otherDonationAmount" => ($totalGiftAmount * $userAllocations['otherAllocation']),
            );

        //Make an array of the credit card information
        $userCreditCardInfo = array(
            "nameOnCreditCard" => $mysqli->real_escape_string($_POST['nameOnCard']),
            "creditCardNumber" => $mysqli->real_escape_string($_POST['numberOnCard']),
            "creditCardType" => "",
            "creditCardSecurityCode" => $mysqli->real_escape_string($_POST['securityCodeOnCard']),
            "creditCardExpirationMonth" => $_POST['expirationMonthOnCard'],
            "creditCardExpirationYear" => $_POST['expirationYearOnCard']
        );
// ====================================================================================================// 
// ! Validate the data that we have taken from the form                                                //
// ====================================================================================================//
        if(check_Credit_Card($userCreditCardInfo['creditCardNumber'])) {
            $userCreditCardInfo['creditCardType'] = check_Credit_Card($userCreditCardInfo['creditCardNumber']);
        } else {
            $isValid = false;
            $errorMessage .= "We're sorry, but the credit card number that you entered was invalid.<br />";
        }



        //check the user's email address
        if (check_email_address($userInfo['email']) != true) {
            $isValid = false;
            $errorMessage .= "The e-mail was invalid.<br />";
        }

// ====================================================================================================// 
// ! Display the message of success or error                                                           //
// ====================================================================================================//
        if($isValid) {
            echo "Success! The form has been submitted, and all of your information was correct!";
        } else {
            print_r($userInfo);
            echo "<p class=\"centerText\">".$errorMessage."</p>";
        }
    }
    //close the database connection.
    $mysqli->close();
?>