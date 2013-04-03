<?php
//Start the session
if (version_compare(PHP_VERSION, "5.4.0") >= 0) {
    if(session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
} else {
    session_start();
}
//For compatibility before PHP 5.3.0
if (!defined('__DIR__')) {
    class __FILE_CLASS__ {
        function __toString() {
            $X = debug_backtrace();
            return dirname($X[1]['file']);
        }
    }
    define('__DIR__', new __FILE_CLASS__);
}

require(__DIR__ . "/functions.php");
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
        <title>Hampden-Sydney College | Online Gift Form</title>
        <meta name="description" content="Hampden-Sydney College's Online Gift Form">
        <meta name="viewport" content="width=device-width">

        <link rel="icon" type="image/ico" href="favicon.ico" />
        <link rel="apple-touch-icon" href="apple-touch-icon.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-72x72-precomposed.png" /><!--iPad-->
        <link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-114x114-precomposed.png" /> <!--iPhone Retina Display-->
        <link rel="apple-touch-icon" sizes="144x144" href="apple-touch-icon-144x144-precomposed.png" />
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="css/main.css">

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
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/?locale=en">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div class="navbar navbar-static-top">
            <div class="navbar-inner">
                <div class="container">
                        <!-- Be sure to leave the brand out there if you want it shown -->
                        <a class="brand" href="http://www.hsc.edu">
                            <img src="img/header.jpg" alt="Hampden-Sydney College" />
                        </a>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="offset1 span7" id="topMessage">
                    <!--Inform the user that the form IS secure!-->
                    <h1>Thank you for your gift to Hampden-Sydney College.</h1>
                    <p>Credit card information is handled using a secure web server. <a href="http://www.hsc.edu/Making-A-Gift/How-to-Give.html" target="_blank"><i class="icon-info-sign" id="moreInfo" title="Other Ways to Give"></i></a></p>
                </div><!--/div.offset1.span7#topMessage-->
            </div><!--/div.row-->
            <div class="row">
                <div class="span12">
                    <div class="row">
                        <div class="span1">&nbsp;</div>
                        <div class="span9 formContainer">
                            <form id="DonationForm" action="processForm.php" method="post">
                                <!--Begin Step 1-->
                                <div id="step1">
                                    <?php $formKey->outputKey(); ?>
                                    <!--Ask whether it's a one-time gift or a recurring gift-->
                                    <div class="centerButtons">
                                        <a href="#" class="nextStep" id="oneTimeGift"><img src="img/One-TimeGift.png" width="250" height="250" onMouseOver="this.src='img/One-TimeGift_hover.png';" onmouseout="this.src='img/One-TimeGift.png';"  class="OTG" alt="I would like to make a one-time gift" /></a>
                                        <a href="#" class="nextStep" id="recurringGift"><img src="img/RecurringGift.png" width="250" height="250" onMouseOver="this.src='img/RecurringGift_hover.png';" onmouseout="this.src='img/RecurringGift.png';" alt="I would like to make a recurring gift" /></a>
                                    </div>
                                    <div class="jsDisabled">
                                        <fieldset>
                                            <select name="donationType">
                                                <option value="oneTimeGift">One-Time Gift</option>
                                                <option value="recurringDonation">Recurring Gift</option>
                                            </select>
                                        </fieldset>
                                    </div>

                                    <div class="progress">
                                        <div class="bar bar-success" style="width: 1%;"></div>
                                    </div>
                                    <p class="text-center">Step 1/6</p>
                                </div><!--end step 1-->

                                <!--Step 2-->
                                <div id="step2">
                                    <!--One Time Gift-->
                                    <div id="makingAOneTimeGift" class="text-center control-group">
                                        <fieldset>
                                            <label class="control-label">Enter Gift Amount Here:<sup class="requiredValue">*</sup></label>
                                            <div class="controls">
                                                <div class="input-prepend input-append">
                                                    <span class="add-on">$</span>
                                                    <input type="number" min="0" name="oneTimeDonationValue" id="oneTimeDonationValue" value="0" />
                                                    <span class="add-on">.00</span>
                                                </div>
                                                <span id="oneTimeDonationValidateError" class="help-block"></span>
                                            </div><!--/div.controls-->
                                        </fieldset>
                                    </div><!--/div#makingAOneTimeGift.text-center-->

                                    <!--Recurring Gift-->
                                    <div id="makingARecurringGift" class="control-group text-center">
                                        <fieldset>
                                            <label class="control-label" for="recurringDonationValue">Enter Recurring Gift Amount<sup class="requiredValue">*</sup>:</label>
                                                <div class="controls">
                                                <div class="input-prepend input-append">
                                                    <span class="add-on">$</span>
                                                    <input type="number" min="0" name="recurringDonationValue" id="recurringDonationValue" class="watchForChange" value="0" />
                                                    <span class="add-on">.00</span>
                                                </div><!--/div.input-prepend.input-append-->
                                                
                                                <br />

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
                                                </select> 
                                                times.<sup class="requiredValue">*</sup>

                                                <br />

                                                I would like to make my gift<sup class="requiredValue">*</sup>:
                                                <select name="paymentFrequency" id="paymentFrequency">
                                                    <option value="Monthly">Monthly</option>
                                                    <option value="Quarterly">Quarterly</option>
                                                    <option value="Annually">Annually.</option>
                                                </select>
                                    
                                                <br />
                                                
                                                <div class="text-center">
                                                    Total Gift Amount of
                                                    <div class="input-prepend input-append">
                                                        <span class="add-on">$</span>
                                                        <input type="number" placeholder="0" min="0" id="totalRecurringDonationValue" disabled="disabled"/>
                                                        <span class="add-on">.00</span>
                                                    </div>
                                                    <span id="lengthOfTime"></span>
                                                    <span id="recurringDonationAmountValidateError" class="help-block"></span>
                                                </div><!--/div.text-center-->
                                            </div><!--/div.controls-->
                                        </div><!--/div#makingARecurringGift.control-group.text-center-->
                                        </fieldset>
                        
                                        <button type="button" id="replaceDonationAmountNow" class="paginationBTN pull-right nextStep">Next &rarr;</button>
                                        <button type="button" class="paginationBTN previousStep">&larr; Previous</button>

                                        <div class="progress">
                                            <div class="bar bar-success" style="width: 16.6%;"></div>
                                        </div>
                                        <p class="text-center">Step 2/6</p>
                                </div><!--/div#step2-->

                                <!--Step 3-->
                                <div id="step3" class="control-group">
                                    <p>
                                        <strong>
                                            Thank you for your gift of <span class="jsEnabled">$<span id="showTotalDonationAmount">GIFT_AMOUNT</span>. If this amount is incorrect, please press the previous button.</span>
                                        </strong>
                                    </p>
                                    
                                    <label class="text-center control-label largeText"><strong>I would like to designate my gift<sup class="requiredValue">*</sup>:</strong></label>
                        
                                    <div class="controls">
                                    <fieldset>
                                        <label class="checkbox">
                                            <input type="checkbox" id="unrestrictedFund" name="list-items[]" value="unrestricted" />
                                            <strong>to the Hampden-Sydney Fund</strong> &mdash; provides unrestricted budget support for the College&rsquo;s greatest needs.
                                        </label>

                                        <label class="checkbox">
                                            <input type="checkbox" name="ScholashipSelection" value="to_Scholarships" class="ScholashipSelection" />
                                            <strong>to a Specific Scholarship</strong>
                                        </label>
                                
                                        <!--Scholarship Dropdown if selected-->
                                        <div class="ifScholarshipsSelected indented">
                                            <em>Please select the Scholarship(s) below</em>
                                            <label class="checkbox">
                                                <input type="checkbox" id="showGoodMenGoodCitizensAllocation" name="list-items[]" value="Good_Men_Good_Citizens" />
                                                Good Men, Good Citizens Scholarship
                                            </label>

                                            <label class="checkbox">
                                                <input type="checkbox" class="showClassScholarshipAllocation" name="list-items[]" value="Class_Scholarship" />
                                                To a Class Scholarship
                                            </label>

                                            <div class="ifClassScholarshipSelected">
                                                <select class="span5 offset3" name="classYearScholarshipSelection">
                                                    <option value="N/A">Please select a class Scholarship</option>
                                                    <option value="2013">Class of 2013 Scholarship <abbr title="In Honor Of">IHO</abbr> Mr. Tommy Shomo &rsquo;69</option>
                                                    <option value="2012">Class of 2012 Scholarship <abbr title="In Honor Of">IHO</abbr> Mr. Jason M. Ferguson &rsquo;96</option>
                                                    <option value="2011">Class of 2011 Scholarship <abbr title="In Honor Of">IHO</abbr> Ms. Anita Garland</option>
                                                    <option value="2010">Class of 2010 Scholarship <abbr title="In Honor Of">IHO</abbr> Mrs. Dottie Fahrner</option>
                                                    <option value="2009">Class of 2009 Scholarship</option>
                                                    <option value="2008">Class of 2008 Scholarship <abbr title="In Honor Of">IHO</abbr> Ms. Gerry Pettus</option>
                                                    <option value="2007">Class of 2007 Scholarship <abbr title="In Honor Of">IHO</abbr> Lt. Gen. Sam Wilson</option>
                                                    <option value="2006">Class of 2006 Scholarship <abbr title="In Memory Of">IMO</abbr> Peter C. Bance Jr.</option>
                                                    <option value="2005">Class of 2005 Scholarship <abbr title="In Memory Of">IMO</abbr> Prof. Lee Cohen</option>
                                                    <option value="2004">Class of 2004 Scholarship <abbr title="In Memory Of">IMO</abbr> C. Frazier &rsquo;04 &amp; <abbr title="In Honor Of">IHO</abbr> W. Simms</option>
                                                    <option value="2003">Class of 2003 Scholarship <abbr title="In Honor Of">IHO</abbr> Ralph A. Crawley</option>
                                                    <option value="1980">Class of 1980 Endowed Scholarship</option>
                                                    <option value="1961">Class of 1961 Good Men Good Citizens Scholarship</option>
                                                    <option value="1960">Class of 1960 Good Men Good Citizens Scholarship</option>
                                                    <option value="1958">Class of 1958 Summer College Endowment Fund</option>
                                                    <option value="1954">Class of 1954 Wilson Center Lecture Series</option>
                                                    <option value="1953">Class of 1953 Scholarship Endowment</option>
                                                    <option value="1951">Class of 1951 Memorial Scholarship</option>
                                                </select>
                                                
                                                <input name="Class_Of_N/A-Allocation" type="hidden" value="0" />
                                            </div><!--/div.ifClassScholarshipSelected-->

                                            <label class="checkbox">
                                                <input type="checkbox" id="showOtherScholarshipAllocation" name="list-items[]" value="OtherScholarship" />
                                                Other <em>(please specify in special instructions)</em>
                                            </label>
                                        </div><!--/div.ifScholarshipsSelected-->

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
                                        </div><!--/div.ifAcademicsSelected.indented-->  

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
                                        </div><!--/div.ifAthleticsAreSelected.indented-->

                                        <label>
                                            <strong>Is your gift in memory of someone?</strong>
                                        </label>
                                        <textarea name="inMemoryOf" id="inMemoryOf" placeholder="Is your gift in memory of someone? Enter full name here."></textarea>

                                        <label>
                                            <strong>Is your gift in honor of someone?</strong>
                                        </label>
                                        <textarea name="inHonorOf" id="inHonorOf" placeholder="Is your gift in honor of someone? Enter full name here."></textarea>

                                        <label>
                                            <strong>Special Instructions</strong>
                                        </label>
                                        <textarea name="specinstr" id="specinstr" placeholder="Enter Special Instructions Here (255 character maximum)"></textarea>

                                        <span id="checkboxError" class="help-block"></span>
                                    </fieldset>
                                    </div><!--/div.controls-->

                                    <button type="button" class="paginationBTN pull-right nextStep">Next &rarr;</button>
                                    <button type="button" class="paginationBTN previousStep">&larr; Previous</button>
                        
                                    <div class="progress">
                                        <div class="bar bar-success" style="width: 33.3%;"></div>
                                    </div>
                                    <p class="text-center">Step 3/6</p>
                                </div><!--/div#step3-->

                            </form><!--/form#DonationForm-->
                        </div><!--/div.span8.formContainer-->
                    </div><!--/div.row-->
                </div><!--/div.span12-->
            </div><!--/div.row-->
        </div><!--/div.container-->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
