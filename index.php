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
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Hampden-Sydney College | Online Donation Form</title>
        <meta name="description" content="Hampden-Sydney College's Online Donation Form" />
        <meta name="viewport" content="width=device-width" />

        <link rel="icon" type="image/ico" href="favicon.ico" />
        <link rel="apple-touch-icon" href="apple-touch-icon.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-72x72-precomposed.png" /><!--iPad-->
        <link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-114x114-precomposed.png" /> <!--iPhone Retina Display-->
        <link rel="apple-touch-icon" sizes="144x144" href="apple-touch-icon-144x144-precomposed.png" />
        <link rel="apple-touch-startup-image" href="img/startup.png" />
        <link rel="apple-touch-startup-image" sizes="640x920" href="img/startup-640x920.png" />
        <!--<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">-->
        <link rel="stylesheet" href="css/master.css">
        

        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <noscript>
            <style>
                .jsEnabled {
                    display: none;
                }
                .hiddenByDefault {
                    display: inherit;
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
                        <img src="img/header.jpg" height="105" width="500" alt="Hampden-Sydney College" id="headerImage" />
                    </a>
                </h1>
            </header>
        </div>

        <!--Begin the Main Content-->
        <div class="main-container">
            <div class="main wrapper clearfix">
                <article>
                    <!--Inform the user that the form IS secure!-->
                    <p>Credit card information is handled using a secure web server. <a href="http://www.hsc.edu/Making-A-Gift/How-to-Give.html" target="_blank"><i class="icon-info-sign" id="moreInfo" title="Other Ways to Give"></i></a></p>
                </article>
                <div class="row">
                <!--One Time or Recurring Step-->
                <div class="formStep span11">
                    <form id="DonationForm" action="processForm.php" method="post">
                        <div id="step1">
                            <?php $formKey->outputKey(); ?>
                            <!--Ask whether it's a one-time gift or a recurring gift-->
                            <div class="centerButtons">
                                <a href="#" class="nextStep" id="oneTimeGift"><img src="img/One-TimeGift.png" width="250" height="250" onMouseOver="this.src='img/One-TimeGift_hover.png';" onmouseout="this.src='img/One-TimeGift.png';"  class="OTG" alt="I would like to make a one-time gift" /></a>
                                <a href="#" class="nextStep" id="recurringGift"><img src="img/RecurringGift.png" width="250" height="250" onMouseOver="this.src='img/RecurringGift_hover.png';" onmouseout="this.src='img/RecurringGift.png';" alt="I would like to make a recurring gift" /></a>
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
                            <p>
                                <strong>
                                    Thank you for your one time gift of <span class="jsEnabled">$<span id="showTotalDonationAmount">DONATION_AMOUNT</span>. If this amount is incorrect, please press the previous button.</span>
                                </strong>
                            </p>
                            <label class="centerText control-label">I would like to allocate my gift<sup class="requiredValue">*</sup>:</label>
                            <div class="controls">
                                <fieldset>
                                    <label class="checkbox">
                                        <input type="checkbox" id="unrestrictedFund" name="list-items[]" value="unrestricted" />
                                        <strong>to the Unrestricted Fund</strong> &mdash; Funds the annual need of &ldquo;Forming good men and good citizens.&rdquo;.
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="ScholashipSelection" value="to_Scholarships" class="ScholashipSelection" />
                                        <strong>to a Specific Scholarship</strong>
                                    </label>
                                    <!--Scholarship Dropdown if selected-->
                                    <div class="ifScholarshipsSelected indented">
                                        <em>Please select the Scholarship(s) below</em>
                                        <!--ADD ARARY FOR EACH SECTION HERE-->
                                        <label class="checkbox">
                                            <input type="checkbox" id="showGoodMenGoodCitizensAllocation" name="list-items[]" value="Good_Men_Good_Citizens" />
                                            Good Men, Good Citizens Scholarship
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showClassof2012Allocation" name="list-items[]" value="Class_Of_2012" />
                                            Class of 2012 Scholarship <abbr title="In Honor Of">IHO</abbr> Mr. Jason M. Ferguson &rsquo;96
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showClassof2011Allocation" name="list-items[]" value="Class_Of_2011" />
                                            Class of 2011 Scholarship <abbr title="In Honor Of">IHO</abbr> Ms. Anita Garland
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showClassof2010Allocation" name="list-items[]" value="Class_Of_2010" />
                                            Class of 2010 Scholarship <abbr title="In Honor Of">IHO</abbr> Mrs. Dottie Fahrner
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showClassof2009Allocation" name="list-items[]" value="Class_Of_2009" />
                                            Class of 2009 Scholarship
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showClassof2008Allocation" name="list-items[]" value="Class_Of_2008" />
                                            Class of 2008 Scholarship <abbr title="In Honor Of">IHO</abbr> Ms. Gerry Pettus
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showClassof2007Allocation" name="list-items[]" value="Class_Of_2007" />
                                            Class of 2007 Scholarship <abbr title="In Honor Of">IHO</abbr> Lt. Gen. Sam Wilson
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showClassof2006Allocation" name="list-items[]" value="Class_Of_2006" />
                                            Class of 2006 Scholarship <abbr title="In Memory Of">IMO</abbr> Peter C. Bance Jr.
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showClassof2005Allocation" name="list-items[]" value="Class_Of_2005" />
                                            Class of 2005 Scholarship <abbr title="In Memory Of">IMO</abbr> Prof. Lee Cohen
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showClassof2004Allocation" name="list-items[]" value="Class_Of_2004" />
                                            Class of 2004 Scholarship <abbr title="In Memory Of">IMO</abbr> C. Frazier &rsquo;04 &amp; <abbr title="In Honor Of">IHO</abbr> W. Simms
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showClassof2003Allocation" name="list-items[]" value="Class_Of_2003" />
                                            Class of 2003 Scholarship <abbr title="In Honor Of">IHO</abbr> Ralph A. Crawley
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showClassof1980Allocation" name="list-items[]" value="Class_Of_1980" />
                                            Class of 1980 Endowed Scholarship
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showClassof1961Allocation" name="list-items[]" value="Class_Of_1961" />
                                            Class of 1961 Good Men Good Citizens Scholarship
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showClassof1960Allocation" name="list-items[]" value="Class_Of_1960" />
                                            Class of 1960 Good Men Good Citizens Scholarship
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showClassof1958Allocation" name="list-items[]" value="Class_Of_1958" />
                                            Class of 1958 Summer College Endowment Fund
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showClassof1954Allocation" name="list-items[]" value="Class_Of_1954" />
                                            Class of 1954 Wilson Center Lecture Series
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showClassof1953Allocation" name="list-items[]" value="Class_Of_1953" />
                                            Class of 1953 Scholarship Endowment
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showClassof1951Allocation" name="list-items[]" value="Class_Of_1951" />
                                            Class of 1951 Memorial Scholarship
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showOtherScholarshipAllocation" name="list-items[]" value="OtherScholarship" />
                                            Other <em>(please specify in special instructions)</em>
                                        </label>
                                    </div><!--End Scholarships Dropdown-->

                                    <label class="checkbox">
                                        <input type="checkbox" name="toAcademics" value="to_Academics" class="AcademicSelection" />
                                        <strong>to College Programs</strong>
                                    </label>
                                    <!--College Programs Dropdown if selected-->
                                    <div class="ifAcademicsSelected indented">
                                        <em>Please select the program(s) below</em>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showAtkinsonMuseumAllocation" name="list-items[]" value="Atkinson_Museum" />
                                            Atkinson Museum
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showBortzLibraryAllocation" name="list-items[]" value="Bortz_Library" />
                                            Bortz Library
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showCultureAndCommunityAllocation" name="list-items[]" value="Culture_and_Community" />
                                            Culture and Community
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showTheWilsonCenterAllocation" name="list-items[]" value="Wilson_Center" />
                                            the Wilson Center
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showOtherAcademicAllocation" name="list-items[]" value="Other_Academic_Area" />
                                            Other <em>(please specify in special instructions)</em>
                                        </label>
                                    </div><!--End College Program Dropdown-->  

                                    <label class="checkbox">
                                        <input type="checkbox" name="toAthletics" value="to_athletics" class="enableAthletics" />
                                        <strong>to Athletics</strong>
                                    </label>
                                    <!--Athletic Dropdown if selected-->
                                    <div class="ifAthleticsAreSelected indented">
                                       <em>Please select which athletic area(s) below</em>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showBaseballBigHittersClubAllocation" name="list-items[]" value="Baseball_Big_Hitters_Club"  />
                                            Baseball Big Hitters Club
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showBasketballRoundballClubAllocation" name="list-items[]" value="Basketball_Roundball_Club" />
                                            Basketball Roundball Club
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showCrossCountryHarriersAllocation" name="list-items[]" value="Cross_Country_Harriers" />
                                            Cross Country Harriers
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showEverettStadiumAllocation" name="list-items[]" value="Everett_Stadium" />
                                            Everett Stadium
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showFootballGridironClubAllocation" name="list-items[]" value="Football_Gridiron_Club" />
                                            Football Gridiron Club
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showGolfHoleInOneClubAllocation" name="list-items[]" value="Golf_Hole_In_One_Club" />
                                            Golf Hole In One Club
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showKirkAthleticCenterAllocation" name="list-items[]" value="Kirk_Athletic_Center" />
                                            Kirk Athletic Center
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showLacrosseFaceOffClubAllocation" name="list-items[]" value="Lacrosse_Face_Off_Club" />
                                            Lacrosse Face Off Club
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showRugbyClubAllocation" name="list-items[]" value="Rugby_Club" />
                                            Rugby Club
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showSoccerGoalClubAllocation" name="list-items[]" value="Soccer_Goal_Club" />
                                            Soccer Goal Club
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showSwimmingClubAllocation" name="list-items[]" value="Swimming_Club" />
                                            Swimming Club
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" id="showTennisRacquetClubAllocation" name="list-items[]" value="Tennis_Racquet_Club" />
                                            Tennis Racquet Club
                                        </label>
                                    </div><!--End Athletic Dropdown-->

                                    <label>
                                        <strong>Special Instructions</strong>
                                    </label>
                                    <textarea name="specinstr" id="specinstr" placeholder="Enter Special Instructions Here (255 character maximum)"></textarea>

                                    <span id="checkboxError" class="centerText"></span>
                                </fieldset>
                            </div><!--end controls from line 221-->

                            <div class="clearfix"></div>
                            <br />
                            <button type="button" class="paginationBTN floatRight nextStep">Next &rarr;</button>
                            <button type="button" class="paginationBTN floatLeft previousStep clearfix">&larr; Previous</button>
                            
                            <div class="progress">
                                <div class="bar bar-success" style="width: 33.3%;"></div>
                            </div>
                            <p class="centerText">Step 3/6</p>
                        </div><!--End Step 3-->

                        <!--Step 4 | Allocations-->
                        <div id="step4" class="textCenter">
                            How would you like to designate your gift?

                            <div class="showUnrestricted input-append">
                                <input type="number" name="unrestricted-Allocation" min="0" max="100" value="0" />
                                <span class="add-on">&#37; to the Unrestricted Fund</span>
                            </div>

                            <!--Scholarship Allocation Section-->
                            <div class="ifScholarshipsSelected">
                                <div id="GoodMenGoodCitizensAllocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Good_Men_Good_Citizens-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Good Men, Good Citizens Scholarship</span>
                                </div>
                                <div id="ClassOf2012Allocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Class_Of_2012-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Class of 2012 Scholarship <abbr title="In Honor Of">IHO</abbr> Mr. Jason M. Ferguson &rsquo;96</span>
                                </div>
                                <div id="ClassOf2011Allocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Class_Of_2011-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Class of 2011 Scholarship <abbr title="In Honor Of">IHO</abbr> Ms. Anita Garland</span>
                                </div>
                                <div id="ClassOf2010Allocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Class_Of_2010-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Class of 2010 Scholarship <abbr title="In Honor Of">IHO</abbr> Mrs. Dottie Fahrner</span>
                                </div>
                                <div id="ClassOf2009Allocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Class_Of_2009-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Class of 2009 Scholarship</span>
                                </div>
                                <div id="ClassOf2008Allocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Class_Of_2008-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Class of 2008 Scholarship <abbr title="In Honor Of">IHO</abbr> Ms. Gerry Pettus</span>
                                </div>
                                <div id="ClassOf2007Allocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Class_Of_2007-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Class of 2007 Scholarship <abbr title="In Honor Of">IHO</abbr> Lt. Gen. Sam Wilson</span>
                                </div>
                                <div id="ClassOf2006Allocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Class_Of_2006-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Class of 2006 Scholarship <abbr title="In Memory Of">IMO</abbr> Peter C. Bance Jr.</span>
                                </div>
                                <div id="ClassOf2005Allocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Class_Of_2005-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Class of 2005 Scholarship <abbr title="In Memory Of">IMO</abbr> Prof. Lee Cohen</span>
                                </div>
                                <div id="ClassOf2004Allocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Class_Of_2004-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Class of 2004 Scholarship <abbr title="In Memory Of">IMO</abbr> C. Frazier &rsquo;04 &amp; <abbr title="In Honor Of">IHO</abbr> W. Simms</span>
                                </div>
                                <div id="ClassOf2003Allocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Class_Of_2003-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Class of 2003 Scholarship <abbr title="In Honor Of">IHO</abbr> Ralph A. Crawley</span>
                                </div>
                                <div id="ClassOf1980Allocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Class_Of_1980-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Class of 1980 Endowed Scholarship</span>
                                </div>
                                <div id="ClassOf1961Allocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Class_Of_1961-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Class of 1961 Good Men Good Citizens Scholarship</span>
                                </div>
                                <div id="ClassOf1960Allocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Class_Of_1960-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Class of 1960 Good Men Good Citizens Scholarship</span>
                                </div>
                                <div id="ClassOf1958Allocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Class_Of_1958-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Class of 1958 Summer College Endowment Fund</span>
                                </div>
                                <div id="ClassOf1954Allocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Class_Of_1954-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Class of 1954 Wilson Center Lecture Series</span>
                                </div>
                                <div id="ClassOf1953Allocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Class_Of_1953-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Class of 1953 Scholarship Endowment</span>
                                </div>
                                <div id="ClassOf1951Allocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Class_Of_1951-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Class of 1951 Memorial Scholarship</span>
                                </div>
                                <div id="OtherScholarshipAllocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Other_Scholarship-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Other Scholarship &mdash; <em>as specified in your special instructions</em></span>
                                </div>
                            </div><!--End Scholarship Allocation Section-->

                            <!--Begin College Programs Allocation Section-->
                            <div class="ifAcademicsSelected">
                                <div id="AtkinsonMuseumAllocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Atkinson_Museum-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Atkinson Museum</span>
                                </div>
                                <div id="BortzLibraryAllocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Bortz_Library-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to Bortz Library</span>
                                </div>
                                <div id="CultureAndCommunityAllocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Culture_and_Community-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to Culture and Community</span>
                                </div>
                                <div id="WilsonCenterAllocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Wilson_Center-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Wilson Center</span>
                                </div>
                                <div id="OtherAcademicAreaAllocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Other_Academic-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Other Academic Area &mdash; <em>as specified in your special instructions</em></span>
                                </div>
                            </div><!--End College Programs Allocation Section-->

                            <!--Begin Athletic Allocation Section-->
                            <div class="ifAthleticsAreSelected">
                                <div id="BaseballBigHittersClubAllocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Baseball_Big_Hitters_Club-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Baseball Big Hitters Club</span>
                                </div>
                                <div id="BasketballRoundballClubAllocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Basketball_Roundball_Club-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Basketball Roundball Club</span>
                                </div>
                                <div id="BrossCountryHarriersAllocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Cross_Country_Harriers-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Cross Country Harriers</span>
                                </div>
                                <div id="EverettStadiumAllocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Everett_Stadium-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to Everett Stadium</span>
                                </div>
                                <div id="FootballGridironClubAllocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Football_Gridiron_Club-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Football Gridiron Club</span>
                                </div>
                                <div id="GolfHoleInOneClubAllocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Golf_Hole_In_One_Club-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Golf Hole In One Club</span>
                                </div>
                                <div id="KirkAthleticCenterAllocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Kirk_Athletic_Center-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to Kirk Athletic Center</span>
                                </div>
                                <div id="LacrosseFaceOffClubAllocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Lacrosse_Face_Off_Club-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Lacrosse Face Off Club</span>
                                </div>
                                <div id="RugbyClubAllocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Rugby_Club-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Rugby Club</span>
                                </div>
                                <div id="SoccerGoalClubAllocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Soccer_Goal_Club-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Soccer Goal Club</span>
                                </div>
                                <div id="SwimmingClubAllocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Swimming_Club-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Swimming Club</span>
                                </div>
                                <div id="TennisRacquetClubAllocation" class="input-append hiddenByDefault">
                                    <input type="number" name="Tennis_Racquet_Club-Allocation" min="0" max="100" value="0" />
                                    <span class="add-on">&#37; to the Tennis Racquet Club</span>
                                </div>
                            </div><!--End Athletic Allocation Section-->

                            <button type="button" class="paginationBTN floatRight nextStep">Next &rarr;</button>
                            <button type="button" class="paginationBTN floatLeft previousStep clearfix">&larr; Previous</button>
                                
                            <div class="progress">
                                <div class="bar bar-success" style="width: 50%;"></div>
                            </div>
                            <p class="centerText">Step 4/6</p>
                        </div><!--End Step 4-->

                        <!--Begin Step 5-->
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
                                    <input type="text" name="usersState" data-provide="typeahead" size="30" placeholder="Virginia" />
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

                        <!--Begin Step 6-->
                        <div id="step6">
                            <fieldset>
                                <legend>
                                    <strong>
                                        Payment Method&mdash;Credit Card Information
                                    </strong>
                                </legend>

                                <!--Show accepted credit card types-->
                                <ul class="cards">
                                    <li class="visa">Visa</li>
                                    <li class="mastercard">MasterCard</li>
                                    <li class="amex">American Express</li>
                                </ul>

                                <label>
                                    Name as it appears on Credit Card<sup class="requiredValue">*</sup>:
                                </label>
                                    <input type="text" name="nameOnCard" size="40" placeholder="John R. Doe" />
                                    <br />
                                <label>
                                    Credit Card Number<sup class="requiredValue">*</sup>:
                                </label>
                                    <input type="number" name="numberOnCard" id="creditCardNumber" placeholder="4012888888881881" min="0" max="9999999999999999999" />
                                    <br />
                                <label>
                                    Credit Card Verification Code 
                                    <abbr title="CVC2 for MasterCard, CVV2 for Visa, CID for American Express">
                                        <i class="icon-question-sign" id="whatIsThis" title="CVC2 for MasterCard, CVV2 for Visa, CID for American Express"></i>
                                    </abbr>
                                    <sup class="requiredValue">*</sup>:
                                </label>
                                    <input type="number" name="securityCodeOnCard" placeholder="813" min="0" max="9999" />
                                    <br />
                                <label>
                                    Expiration Date<sup class="requiredValue">*</sup>:
                                </label>
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
                        </div><!--End step 6-->

                        <!--Begin AJAX Results section-->
                        <div id="showResults">
                            <!--when form processed using AJAX, output the response here-->
                        </div><!--End AJAX results section-->
                    </form>

                    <!--Begin footer section-->
                    <hr />
                    <footer class="wrapper">
                        <div class="row">
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
                        </div><!--end row-->
                        <div class="clear"></div>
                    </footer>
                </div><!-- end form step-->
            </div> <!-- End main wrapper -->
        </div><!-- End main container-->


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.3.min.js"><\/script>')</script>
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
            //enable tooltips
            $("#moreInfo").tooltip();
            $("#whatIsThis").tooltip();
            //enable typeahead
            var usStates = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'].sort();
            $('[name=usersState]').typeahead({source: usStates, items: 50});
            //credit card function
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