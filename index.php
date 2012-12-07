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

    		<form id="DonationForm" action="processForm.php" method="post">
    			<!--First Step-->
    			<div class="formStep" id="step1">
    				<!--Begin Form Section 1-->
    					<fieldset>
    						<legend>Outright Gifts:</legend>
    							<label for="outright_gift_amount">Total Amount of Your Gift:</label>
    								$ <input type="number" name="Outright_Gift" id="outright_gift_amount"/>
    					</fieldset>

    					<h4>OR</h4>
    					
    					<fieldset>
    						<legend>Monthly Debit Program:</legend>
    							<p>Make your gift through equal monthly installments through June using your debit or credit card.</p>
    							<label for="total_monthly_debit_gift">Total Amount of Your Gift:</label>
    								$ <input type="number" name="TotalMonthlyDebitGift" id="total_monthly_debit_gift" />
    						<br /><br />
							<label for="first_installment_date">Date of Your First Installment:</label>
								<input type="date" name="DateofYourFirstInstallment" id="first_installment_date" /> <br />
								<span class="donationSubtext">Subsequent monthly charges will be on the 15th of each month.</span>
						<br /><br />
							<label for="number_of_installments">Number of Monthly Installments:</label>
								<input type="number" name="NumberofMonthlyInstallments" id="number_of_installments" /> <br />
								<span class="donationSubtext">Please include the month you make your first gift and count all subsequent months to June. (i.e. A pledge made in January equals 6 monthly installments).</span>
						<br /><br />
							<p>All installments hsould be completed by June 30<sup>th</sup> of the calendar year.</p>
						
						<h4>OR</h4>
						
						<a href="http://www.hsc.edu/Making-A-Gift/How-to-Give/Pledge-Form.html" title="Make a Pledge">Make a Pledge</a><br />
						Make a pledge and fulfill your commitment by June 30<sup>th</sup>.
    				<!--End Form Section 1-->
    				<div id="first" class="clearfix"></div>
    				<input class="submit floatRight" type="submit" id="submit_first" name="submit_first" value="Next" />
                </fieldset>
                    <br />
    			</div>
    			<!--End First Step-->


    			<!--Second Step-->
    			<div class="formStep" id="step2">
	    				<fieldset>
    						<legend>
    							Allocate Your Gift
    						</legend>
    							<input type="checkbox" name="Unrestricted" value="unrestricted" />
    							<label><strong>Unrestricted</strong> &mdash; Funds the annual need of &ldquo;Forming good men and good citizens.&rdquo;.</label><br />

    							<input type="checkbox" name="Class_Scholarships" value="class_scholarships" class="enableClassYearSelection" />
    							<label><strong>Class Scholarships</strong></label>
    								<!--Dropdown if selected-->
    								<div id="ifClassScholashipsSelected">
    									<label><em>Please select the appropriate class below</em></label> <br />
    									<select name="SelectedClassYear">
    										<option value="NoClass">Choose a Class</option>
        									<option value="Class_Of_2003">Class of 2003 Scholarship IHO Ralph A. Crawley</option>
        									<option value="Class_Of_2004">Class of 2004 Scholarship IMO C. Frazier 04 &amp; IHO W. Simms</option>
        									<option value="Class_Of_2005">Class of 2005 Scholarship IMO Prof. Lee Cohen</option>
        									<option value="Class_Of_2006">Class of 2006 Scholarship IMO Peter C. Bance Jr</option>
        									<option value="Class_Of_2007">Class of 2007 Scholarship IHO Lt. Gen. Sam Wilson</option>
        									<option value="Class_Of_2008">Class of 2008 Scholarship IHO Ms. Gerry Pettus</option>
        									<option value="Class_Of_2009">Class of 2009 Scholarship</option>
        									<option value="Class_Of_2010">Class of 2010 Scholarship IHO Mrs. Dottie Fahrner</option>
        									<option value="Class_Of_2011">Class of 2011 Scholarship IHO Ms. Anita Garland</option>
        									<option value="Class_Of_2012">Class of 2012 Scholarship IHO Mr. Jason M. Ferguson 96</option>
        									<option value="Class_Of_1951">Class of 1951 Memorial Scholarship</option>
        									<option value="Class_Of_1953">Class of 1953 Scholarship Endowment</option>
        									<option value="Class_Of_1954">Class of 1954 Wilson Center Lecture Series</option>   
       									    <option value="Class_Of_1958">Class of 1958 Summer College Endowment Fund</option>  
        									<option value="Class_Of_1960">Class of 1960 Good Men Good Citizens Scholarship</option>  
        									<option value="Class_Of_1961">Class of 1961 Good Men Good Citizens Scholarship</option>
        									<option value="Class_Of_1980">Class of 1980 Endowed Scholarship</option>
        								</select>
        							</div>
        							<!--End Dropdown-->
        							<br />

   								<input type="checkbox" name="CultureandCommunity" value="culture_and_community" />
   								<label><strong>Culture and Community</strong> &mdash; Supports the arts at Hampden-Sydney and service opportunities locally and around the world.</label><br />

   								<input type="checkbox" name="OtherFunds" value="other_funds" class="enableOtherFunds" />
   								<label><strong>Would you like to donate to other funds?</strong></label>
   								<!--Dropdown if selected-->
    								<div id="ifOtherFundsSelected">
    									<label><em>Please select the fund below</em></label> <br />
    									<div class="scrolllist">
        									<input type="checkbox" name="BortzLibrary" value="1" /> Bortz Library<br />
        									<input type="checkbox" name="EstherAtkinsonMuseum" value="1"  />Esther Atkinson Museum<br />
        									<input type="checkbox" name="EverettStadium" value="1" />Everett Stadium<br />
        									<input type="checkbox" name="GMGCScholarship" value="1" />Good Men Good Citizens Scholarship<br />
        									<input type="checkbox" name="KirkAthleticCenter" value="1" />Kirk Athletic Center<br />
        									<input type="checkbox" name="BaseballBigHittersClub" value="1"  />Baseball Big Hitters Club<br />
        									<input type="checkbox" name="BasketballRoundballClub" value="1" />Basketball Roundball Club<br /> 
        									<input type="checkbox" name="CrossCountryHarriers" value="1" />Cross Country Harriers<br />
        									<input type="checkbox" name="GolfHoleOneClub" value="1" />Golf Hole In One Club<br />
        									<input type="checkbox" name="FootballGridironClub" value="1" />Football Gridiron Club<br />
        									<input type="checkbox" name="LacrosseFaceOffClub" value="1" />Lacrosse Face Off Club<br />                                                                       
        									<input type="checkbox" name="SoccerGoalClub" value="1" />Soccer Goal Club<br />   
        									<input type="checkbox" name="TennisRacquetClub" value="1" />Tennis Racquet Club<br /> 
        									<input type="checkbox" name="SwimmingClub" value="1" />Swimming Club<br />
        									<input type="checkbox" name="RugbyClub" value="1" />Rugby Club<br />  
        									<input type="checkbox" name="UnrestrictedCapital" value="1" />Unrestricted Capital<br />   
        									<input type="checkbox" name="WilsonCenter" value="1" />Wilson Center<br />
        									<input type="checkbox" name="Other" value="1" />Other&mdash;<em>Explain in Special Instructions</em><br />                                
									</div>
        							</div>
        							<!--End Dropdown-->
        							<br />

        							<input type="checkbox" name="InMemoryOf" value="in_memory_of" class="enableInMemoryOf" />
   								<label><strong>Is Your Donation In Memory of Someone?</strong></label>
   								<!--Dropdown if selected-->
    								<div id="ifInMemoryOfSelected">
    									<label><em>Who is your gift in memory of?</em></label> <br />
    									<input type="text" name="nameOfInMemory" size="85" value="" />
        							</div>
        							<!--End Dropdown-->
        							<br />
        							
        							<input type="checkbox" name="InHonorOf" value="in_honor_of" class="enableInHonorOf" />
   								<label><strong>Is Your Donation In Honor of Someone?</strong></label>
   								<!--Dropdown if selected-->
    								<div id="ifInHonorOfSelected">
    									<label><em>Who is your gift in honor of?</em></label> <br />
    									<input type="text" name="nameOfInHonor" size="85" value="" />
        							</div>
        							<!--End Dropdown-->
        							<br /><br />
        							<label><strong>Special Instructions</strong></label><br />
        							<textarea name="specinstr" cols="100" rows="3" onKeyDown="limitText(this.form.specinstr,this.form.countdown,255);" onKeyUp="limitText(this.form.specinstr,this.form.countdown,255);">
        							</textarea> 
        							<br />
        							<span style="font-size: .5em;">You have <input readonly type="text" name="countdown" size="3" value="255" /> characters left.</span>
    					</fieldset>
    				<!--End Form Section 2-->
    					<div class="clearfix"></div>
                        <br />
                <input class="submit floatLeft" type="submit" name="return_first" id="return_first" value="Previous" />
    			<input class="submit floatRight" type="submit" name="submit_second" id="submit_second" value="Next" />
                <br />
    			</div>
    			<!--End Second Step-->
    			
    			<div class="formStep" id="step3">
    				<p>
                        <strong>$DONATION_AMOUNT &mdash; Your one time gift amount from the previous page.
                            <!--If more than one fund is chosen, display the following-->
                            Enter amounts for each fund below. If you would like to change the total amount, please press the previous button.
                        </strong>
                    </p>

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
                            <label>Employer Name (Optional):</label>
                                <input type="text" name="usersEmployer" size="30" />
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
                            <label>Home Phone:</label>
                                <input type="text" name="usersHomePhone" size="30" />
                                <br />
                            <label>Work Phone:</label>
                                <input type="text" name="usersWorkPhone" size="30" />
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
  <script src="js/jquery.creditCardValidator.js"></script>
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