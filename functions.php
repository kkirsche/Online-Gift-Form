<?php
	// ====================================================================================================// 
	// ! Returns Todays date to be echoed out to the browser. Formatted as Monday, August 27, 2012         //        
	// ====================================================================================================//
	function getTodaysDate() {
		$today = date("l, F j, Y");
		return $today;
	}

	// ====================================================================================================// 
	// ! Check that the user's e-mail address is valid                                                     //        
	// ====================================================================================================//
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
		      } else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
                 str_replace("\\\\","",$local))) {
		            // character not valid in local part unless 
		            // local part is quoted
		            if (!preg_match('/^"(\\\\"|[^"])+"$/',
		               str_replace("\\\\","",$local)))
		            {
		                $isValid = false;
		            }
        		}
        		if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))) {
            		// domain not found in DNS
            	$isValid = false;
        		}
    		}
   		return $isValid;
	}

	// ====================================================================================================// 
	// ! Check that the credit card entered is valid                                                       //        
	// ====================================================================================================//
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


	// ====================================================================================================// 
	// ! Returns a form key that we will validate to provide our users with better security on our site    //        
	// ====================================================================================================//
	class formKey {
		//Here we store the generated form key
		private $formKey;
		//Here we store the old form key (more info at step 4)
		private $old_formKey;
		//The constructor stores the form key (if one excists) in our class variable
		function __construct() {
			//We need the previous key so we store it
			if(isset($_SESSION['form_key'])) {
				$this->old_formKey = $_SESSION['form_key'];
			}
		}

		//Function to generate the form key
		private function generateKey() {
			//Get the IP-address of the user
			$ip = $_SERVER['REMOTE_ADDR'];
			//We use mt_rand() instead of rand() because it is better for generating random numbers.
			//We use 'true' to get a longer string.
			//See http://www.php.net/mt_rand for a precise description of the function and more examples.
			$uniqid = uniqid(mt_rand(), true);
			//Return the hash
			return md5($ip . $uniqid);
		}
		//Function to output the form key
		public function outputKey() {
			//Generate the key and store it inside the class
			$this->formKey = $this->generateKey();
			//Store the form key in the session
			$_SESSION['form_key'] = $this->formKey;
			//Output the form key
			echo "<input type=\"hidden\" name=\"form_key\" id=\"form_key\" value=\"".$this->formKey."\" />";
		}
		//Function that validated the form key POST data
		public function validate() {
			//We use the old formKey and not the new generated version
			if($_POST['form_key'] === $this->old_formKey) {
				//The key is valid, return true.
				return true;
			} else {
				//The key is invalid, return false.
				return false;
			}
		}
}
	// ====================================================================================================// 
	// ! Returns the abbreviation for a state    //        
	// ====================================================================================================//
function convert_state_to_abbreviation($state_name) {
		switch ($state_name) {
			case "Alabama":
				return "AL";
				break;
			case "Alaska":
				return "AK";
				break;
			case "Arizona":
				return "AZ";
				break;
			case "Arkansas":
				return "AR";
				break;
			case "California":
				return "CA";
				break;
			case "Colorado":
				return "CO";
				break;
			case "Connecticut":
				return "CT";
				break;
			case "Delaware":
				return "DE";
				break;
			case "Florida":
				return "FL";
				break;
			case "Georgia":
				return "GA";
				break;
			case "Hawaii":
				return "HI";
				break;
			case "Idaho":
				return "ID";
				break;
			case "Illinois":
				return "IL";
				break;
			case "Indiana":
				return "IN";
				break;
			case "Iowa":
				return "IA";
				break;
			case "Kansas":
				return "KS";
				break;
			case "Kentucky":
				return "KY";
				break;
			case "Louisana":
				return "LA";
				break;
			case "Maine":
				return "ME";
				break;
			case "Maryland":
				return "MD";
				break;
			case "Massachusetts":
				return "MA";
				break;
			case "Michigan":
				return "MI";
				break;
			case "Minnesota":
				return "MN";
				break;
			case "Mississippi":
				return "MS";
				break;
			case "Missouri":
				return "MO";
				break;
			case "Montana":
				return "MT";
				break;
			case "Nebraska":
				return "NE";
				break;
			case "Nevada":
				return "NV";
				break;
			case "New Hampshire":
				return "NH";
				break;
			case "New Jersey":
				return "NJ";
				break;
			case "New Mexico":
				return "NM";
				break;
			case "New York":
				return "NY";
				break;
			case "North Carolina":
				return "NC";
				break;
			case "North Dakota":
				return "ND";
				break;
			case "Ohio":
				return "OH";
				break;
			case "Oklahoma":
				return "OK";
				break;
			case "Oregon":
				return "OR";
				break;
			case "Pennsylvania":
				return "PA";
				break;
			case "Rhode Island":
				return "RI";
				break;
			case "South Carolina":
				return "SC";
				break;
			case "South Dakota":
				return "SD";
				break;
			case "Tennessee":
				return "TN";
				break;
			case "Texas":
				return "TX";
				break;
			case "Utah":
				return "UT";
				break;
			case "Vermont":
				return "VT";
				break;
			case "Virginia":
				return "VA";
				break;
			case "Washington":
				return "WA";
				break;
			case "Washington D.C.":
				return "DC";
				break;
			case "West Virginia":
				return "WV";
				break;
			case "Wisconsin":
				return "WI";
				break;
			case "Wyoming":
				return "WY";
				break;
			case "Alberta":
				return "AB";
				break;
			case "British Columbia":
				return "BC";
				break;
			case "Manitoba":
				return "MB";
				break;
			case "New Brunswick":
				return "NB";
				break;
			case "Newfoundland & Labrador":
				return "NL";
				break;
			case "Northwest Territories":
				return "NT";
				break;
			case "Nova Scotia":
				return "NS";
				break;
			case "Nunavut":
				return "NU";
				break;
			case "Ontario":
				return "ON";
				break;
			case "Prince Edward Island":
				return "PE";
				break;
			case "Quebec":
				return "QC";
				break;
			case "Saskatchewan":
				return "SK";
				break;
			case "Yukon Territory":
				return "YT";
				break;
			default:
				return $state_name;
		}
	}
?>