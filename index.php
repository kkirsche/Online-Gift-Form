<?php
include "functions.php";
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>
		Online Gift &mdash; Gift Information
	</title>
	<meta name="description" content="Hampden-Sydney College Online Gift Form">
	<meta name="viewport" content="width=device-width">
<!--Old Style's from Old Form-->
<style type="text/css" media="all">
@import "http://www.hsc.edu/PreBuilt/hsc1.css";
.arrow {
	color: #999;
}
.block { margin-top:-20px; }
.scrolllist {
		height: 75px;
	width: 475px;
	margin-left:26px;
		padding: 5px;
		overflow: auto;
		border: 1px solid #ccc
}
.scrolllist2 {
		height: 75px;
	width: 300px;
	margin-left:26px;
		padding: 5px;
		overflow: auto;
		border: 1px solid #ccc
}
</style>
<link rel="stylesheet" href="css/style.css">
<!-- All JavaScript at the bottom, except this Modernizr build.
       Modernizr enables HTML5 elements & feature detects for optimal performance.
       Create your own custom Modernizr build: www.modernizr.com/download/ -->
  <script src="js/libs/modernizr-2.5.3.min.js"></script>
</head>
<body>
    <noscript>This page requires javascript to function correctly</noscript>
	<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6. chromium.org/developers/how-tos/chrome-frame-getting-started -->
  	<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
  	<div role="main" id="content">
 		<header>
			<a href="http://www.hsc.edu">
				<img src="http://www.hsc.edu/images/hpheadernew2.gif" alt="Hampden-Sydney College " id="headerImage">
			</a>
		</header>

		<!-- DATE -->
		<p class="floatRight">
            <?php echo getTodaysDate(); ?>
		</p>

		<!--Title-->
		<h1 class="floatLeft">
			The Hampden-Sydney Fund
		</h1>
		<br /><br /><br />
		<span class="headerTagline">
				<strong>Making an atmosphere of sound learning a reality, year after year.</strong>
		</span>

		<div class="clearfix"></div>
		<!-- /DATE -->
		<br />
		<!--Inform the user that the form IS secure!-->
		<p>
			To make a credit card gift to Hampden-Sydney College, simply fill out the form below and continue to the payment information page. Credit card information is handled using a secure web server and all information is encrypted before submission to the Office of Institutional Advancement. If you have any questions, please <a href="mailto:lreinson@hsc.edu" title="Contact Us">Contact Us</a> with any questions or updates. For Stock Gift Donors, please view the instructions <a href="https://secure.hsc.edu/gifts/StockGiftInstructions.pdf" title="Stock Gift Donor Instructions">here</a>.
		</p>
                <!--One Time or Recurring Step-->
                <div class="formStep" id="step0">
                    <!--Ask whether it's a one-time gift or a recurring gift-->
                    <div class="centerButtons">
                        <a href="#" id="oneTimeGift"><img src="img/One-TimeGift.png" class="OTG" alt="I would like to make a one-time gift" /></a>
                        <a href="#" id="recurringGift"><img src="img/RecurringGift.png" alt="I would like to make a recurring gift" /></a>
                    </div>
                </div>
                <!--End Question Step-->

                <form id="DonationForm" action="processForm.php" method="post">
    			<!--First Step-->
    			<div class="formStep" id="step1">
                    <!--One Time Gift-->
    				<div id="makingAOneTimeGift">
                        Enter Donation Amount Here: $<input type="number" min="0" name="oneTimeDonationValue" id="oneTimeDonationValue" size="15" value="0" />
                    </div>

                    <!--Recurring Gift-->
                    <div id="makingARecurringGift">
                       Enter Recurring Gift Amount: $<input type="number" min="0" name="recurringDonationValue" id="recurringDonationValue" class="watchForChange" size="15" value="0" /><br />
                       I would like to make this gift <select name="numberOfPayments" id="numberOfPayments">
                                            <option value="0">X</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
                                            <option value="32">32</option>
                                            <option value="33">33</option>
                                            <option value="34">34</option>
                                            <option value="35">35</option>
                                            <option value="36">36</option>
                                            <option value="37">37</option>
                                            <option value="38">38</option>
                                            <option value="39">39</option>
                                            <option value="40">40</option>
                                            <option value="41">41</option>
                                            <option value="42">42</option>
                                            <option value="43">43</option>
                                            <option value="44">44</option>
                                            <option value="45">45</option>
                                            <option value="46">46</option>
                                            <option value="47">47</option>
                                            <option value="48">48</option>
                                            <option value="49">49</option>
                                            <option value="50">50</option>
                                            <option value="51">51</option>
                                            <option value="52">52</option>
                                            <option value="53">53</option>
                                            <option value="54">54</option>
                                            <option value="55">55</option>
                                            <option value="56">56</option>
                                            <option value="57">57</option>
                                            <option value="58">58</option>
                                            <option value="59">59</option>
                                            <option value="60">60</option>
                                </select> times.<br />
                            I would like to make my gift: <select name="paymentFrequency" id="paymentFrequency">
                                            <option value="Monthly">Monthly</option>
                                            <option value="Quarterly">Quarterly</option>
                                            <option value="Annually">Annually.</option>
                                </select><br />
                            
                        Total Gift Amount of $<span id="totalRecurringDonationValue">0</span><span id="lengthOfTime"></span>.
                    </div>
    				<!--End Form Section 1-->
    				<div id="first" class="clearfix"></div>
                    <input class="submit floatLeft" type="submit" name="return_question" id="return_question" value="Previous" />
    				<input class="submit floatRight" type="submit" id="submit_first" name="submit_first" value="Next" />
                </fieldset>
                    <br />
    			</div>
    			<!--End First Step-->


    			<!--Second Step-->
    			<div class="formStep" id="step2">
                    <p>
                        <strong>$<span id="showTotalDonationAmount">DONATION_AMOUNT</span> &mdash; Your <span id="typeOfGift">GIFT_TYPE</span> gift amount from the previous page.
                            <!--If more than one fund is chosen, display the following-->
                            Enter amounts for each fund below. If you would like to change the total amount, please press the previous button.
                        </strong>
                    </p>
	    				<fieldset>
    						<legend>
    							I would like to allocate my gift
    						</legend>
    							<input type="checkbox" name="ScholashipSelection" value="to_Scholarships" class="ScholashipSelection" />
    							<label><strong>to a Scholarship</strong></label>
    								<!--Dropdown if selected-->
    								<div id="ifScholarshipsSelected">
    									<label><em>Please select the Scholarship(s) below</em></label> <br />
                                        <!--ADD ARARY FOR EACH SECTION HERE-->
                                            <p class="indented"><input type = "checkbox" name="list-items[]" value="Good_Men_Good_Citizens" />Good Men, Good Citizens Scholarship</p>
                                            <p class="indented"><input type = "checkbox" name="list-items[]" value="Class_Of_2012" />Class of 2012 Scholarship IHO Mr. Jason M. Ferguson &rsquo;96</p>
                                            <p class="indented"><input type = "checkbox" name="list-items[]" value="Class_Of_2011" />Class of 2011 Scholarship IHO Ms. Anita Garland</p>
                                            <p class="indented"><input type = "checkbox" name="list-items[]" value="Class_Of_2010" />Class of 2010 Scholarship IHO Mrs. Dottie Fahrner</p>
                                            <p class="indented"><input type = "checkbox" name="list-items[]" value="Class_Of_2009" />Class of 2009 Scholarship</p>
                                            <p class="indented"><input type = "checkbox" name="list-items[]" value="Class_Of_2008" />Class of 2008 Scholarship IHO Ms. Gerry Pettus</p>
                                            <p class="indented"><input type = "checkbox" name="list-items[]" value="Class_Of_2007" />Class of 2007 Scholarship IHO Lt. Gen. Sam Wilson</p>
                                            <p class="indented"><input type = "checkbox" name="list-items[]" value="Class_Of_2006" />Class of 2006 Scholarship IMO Peter C. Bance Jr.</p>
                                            <p class="indented"><input type = "checkbox" name="list-items[]" value="Class_Of_2005" />Class of 2005 Scholarship IMO Prof. Lee Cohen</p>
                                            <p class="indented"><input type = "checkbox" name="list-items[]" value="Class_Of_2004" />Class of 2004 Scholarship IMO C. Frazier &rsquo;04 &amp; IHO W. Simms</p>
        									<p class="indented"><input type = "checkbox" name="list-items[]" value="Class_Of_2003" />Class of 2003 Scholarship IHO Ralph A. Crawley</p>
        									<p class="indented"><input type = "checkbox" name="list-items[]" value="Class_Of_1980" />Class of 1980 Endowed Scholarship</p>
        									<p class="indented"><input type = "checkbox" name="list-items[]" value="Class_Of_1961" />Class of 1961 Good Men Good Citizens Scholarship</p>
                                            <p class="indented"><input type = "checkbox" name="list-items[]" value="Class_Of_1960" />Class of 1960 Good Men Good Citizens Scholarship</p>
                                            <p class="indented"><input type = "checkbox" name="list-items[]" value="Class_Of_1958" />Class of 1958 Summer College Endowment Fund</p>
                                            <p class="indented"><input type = "checkbox" name="list-items[]" value="Class_Of_1954" />Class of 1954 Wilson Center Lecture Series</p>
                                            <p class="indented"><input type = "checkbox" name="list-items[]" value="Class_Of_1953" />Class of 1953 Scholarship Endowment</p>
        									<p class="indented"><input type = "checkbox" name="list-items[]" value="Class_Of_1951" />Class of 1951 Memorial Scholarship</p>
                                            <p class="indented"><input type = "checkbox" name="list-items[]" value="OtherScholarship" />Other <em>(please specify in special instructions)</em></p>
        							</div>
        							<!--End Dropdown-->
        							<br />

   								<input type="checkbox" name="toAcademics" value="to_Academics" class="AcademicSelection" />
   								<label><strong>to Academics</strong></label><br />
                                <!--Dropdown if selected-->
                                    <div id="ifAcademicsSelected">
                                        <label><em>Please select the department(s) below</em></label> <br />
                                            <p class="indented"><input type = "checkbox" name="list-items[]" value="Atkinson_Museum" />Atkinson Museum</p>
                                            <p class="indented"><input type = "checkbox" name="list-items[]" value="Bortz_Library" />Bortz Library</p>
                                            <p class="indented"><input type = "checkbox" name="list-items[]" value="Culture_and_Community" />Culture and Community</p>
                                            <p class="indented"><input type = "checkbox" name="list-items[]" value="Wilson_Center" />the Wilson Center</p>
                                            <p class="indented"><input type = "checkbox" name="list-items[]" value="Other_Academic_Area" />Other <em>(please specify in special instructions)</em></p>
                                    </div>
                                    <!--End Dropdown-->

   								<input type="checkbox" name="toAthletics" value="to_athletics" class="enableAthletics" />
   								<label><strong>to Athletics</strong></label>
   								<!--Dropdown if selected-->
    								<div id="ifAthleticsAreSelected">
    									<label><em>Please select the XXXXXXXXXXX below</em></label> <br />
                                            <p class="indented"><input type="checkbox" name="list-items[]" value="Baseball_Big_Hitters_Club"  />Baseball Big Hitters Club</p>
                                            <p class="indented"><input type="checkbox" name="list-items[]" value="Basketball_Roundball_Club" />Basketball Roundball Club</p>
                                            <p class="indented"><input type="checkbox" name="list-items[]" value="Cross_Country_Harriers" />Cross Country Harriers</p>
        									<p class="indented"><input type="checkbox" name="list-items[]" value="Everett_Stadium" />Everett Stadium</p>
                                            <p class="indented"><input type="checkbox" name="list-items[]" value="Football_Gridiron_Club" />Football Gridiron Club</p>
                                            <p class="indented"><input type="checkbox" name="list-items[]" value="Golf_Hole_In_One_Club" />Golf Hole In One Club</p>
        									<p class="indented"><input type="checkbox" name="list-items[]" value="Kirk_Athletic_Center" />Kirk Athletic Center</p>
        									<p class="indented"><input type="checkbox" name="list-items[]" value="Lacrosse_Face_Off_Club" />Lacrosse Face Off Club</p>
                                            <p class="indented"><input type="checkbox" name="list-items[]" value="Rugby_Club" />Rugby Club</p>                                                                    
        									<p class="indented"><input type="checkbox" name="list-items[]" value="Soccer_Goal_Club" />Soccer Goal Club</p>
                                            <p class="indented"><input type="checkbox" name="list-items[]" value="Swimming_Club" />Swimming Club</p>  
        									<p class="indented"><input type="checkbox" name="list-items[]" value="Tennis_Racquet_Club" />Tennis Racquet Club</p>	                              
        							</div>
        							<!--End Dropdown-->
        							<br />
                                    <input type="checkbox" name="list-items[]" value="unrestricted" />
                                    <label><strong>Unrestricted</strong> &mdash; Funds the annual need of &ldquo;Forming good men and good citizens.&rdquo;.</label><br />
        							<br />
        							<label><strong>Special Instructions</strong></label><br />
        							<textarea name="specinstr" cols="100" rows="5"></textarea> 
        							<br />
        	
    					</fieldset>
    				<!--End Form Section 2-->
    					<div class="clearfix"></div>
                        <br />
                <input class="submit floatLeft" type="submit" name="return_first" id="return_first" value="Previous" />
    			<input class="submit floatRight" type="submit" name="submit_second" id="submit_second" value="Next" onclick="replaceDonationAmount()" />
                <br />
    			</div>
    			<!--End Second Step-->
    			
    			<div class="formStep" id="step3">

                        <fieldset>
                            <legend>
                                Donor Information
                            </legend>
                            <label>First Name:</label>
                                <input type="text" name="usersFirstName" size="20" />
                                &nbsp;
                            <label>Last Name:</label>
                                <input type="text" name="usersLastName" size="30" />
                                <br />
                            <label>Street Address:</label>
                                <input type="text" name="usersStreetAddress" size="30" />
                                <br />
                            <label>Apt, Suite, Bldg. (Optional):</label>
                                <input type="text" name="usersSecondaryAddress" size="30" />
                                <br />
                            <label>City:</label>
                                <input type="text" name="usersCity" size="30" />
                                <br />
                            <label>Country:</label>
                                <input type="text" name="usersCountry" size="30" />
                                <br />
                            <label>Phone:</label>
                                <input type="text" name="usersPhoneNumber" size="30" />
                                <br />
                            <label>Email:</label>
                                <input type="email" name="usersEmail" size="45" />
                                <br />
                        </fieldset>
                        <div class="clearfix"></div>
                        <br />
                <input class="submit floatLeft" type="submit" name="return_second" id="return_second" value="Previous" />
                <input class="submit floatRight" type="submit" name="submit_third" id="submit_third" value="Next" />
                <br />
    			</div>
    			<div class="formStep" id="step4">
                        <fieldset>
                            <legend>
                                <strong>
                                    Payment Method&mdash;Credit Card Information
                                </strong>
                            </legend>
                            <br />
                            <label>Name as it appears on Credit Card:</label>
                                <input type="text" name="nameOnCard" size="20" />
                                <br />
                            <label>Credit Card Number:</label>
                                <input type="text" name="numberOnCard" size="30" />
                                <br />
                            <label>Credit Card Verification Code (CVV or CSV):</label>
                                <input type="text" name="securityCodeOnCard" size="30" />
                                <br />
                            <label>Expiration Date:</label>
                                <input type="text" name="expirationMonthOnCard" size="5" />&nbsp;/&nbsp;<input type="text" name="expirationYearOnCard" size="5" />
                                <br />
                        </fieldset>
                        <div class="clearfix"></div>
                <input class="submit floatLeft" type="submit" name="return_third" id="return_third" value="Previous" />
                <input class="submit floatRight" type="submit" name="submit_form" id="submit_form" value="Submit" />
                <br />
    			</div>
    	</form>
    <br />
<footer>
	<div class="floatLeft">
        <p>
	        &copy; 2012&ndash;2013 
            <br />
            <a href="http://www.hsc.edu/Computing-Center/Policies/Digital-Copyright-Infringements.html" title="Copyright" target="_blank"><em>Copyright</em></a> | <a href="http://www.hsc.edu/Emergencies.html" title="Emergencies" target="_blank"><em>Emergencies</em></a> | <a href="http://www.hsc.edu/Search/A-Z-Index.html" title="Site Index" target="_blank"><em>Site Index</em></a>
        </p>
    </div>
    <div class="floatRight">
        <p>
            Hampden-Sydney, VA 23943
            <br />
            <a href="tel:+4342236000" title="434-223-6000">(434) 223&ndash;6000</a> | <a href="#" title="Contact the College" target="_blank">Contact the College</a>
        </p>
    </div>
</footer>
<!--End Main Area-->
</div>
  <!-- JavaScript at the bottom for fast page loading -->
  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.8.0.min.js"><\/script>')</script>
  <!--JQuery UI-->
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-ui-1.8.23.custom.min.js"><\/script>')</script>

  <!-- scripts concatenated and minified via build script -->
  <script src="js/plugins.js"></script>
  <!--Hide or Show Class Year Selection-->
  <!--Rotation of the different "Steps"-->
  <script src="js/script.js"></script>

  <!-- end scripts -->

  <!-- Asynchronous Google Analytics snippet. Change UA-XXXXX-X to be your site's ID.
       mathiasbynens.be/notes/async-analytics-snippet -->
<script>
    var _gaq=[['_setAccount','UA-23315215-1'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
 </script>
</body>
</html>