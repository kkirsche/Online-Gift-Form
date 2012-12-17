<?php
//Start the session
if(session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
require("functions.php");
//Start the form key class
$formKey = new formKey();

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Online Gift &mdash; Gift Information</title>
        <meta name="description" content="Hampden-Sydney College's Online Gift Form">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="css/master.css">
        

        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <noscript>
            <style>
                .jsEnabled {
                    display: none;
                }
            </style>
        </noscript>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div class="header-container">
            <header class="wrapper clearfix">
                <h1 class="title">
                    <a href="http://www.hsc.edu">
                        <img src="http://www.hsc.edu/images/hpheadernew2.gif" alt="Hampden-Sydney College" id="headerImage">
                    </a>
                </h1>
            </header>
        </div>

        <!--Begin the Main Content-->
        <div class="main-container">
            <div class="main wrapper clearfix">
                <article>
                    <!--Inform the user that the form IS secure!-->
                    <p>Credit card information is handled using a secure web server and all information is encrypted before submission to the Office of Institutional Advancement. <a href="http://www.hsc.edu/Making-A-Gift/How-to-Give.html" target="_blank"><i class="icon-info-sign"></i></a></p>
                </article>

                <!--One Time or Recurring Step-->
                <div class="formStep">
                    <form id="DonationForm" action="processForm.php" method="post">
                        <div id="step1">
                        <?php $formKey->outputKey(); ?>
                        <!--Ask whether it's a one-time gift or a recurring gift-->
                        <div class="centerButtons">
                            <a href="#" class="nextStep" id="oneTimeGift"><img src="img/One-TimeGift.png" class="OTG" alt="I would like to make a one-time gift" /></a>
                            <a href="#" class="nextStep" id="recurringGift"><img src="img/RecurringGift.png" alt="I would like to make a recurring gift" /></a>
                        </div>
                        <div class="jsDisabled">
                            <select name="donationType">
                                <option value="oneTimeGift">One-Time Gift</option>
                                <option value="recurringDonation">Recurring Donation</option>
                            </select>
                        </div>

                        <div class="progress">
                            <div class="bar bar-success" style="width: 1%;"></div>
                        </div>
                        <p class="centerText">Step 1/6</p>
                    </div><!--end step 1-->

                
                    
                    <!--Step 2-->
                    <div id="step2">
                        <!--One Time Gift-->
                        <div id="makingAOneTimeGift" class="centerText control-group">
                            <label class="control-label">Enter Donation Amount Here:<sup class="requiredValue">*</sup></label>
                            <div class="controls">
                                <div class="input-prepend input-append">
                                    <span class="add-on">$</span>
                                    <input type="number" min="0" name="oneTimeDonationValue" id="oneTimeDonationValue" value="0" />
                                    <span class="add-on">.00</span>
                                </div>
                                <span id="oneTimeDonationValidateError" class="help-inline"></span>
                            </div>
                        </div>

                        <!--Recurring Gift-->
                        <div id="makingARecurringGift" class="control-group">
                            <label class="control-label">Enter Recurring Gift Amount<sup class="requiredValue">*</sup>:</label>
                                <div class="controls">
                                    <div class="input-prepend input-append">
                                        <span class="add-on">$</span>
                                        <input type="number" min="0" name="recurringDonationValue" id="recurringDonationValue" class="watchForChange" value="0" />
                                        <span class="add-on">.00</span>
                                    </div>
                                    
                                    I would like to make this gift 
                                        <select name="numberOfPayments" id="numberOfPayments">
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
                                        </select> times.<sup class="requiredValue">*</sup><br />

                                    I would like to make my gift<sup class="requiredValue">*</sup>:
                                    <select name="paymentFrequency" id="paymentFrequency">
                                        <option value="Monthly">Monthly</option>
                                        <option value="Quarterly">Quarterly</option>
                                        <option value="Annually">Annually.</option>
                                    </select>
                            <br />
                            <div class="centerText">
                                Total Gift Amount of
                                <div class="input-prepend input-append">
                                    <span class="add-on">$</span>
                                    <input type="number" placeholder="0" min="0" id="totalRecurringDonationValue" disabled="disabled"/>
                                    <span class="add-on">.00</span>
                                </div>
                                <span id="lengthOfTime"></span>

                                <span id="recurringDonationAmountValidateError" class="help-inline"></span>
                            </div>
                        </div><!--end Controls-->
                        </div><!--end Recurring Gift-->
                    
                        <button type="button" id="replaceDonationAmountNow" class="paginationBTN floatRight nextStep">Next &rarr;</button>
                        <button type="button" class="paginationBTN floatLeft previousStep clearfix">&larr; Previous</button>

                        <div class="progress">
                            <div class="bar bar-success" style="width: 16.6%;"></div>
                        </div>
                        <p class="centerText">Step 2/6</p>
                    </div><!--End Step 2-->


                    <!--Step 3-->
                    <div id="step3" class="control-group">
                        <p><strong><span class="jsEnabled">$<span id="showTotalDonationAmount">DONATION_AMOUNT</span> &mdash; Your <span id="typeOfGift">GIFT_TYPE</span> gift amount from the previous page.</span>
                            <!--If more than one fund is chosen, display the following-->
                            Enter amounts for each fund below. If you would like to change the total amount, please press the previous button.</strong>
                        </p>
                            <label class="centerText control-label">I would like to allocate my gift<sup class="requiredValue">*</sup>:</label>
                            <div class="controls">
                                <fieldset>
                                <label class="checkbox">
                                    <input type="checkbox" name="list-items[]" value="unrestricted" />
                                    <strong>to the Unrestricted Fund</strong> &mdash; Funds the annual need of &ldquo;Forming good men and good citizens.&rdquo;.
                                </label>

                                <label class="checkbox">
                                    <input type="checkbox" name="ScholashipSelection" value="to_Scholarships" class="ScholashipSelection" />
                                    <strong>to a Specific Scholarship</strong>
                                </label>
                                    <!--Dropdown if selected-->
                                    <div id="ifScholarshipsSelected" class="indented">
                                        <em>Please select the Scholarship(s) below</em>
                                        <!--ADD ARARY FOR EACH SECTION HERE-->
                                            <label class="checkbox">
                                                <input type = "checkbox" name="list-items[]" value="Good_Men_Good_Citizens" />
                                                Good Men, Good Citizens Scholarship
                                            </label>
                                            <label class="checkbox">
                                                <input type = "checkbox" name="list-items[]" value="Class_Of_2012" />
                                                Class of 2012 Scholarship IHO Mr. Jason M. Ferguson &rsquo;96
                                            </label>
                                            <label class="checkbox">
                                                <input type = "checkbox" name="list-items[]" value="Class_Of_2011" />
                                                Class of 2011 Scholarship IHO Ms. Anita Garland
                                            </label>
                                            <label class="checkbox">
                                                <input type = "checkbox" name="list-items[]" value="Class_Of_2010" />
                                                Class of 2010 Scholarship IHO Mrs. Dottie Fahrner
                                            </label>
                                            <label class="checkbox">
                                                <input type = "checkbox" name="list-items[]" value="Class_Of_2009" />
                                                Class of 2009 Scholarship
                                            </label>
                                            <label class="checkbox">
                                                <input type = "checkbox" name="list-items[]" value="Class_Of_2008" />
                                                Class of 2008 Scholarship IHO Ms. Gerry Pettus
                                            </label>
                                            <label class="checkbox">
                                                <input type = "checkbox" name="list-items[]" value="Class_Of_2007" />
                                                Class of 2007 Scholarship IHO Lt. Gen. Sam Wilson
                                            </label>
                                            <label class="checkbox">
                                                <input type = "checkbox" name="list-items[]" value="Class_Of_2006" />
                                                Class of 2006 Scholarship IMO Peter C. Bance Jr.
                                            </label>
                                            <label class="checkbox">
                                                <input type = "checkbox" name="list-items[]" value="Class_Of_2005" />
                                                Class of 2005 Scholarship IMO Prof. Lee Cohen
                                            </label>
                                            <label class="checkbox">
                                                <input type = "checkbox" name="list-items[]" value="Class_Of_2004" />
                                                Class of 2004 Scholarship IMO C. Frazier &rsquo;04 &amp; IHO W. Simms
                                            </label>
                                            <label class="checkbox">
                                                <input type = "checkbox" name="list-items[]" value="Class_Of_2003" />
                                                Class of 2003 Scholarship IHO Ralph A. Crawley
                                            </label>
                                            <label class="checkbox">
                                                <input type = "checkbox" name="list-items[]" value="Class_Of_1980" />
                                                Class of 1980 Endowed Scholarship
                                            </label>
                                            <label class="checkbox">
                                                <input type = "checkbox" name="list-items[]" value="Class_Of_1961" />
                                                Class of 1961 Good Men Good Citizens Scholarship
                                            </label>
                                            <label class="checkbox">
                                                <input type = "checkbox" name="list-items[]" value="Class_Of_1960" />
                                                Class of 1960 Good Men Good Citizens Scholarship
                                            </label>
                                            <label class="checkbox">
                                                <input type = "checkbox" name="list-items[]" value="Class_Of_1958" />
                                                Class of 1958 Summer College Endowment Fund
                                            </label>
                                            <label class="checkbox">
                                                <input type = "checkbox" name="list-items[]" value="Class_Of_1954" />
                                                Class of 1954 Wilson Center Lecture Series
                                            </label>
                                            <label class="checkbox">
                                                <input type = "checkbox" name="list-items[]" value="Class_Of_1953" />
                                                Class of 1953 Scholarship Endowment
                                            </label>
                                            <label class="checkbox">
                                                <input type = "checkbox" name="list-items[]" value="Class_Of_1951" />
                                                Class of 1951 Memorial Scholarship
                                            </label>
                                            <label class="checkbox">
                                                <input type = "checkbox" name="list-items[]" value="OtherScholarship" />
                                                Other <em>(please specify in special instructions)</em>
                                            </label>
                                    </div>
                                    <!--End Dropdown-->
     
                                    <label class="checkbox">
                                        <input type="checkbox" name="toAcademics" value="to_Academics" class="AcademicSelection" />
                                        <strong>to Academics</strong>
                                    </label>
                                    <!--Dropdown if selected-->
                                        <div id="ifAcademicsSelected" class="indented">
                                            <em>Please select the department(s) below</em>
                                                <label class="checkbox">
                                                    <input type = "checkbox" name="list-items[]" value="Atkinson_Museum" />
                                                    Atkinson Museum
                                                </label>
                                                <label class="checkbox">
                                                    <input type = "checkbox" name="list-items[]" value="Bortz_Library" />
                                                    Bortz Library
                                                </label>
                                                <label class="checkbox">
                                                    <input type = "checkbox" name="list-items[]" value="Culture_and_Community" />
                                                    Culture and Community
                                                </label>
                                                <label class="checkbox">
                                                    <input type = "checkbox" name="list-items[]" value="Wilson_Center" />
                                                    the Wilson Center
                                                </label>
                                                <label class="checkbox">
                                                    <input type = "checkbox" name="list-items[]" value="Other_Academic_Area" />
                                                    Other <em>(please specify in special instructions)</em>
                                                </label>
                                        </div>
                                        <!--End Dropdown-->

                                    <label class="checkbox">
                                        <input type="checkbox" name="toAthletics" value="to_athletics" class="enableAthletics" />
                                        <strong>to Athletics</strong>
                                    </label>
                                    <!--Dropdown if selected-->
                                        <div id="ifAthleticsAreSelected" class="indented">
                                           <em>Please select which athletic area(s) below</em>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="list-items[]" value="Baseball_Big_Hitters_Club"  />
                                                    Baseball Big Hitters Club
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="list-items[]" value="Basketball_Roundball_Club" />
                                                    Basketball Roundball Club
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="list-items[]" value="Cross_Country_Harriers" />
                                                    Cross Country Harriers
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="list-items[]" value="Everett_Stadium" />
                                                    Everett Stadium
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="list-items[]" value="Football_Gridiron_Club" />
                                                    Football Gridiron Club
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="list-items[]" value="Golf_Hole_In_One_Club" />
                                                    Golf Hole In One Club
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="list-items[]" value="Kirk_Athletic_Center" />
                                                    Kirk Athletic Center
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="list-items[]" value="Lacrosse_Face_Off_Club" />
                                                    Lacrosse Face Off Club
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="list-items[]" value="Rugby_Club" />
                                                    Rugby Club
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="list-items[]" value="Soccer_Goal_Club" />
                                                    Soccer Goal Club
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="list-items[]" value="Swimming_Club" />
                                                    Swimming Club
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="list-items[]" value="Tennis_Racquet_Club" />
                                                    Tennis Racquet Club
                                                </label>
                                        </div>
                                        <!--End Dropdown-->

                                        <label><strong>Special Instructions</strong></label>
                                        <textarea name="specinstr" placeholder="Enter Special Instructions Here"></textarea>

                                <span id="checkboxError" class="centerText"></span>
                            </fieldset>
                        </div><!--end controls-->
                    <!--End Form Section 2-->
                        <div class="clearfix"></div>
                        <br />
                        <button type="button" class="paginationBTN floatRight nextStep">Next &rarr;</button>
                        <button type="button" class="paginationBTN floatLeft previousStep clearfix">&larr; Previous</button>
                        
                        <div class="progress">
                            <div class="bar bar-success" style="width: 33.3%;"></div>
                        </div>
                        <p class="centerText">Step 3/6</p>
                </div>
                <!--End Step 3-->

                <!--Step 4 | Allocations-->
                <div id="step4">
                    How would you like to allocate your donation?

                        <div class="input-append" id="showUnrestricted">
                            <input type="number" min="0" max="100" placeholder="0" />
                            <span class="add-on">&#37; to the Unrestricted Fund</span>
                        </div>

                        <button type="button" class="paginationBTN floatRight nextStep">Next &rarr;</button>
                        <button type="button" class="paginationBTN floatLeft previousStep clearfix">&larr; Previous</button>
                        
                        <div class="progress">
                            <div class="bar bar-success" style="width: 50%;"></div>
                        </div>
                        <p class="centerText">Step 4/6</p>
                </div>

                <div id="step5">

                        <fieldset>
                            <legend>
                                Donor Information
                            </legend>
                            <label class="inline">
                                First Name<sup class="requiredValue">*</sup>:
                                <input type="text" name="usersFirstName" size="20" placeholder="John" required />
                            </label>
                            <label class="inline">
                                Last Name<sup class="requiredValue">*</sup>:
                                <input type="text" name="usersLastName" size="20" placeholder="Doe" required />
                            </label>
                            <label class="inline">
                                Class Year (if applicable):
                                <input type="number" name="usersClassYear" placeholder="2000" />
                            </label>
                            <label class="inline">
                                Street Address<sup class="requiredValue">*</sup>:
                                <input type="text" name="usersStreetAddress" size="30" placeholder="1 College Road" required />
                            </label>
                            <label class="inline">
                                Apt, Suite, Bldg. (Optional):&nbsp;
                                <input type="text" name="usersSecondaryAddress" size="30" placeholder="Apt. 1" />
                            </label>    
                            <label class="inline">
                                City<sup class="requiredValue">*</sup>:&nbsp;
                                <input type="text" name="usersCity" size="30" placeholder="Hampden-Sydney" required />
                            </label>
                            <label class="inline">
                                State<sup class="requiredValue">*</sup>:&nbsp;
                                <input type="text" name="usersState" size="30" placeholder="VA" />
                            </label>
                            <label class="inline">
                                Zip Code<sup class="requiredValue">*</sup>:&nbsp;
                                <input type="number" name="usersZip" min="00000" max="999999999" placeholder="23943" />
                            </label>
                            <label class="inline">
                                Country:
                                <input type="text" name="usersCountry" size="30" placeholder="United States" />
                            </label>
                            <label class="inline">
                                Phone<sup class="requiredValue">*</sup>:
                                <input type="text" name="usersPhoneNumber" size="30" placeholder="(434) 123&ndash;4567" required />
                            </label>
                            <label class="inline">
                                Email<sup class="requiredValue">*</sup>:
                                <input type="email" name="usersEmail" size="45" placeholder="John.Doe@hsc.edu" required />
                            </label>
                        </fieldset>
                        <div class="clearfix"></div>
                        <br />
                        <button type="button" class="paginationBTN floatRight nextStep">Next &rarr;</button>
                        <button type="button" class="paginationBTN floatLeft previousStep clearfix">&larr; Previous</button>

                        <div class="progress">
                            <div class="bar bar-success" style="width: 60%;"></div>
                        </div>
                        <p class="centerText">Step 5/6</p>
                </div><!--end step 5-->

                <div id="step6">
                    
                        <fieldset>
                            <legend>
                                <strong>
                                    Payment Method&mdash;Credit Card Information
                                </strong>
                            </legend>
                            <!--Show the card types-->

                            <ul class="cards">
                                <li class="visa">Visa</li>
                                <li class="mastercard">MasterCard</li>
                                <li class="amex">American Express</li>
                            </ul>

                            <label>Name as it appears on Credit Card<sup class="requiredValue">*</sup>:</label>
                                <input type="text" name="nameOnCard" size="40" placeholder="John R. Doe" />
                                <br />
                            <label>Credit Card Number<sup class="requiredValue">*</sup>:</label>
                                <input type="number" name="numberOnCard" id="creditCardNumber" placeholder="4012888888881881" min="0" max="9999999999999999999" />
                                <br />
                            <label>Credit Card Verification Code <abbr title="CVC2 for MasterCard, CVV2 for Visa, CID for American Express"><i class="icon-question-sign"></i></abbr><sup class="requiredValue">*</sup>:</label>
                                <input type="number" name="securityCodeOnCard" placeholder="813" min="0" max="9999" />
                                <br />
                            <label>Expiration Date<sup class="requiredValue">*</sup>:</label>
                                <input type="number" name="expirationMonthOnCard" min="01" max="12" placeholder="11" />&nbsp;/&nbsp;<input type="number" name="expirationYearOnCard" min="0" max="99" placeholder="14" />
                                <br />
                        </fieldset>
                        <div class="clearfix"></div>
                        <input class="submit floatRight" type="submit" name="submit_form" id="submit_form" value="Submit" />
                        <button type="button" class="paginationBTN floatLeft previousStep clearfix">&larr; Previous</button>
                        <div class="progress">
                            <div class="bar bar-success" style="width: 80%;"></div>
                        </div>
                        <p class="centerText">Step 5/6</p>

                </div>
                <div id="showResults">
                    <!--when form processed using AJAX, output the response here-->
                </div>
        </form>

        <hr />
        <footer class="wrapper">
                <div class="leftText footerText floatLeft">
                    <p>
                        <strong>Other Giving Methods:</strong><br />
                    If you would like to call us with your credit card information, you can contact us toll-free at <a href="tel:18008651776" title="Call us to donate">1&ndash;800&ndash;865&ndash;1776</a>. We are available Monday&ndash;Friday, 8:30 AM to 5:00 PM <abbr title="Eastern Standard Time">EST</abbr>.<br />
                        <hr />
                        &copy; Hampden-Sydney College | 2012&ndash;2013<br />
                        <a href="http://www.hsc.edu/Computing-Center/Policies/Digital-Copyright-Infringements.html" title="Copyright" target="_blank"><em>Copyright</em></a> | <a href="http://www.hsc.edu/Emergencies.html" title="Emergencies" target="_blank"><em>Emergencies</em></a> | <a href="http://www.hsc.edu/Search/A-Z-Index.html" title="Site Index" target="_blank"><em>Site Index</em></a>
                    </p>
                </div>
                <div class="rightText footerText floatRight">
                        <strong>Address for Mailing Gifts:</strong><br />
                        <address>
                            Office of Institutional Advancement<br />
                            Box 637 Graham Hall<br />
                            Hampden-Sydney, <abbr title="Virginia">VA</abbr> 23943&ndash;0857
                            <br />
                            <a href="tel:+4342236000" title="434-223-6000">(434) 223&ndash;6000</a> | <a href="#" title="Contact the College" target="_blank">Contact the College</a>
                        </address>
                </div>
                <div class="clear"></div>
            </footer>
            </div> <!-- #main -->
        </div>
    </div> <!-- #main-container -->



        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.3.min.js"><\/script>')</script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
        <script src="js/jquery.form.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
        <script>
            $(function() {
                $(function() {
                    $('.vertical.maestro').hide().css({
                    opacity: 0
                });
                return $('#creditCardNumber').validateCreditCard(function(result) {
                if (!(result.card_type != null)) {
                    $('.cards li').removeClass('off');
                    $('#creditCardNumber').removeClass('valid');
                    return;
                }
                $('.cards li').addClass('off');
                $('.cards .' + result.card_type.name).removeClass('off');

                if (result.length_valid && result.luhn_valid) {
                    return $('#card_number').addClass('valid');
                } else {
                    return $('#card_number').removeClass('valid');
                }
            });
        });
    }).call(this);
</script>
    </body>
</html>
