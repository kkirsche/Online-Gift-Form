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
                                        <label class="control-label">Enter Gift Amount Here:<sup class="requiredValue">*</sup></label>
                                        <div class="controls">
                                            <div class="input-prepend input-append">
                                                <span class="add-on">$</span>
                                                <input type="number" min="0" name="oneTimeDonationValue" id="oneTimeDonationValue" value="0" />
                                                <span class="add-on">.00</span>
                                            </div>
                                            <span id="oneTimeDonationValidateError" class="help-block"></span>
                                        </div><!--/div.controls-->
                                    </div><!--/div#makingAOneTimeGift.text-center-->

                                    <!--Recurring Gift-->
                                    <div id="makingARecurringGift" class="control-group text-center">
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
                        
                                        <button type="button" id="replaceDonationAmountNow" class="paginationBTN pull-right nextStep">Next &rarr;</button>
                                        <button type="button" class="paginationBTN previousStep">&larr; Previous</button>

                                        <div class="progress">
                                            <div class="bar bar-success" style="width: 16.6%;"></div>
                                        </div>
                                        <p class="text-center">Step 2/6</p>
                                </div><!--/div#step2-->

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
