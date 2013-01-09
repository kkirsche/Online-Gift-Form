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
			case "American Samoa":
				return "AS";
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
			case "District of Columbia":
				return "DC";
				break;
			case "Guam":
				return "GU";
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
			case "Marshall Islands":
				return "MH";
				break;
			case "Michigan":
				return "MI";
				break;
			case "Micronesia":
				return "FM";
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
			case "Northern Marianas":
				return "MP";
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
			case "Palau":
				return "PW";
				break;
			case "Puerto Rico":
				return "PR";
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
			case "Virgin Islands":
				return "VI";
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
		// ====================================================================================================// 
	// ! Returns the abbreviation for a state    //        
	// ====================================================================================================//
function convert_country_to_abbreviation($country_name) {
		switch ($country_name) {
			case "Afghanistan":
				return "AF";
				break;
			case "Albania":
				return "AL";
				break;
			case "Algeria":
				return "DZ";
				break;
			case "American Samoa":
				return "AS";
				break;
			case "Andorra":
				return "AD";
				break;
			case "Angola":
				return "AO";
				break;
			case "Anguilla":
				return "AI";
				break;
			case "Antarctica":
				return "AQ";
				break;
			case "Antigua and Barbuda":
				return "AG";
				break;
			case "Argentina":
				return "AR";
				break;
			case "Armenia":
				return "AM";
				break;
			case "Aruba":
				return "AW";
				break;
			case "Australia":
				return "AU";
				break;
			case "Austria":
				return "AT";
				break;
			case "Azerbaijan":
				return "AZ";
				break;
			case "Bahrain":
				return "BH";
				break;
			case "Bangladesh":
				return "BD";
				break;
			case "Barbados":
				return "BB";
				break;
			case "Belarus":
				return "BY";
				break;
			case "Belgium":
				return "BE";
				break;
			case "Belize":
				return "BZ";
				break;
			case "Benin":
				return "BJ";
				break;
			case "Bermuda":
				return "BM";
				break;
			case "Bhutan":
				return "BT";
				break;
			case "Bolivia":
				return "BO";
				break;
			case "Bosnia and Herzegovina":
				return "BA";
				break;
			case "Botswana":
				return "BW";
				break;
			case "Brazil":
				return "BR";
				break;
			case "British Virgin Islands":
				return "VG";
				break;
			case "Brunei":
				return "BN";
				break;
			case "Bulgaria":
				return "BG";
				break;
			case "Burkina Faso":
				return "BF";
				break;
			case "Burundi":
				return "BI";
				break;
			case "Côte d'Ivoire":
				return "CI";
				break;
			case "Cambodia":
				return "KH";
				break;
			case "Cameroon":
				return "CM";
				break;
			case "Canada":
				return "CA";
				break;
			case "Cape Verde":
				return "CV";
				break;
			case "Cayman Islands":
				return "KY";
				break;
			case "Central African Republic":
				return "CF";
				break;
			case "Chad":
				return "TD";
				break;
			case "Chile":
				return "CL";
				break;
			case "China":
				return "CN";
				break;
			case "Colombia":
				return "CO";
				break;
			case "Comoros":
				return "KM";
				break;
			case "Congo":
				return "CG";
				break;
			case "Costa Rica":
				return "CR";
				break;
			case "Croatia":
				return "HR";
				break;
			case "Cuba":
				return "CU";
				break;
			case "Cyprus":
				return "CY";
				break;
			case "Czech Republic":
				return "CZ";
				break;
			case "Democratic Republic of the Congo":
				return "CD";
				break;
			case "Denmark":
				return "DK";
				break;
			case "Djibouti":
				return "DJ";
				break;
			case "Dominica":
				return "DM";
				break;
			case "Dominican Republic":
				return "DO";
				break;
			case "East Timor":
				return "TP";
				break;
			case "Ecuador":
				return "EC";
				break;
			case "Egypt":
				return "EG";
				break;
			case "El Salvador":
				return "SV";
				break;
			case "Equatorial Guinea":
				return "GQ";
				break;
			case "Eritrea":
				return "ER";
				break;
			case "Estonia":
				return "EE";
				break;
			case "Ethiopia":
				return "ET";
				break;
			case "Faeroe Islands":
				return "FO";
				break;
			case "Falkland Islands":
				return "FK";
				break;
			case "Fiji":
				return "FJ";
				break;
			case "Finland":
				return "FI";
				break;
			case "Former Yugoslav Republic of Macedonia":
				return "MK";
				break;
			case "France":
				return "FR";
				break;
			case "Gabon":
				return "GA";
				break;
			case "Georgia":
				return "GE";
				break;
			case "Germany":
				return "DE";
				break;
			case "Ghana":
				return "GH";
				break;
			case "Greece":
				return "GR";
				break;
			case "Greenland":
				return "GL";
				break;
			case "Grenada":
				return "GD";
				break;
			case "Guam":
				return "GU";
				break;
			case "Guatemala":
				return "GT";
				break;
			case "Guinea":
				return "GN";
				break;
			case "Guinea-Bissau":
				return "GW";
				break;
			case "Guyana":
				return "GY";
				break;
			case "Haiti":
				return "HT";
				break;
			case "Honduras":
				return "HN";
				break;
			case "Hong Kong":
				return "HK";
				break;
			case "Hungary":
				return "HU";
				break;
			case "Iceland":
				return "IS";
				break;
			case "India":
				return "IN";
				break;
			case "Indonesia":
				return "ID";
				break;
			case "Iran":
				return "IR";
				break;
			case "Iraq":
				return "IQ";
				break;
			case "Ireland":
				return "IE";
				break;
			case "Israel":
				return "IL";
				break;
			case "Italy":
				return "IT";
				break;
			case "Jamaica":
				return "JM";
				break;
			case "Japan":
				return "JP";
				break;
			case "Jordan":
				return "JO";
				break;
			case "Kazakhstan":
				return "KZ";
				break;
			case "Kenya":
				return "KE";
				break;
			case "Kiribati":
				return "KI";
				break;
			case "Kuwait":
				return "KW";
				break;
			case "Kyrgyzstan":
				return "KG";
				break;
			case "Laos":
				return "LA";
				break;
			case "Latvia":
				return "BG";
				break;
			case "Lebanon":
				return "LB";
				break;
			case "Lesotho":
				return "LS";
				break;
			case "Liberia":
				return "LR";
				break;
			case "Libya":
				return "LY";
				break;
			case "Liechtenstein":
				return "LI";
				break;
			case "Lithuania":
				return "LT";
				break;
			case "Luxembourg":
				return "LU";
				break;
			case "Macau":
				return "MO";
				break;
			case "Madagascar":
				return "MG";
				break;
			case "Malawi":
				return "MW";
				break;
			case "Malaysia":
				return "MY";
				break;
			case "Maldives":
				return "MV";
				break;
			case "Mali":
				return "ML";
				break;
			case "Malta":
				return "MT";
				break;
			case "Marshall Islands":
				return "MH";
				break;
			case "Mauritania":
				return "MR";
				break;
			case "Mauritius":
				return "MU";
				break;
			case "Mexico":
				return "MX";
				break;
			case "Micronesia":
				return "FM";
				break;
			case "Moldova":
				return "MD";
				break;
			case "Monaco":
				return "MC";
				break;
			case "Mongolia":
				return "MN";
				break;
			case "Montenegro":
				return "ME";
				break;
			case "Montserrat":
				return "MS";
				break;
			case "Morocco":
				return "MA";
				break;
			case "Mozambique":
				return "MZ";
				break;
			case "Myanmar":
				return "MM";
				break;
			case "Namibia":
				return "NA";
				break;
			case "Nauru":
				return "NR";
				break;
			case "Nepal":
				return "NP";
				break;
			case "Netherlands":
				return "NL";
				break;
			case "Netherlands Antilles":
				return "AN";
				break;
			case "New Zealand":
				return "NZ";
				break;
			case "Nicaragua":
				return "NI";
				break;
			case "Niger":
				return "NE";
				break;
			case "Nigeria":
				return "NG";
				break;
			case "Norfolk Island":
				return "NF";
				break;
			case "North Korea":
				return "KP";
				break;
			case "Northern Marianas":
				return "MP";
				break;
			case "Norway":
				return "NO";
				break;
			case "Oman":
				return "OM";
				break;
			case "Pakistan":
				return "PK";
				break;
			case "Palau":
				return "PW";
				break;
			case "Panama":
				return "PA";
				break;
			case "Papua New Guinea":
				return "PG";
				break;
			case "Paraguay":
				return "PY";
				break;
			case "Peru":
				return "PE";
				break;
			case "Philippines":
				return "PH";
				break;
			case "Pitcairn Islands":
				return "PN";
				break;
			case "Poland":
				return "PL";
				break;
			case "Portugal":
				return "PT";
				break;
			case "Puerto Rico":
				return "PR";
				break;
			case "Qatar":
				return "QA";
				break;
			case "Romania":
				return "RO";
				break;
			case "Russia":
				return "RU";
				break;
			case "Rwanda":
				return "RW";
				break;
			case "São Tomé and Príncipe":
				return "ST";
				break;
			case "Saint Helena":
				return "SH";
				break;
			case "Saint Kitts and Nevis":
				return "KN";
				break;
			case "Saint Lucia":
				return "LC";
				break;
			case "Saint Vincent and the Grenadines":
				return "VC";
				break;
			case "Samoa":
				return "WS";
				break;
			case "San Marino":
				return "SM";
				break;
			case "Saudi Arabia":
				return "SA";
				break;
			case "Senegal":
				return "SN";
				break;
			case "Serbia":
				return "RS";
				break;
			case "Seychelles":
				return "SC";
				break;
			case "Sierra Leone":
				return "SL";
				break;
			case "Singapore":
				return "SG";
				break;
			case "Slovakia":
				return "SK";
				break;
			case "Slovenia":
				return "SI";
				break;
			case "Solomon Islands":
				return "SB";
				break;
			case "Somalia":
				return "SO";
				break;
			case "South Africa":
				return "ZA";
				break;
			case "South Georgia and the South Sandwich Islands":
				return "GS";
				break;
			case "South Korea":
				return "KR";
				break;
			case "Spain":
				return "ES";
				break;
			case "Sri Lanka":
				return "LK";
				break;
			case "Sudan":
				return "SD";
				break;
			case "Suriname":
				return "SR";
				break;
			case "Swaziland":
				return "SZ";
				break;
			case "Sweden":
				return "SE";
				break;
			case "Switzerland":
				return "CH";
				break;
			case "Syria":
				return "SY";
				break;
			case "Taiwan":
				return "TW";
				break;
			case "Tajikistan":
				return "TJ";
				break;
			case "Tanzania":
				return "TZ";
				break;
			case "Thailand":
				return "TH";
				break;
			case "The Bahamas":
				return "BS";
				break;
			case "The Gambia":
				return "GM";
				break;
			case "Togo":
				return "TG";
				break;
			case "Tonga":
				return "TO";
				break;
			case "Trinidad and Tobago":
				return "TT";
				break;
			case "Tunisia":
				return "TN";
				break;
			case "Turkey":
				return "TR";
				break;
			case "Turkmenistan":
				return "TM";
				break;
			case "Turks and Caicos Islands":
				return "TC";
				break;
			case "Tuvalu":
				return "TV";
				break;
			case "US Virgin Islands":
				return "VI";
				break;
			case "Uganda":
				return "UG";
				break;
			case "Ukraine":
				return "UA";
				break;
			case "United Arab Emirates":
				return "AE";
				break;
			case "United Kingdom":
				return "GB";
				break;
			case "United States":
				return "USA";
				break;
			case "United States of America":
				return "USA";
				break;
			case "US":
				return "USA";
				break;
			case "Uruguay":
				return "UY";
				break;
			case "Uzbekistan":
				return "UZ";
				break;
			case "Vanuatu":
				return "VU";
				break;
			case "Vatican City":
				return "VA";
				break;
			case "Venezuela":
				return "VE";
				break;
			case "Vietnam":
				return "VN";
				break;
			case "Western Sahara":
				return "EH";
				break;
			case "Yemen":
				return "YE";
				break;
			case "Zambia":
				return "ZM";
				break;
			case "Zimbabwe":
				return "ZW";
				break;
			default:
				return $country_name;
		}
	}
?>