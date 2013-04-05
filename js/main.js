/* ==========================================================================
   H-SC Online Gift Form v1.5
   ========================================================================== */
$("document").ready(function () {
    "use strict";
/* ==========================================================================
    Global
    ========================================================================== */
    var currentStep, stepsMovedForward, stepsMovedBackward;
/* ==========================================================================
    Step Visibility Controls
    ========================================================================== */
    function hideSteps() {
        for (var i = 2; i < 7; i++) {
            $("#step" + i).hide();
        }
        $("#showResults").hide();
        $("#makingAOneTimeGift").hide();
        $("#makingARecurringGift").hide();
    }
    function showNextStep(currentStep) {
        var chosenDonationType, checkedAllocations, selectedAllocationValue, stepsMoved = 1;
        $("#step" + currentStep).slideToggle("slow");

        if (currentStep === 1) {
            //figure out what kind of donation they are making
            chosenDonationType = $("[name=donationType]").val();
            //show the apppropriate slide
            switch (chosenDonationType) {
            case "oneTimeGift":
                currentStep += 1;
                $("#makingAOneTimeGift").show();
                $("#step" + currentStep).slideToggle("slow");
                break;
            case "recurringDonation":
                currentStep += 1;
                $("#makingARecurringGift").show();
                $("#step" + currentStep).slideToggle("slow");
                break;
                //if somehow they changed it to something else, ignore them and return false.
            default:
                stepsMoved = 0;
                return false;
                //break; not needed due to return
            }//end switch
        } else if (currentStep === 3) {
            checkedAllocations = $("#step3 :checkbox:checked");
            if (checkedAllocations.length === 1) {
                selectedAllocationValue = checkedAllocations.val();//do whatever you want with that
                $("[name=" + selectedAllocationValue + "-Allocation]").val(100);
                currentStep += 2;
                stepsMoved = 2;
            } else {
                currentStep += 1;
            }
            $("#step" + currentStep).slideToggle("slow");
        } else {
            currentStep += 1;
            $("#step" + currentStep).slideToggle("slow");
        }
        return stepsMoved;
    }
    function showPreviousStep(currentStep) {
        var checkedAllocations, chosenDonationType, selectedAllocationValue, stepsMoved = 1;

        $("#step" + currentStep).slideToggle("slow");
        if (currentStep === 2) {
            chosenDonationType = $("[name=donationType]").val();
            switch (chosenDonationType) {
            case "oneTimeGift":
                $("#makingAOneTimeGift").slideToggle();
                $("#oneTimeDonationValue").val(0);
                $("#oneTimeDonationValidateError").text("");
                $("#makingAOneTimeGift").removeClass("error");
                break;
            case "recurringDonation":
                $("#makingARecurringGift").removeClass("error");
                $("#recurringDonationAmountValidateError").text("");
                $("#makingARecurringGift").slideToggle();
                $("#numberOfPayments").val(0);
                $("#recurringDonationValue").val(0);
                $("#totalRecurringDonationValue").val(0);
                $("#paymentFrequency").val("Monthly");

                break;
            default:
                $("#makingARecurringGift").hide();
                $("#makingAOneTimeGift").hide();
                break;
            }
        } else if (currentStep === 5) {
            checkedAllocations = $("#step3 :checkbox:checked");
            if (checkedAllocations.length === 1) {
                selectedAllocationValue = checkedAllocations.val();//do whatever you want with that
                $("[name=" + selectedAllocationValue + "-Allocation]").val(0);
                currentStep -= 1;
                stepsMoved = 2;
            }
        }

        currentStep -= 1;
        $("#step" + currentStep).slideToggle("slow");
        return stepsMoved;
    }
    function resetTheFormAndStartOver(currentStep) {
        if (currentStep > 1) {
            $("#step" + currentStep).slideToggle("slow"); //hide the first step
            $("#makingAOneTimeGift").hide();
            $("#makingARecurringGift").hide();
            currentStep = 1; //Reset their step to step 1
            $("#step1").slideToggle("slow"); //Show step 1
        }
    }
    function showResults(currentStep) {
        $("#showResults").slideToggle("slow");
    }
/* ==========================================================================
    Update values within the page
    ========================================================================== */
    function replaceDonationAmount() {
        //check which they used
        var donationAmount, OneTimeDonation, RecurringDonation, currencyOneTimeDonation, currencyRecurringDonation;
        donationAmount = 0;
        OneTimeDonation = $("[name=oneTimeDonationValue]").val();
        RecurringDonation = $("#totalRecurringDonationValue").val();

        if (OneTimeDonation != 0) {
            currencyOneTimeDonation = OneTimeDonation.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            donationAmount = currencyOneTimeDonation;
        } else {
            currencyRecurringDonation = RecurringDonation.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            donationAmount = currencyRecurringDonation;

        }
        $("#showTotalDonationAmount").text(donationAmount);
    }
    //Replace the Recurring donation amount so they know how much their total gift amount.
    function replaceRecurringDonationValue() {
        //Let's get the values and store them in our variables
        var perDonationValue, numberOfPayments, paymentFrequency, TotalRecurringDonationValue, howLong, howManyYears, howManyMonths, numberOfMonths;
        perDonationValue = $("#recurringDonationValue").val();
        numberOfPayments = $("#numberOfPayments").val();
        paymentFrequency = $("#paymentFrequency").val();

        //ensure that the maximum number of months is enforced.
        if (numberOfPayments > 60) {
            alert("Donations can last for a maximum of 60 times.");
            $("#numberOfPayments").val(60);
        } else if (numberOfPayments < 0) {
            alert("You cannot make a negative number of domnations.");
            $("#numberOfPayments").val(0);
        }

        TotalRecurringDonationValue = perDonationValue * numberOfPayments;
        howLong = " over ";

        //now say over what time period. Switch will be faster than an if else.
        switch (paymentFrequency) {
        case "Monthly":
            if (numberOfPayments === 0) {
                howLong = "";
            } else if (numberOfPayments === 1) {
                howLong += numberOfPayments + " month.";
            } else if (numberOfPayments <= 12) {
                howLong += numberOfPayments + " months.";
            } else {
                howManyYears = Math.floor(numberOfPayments / 12);
                howManyMonths = numberOfPayments % 12;

                howLong += howManyYears + " years, and " + howManyMonths + " months.";
            }
            $("#lengthOfTime").text(howLong);
            break;

        case "Quarterly":
            howLong = " will be made quarterly over ";
            if (numberOfPayments === 0) {
                howLong = "";
            } else if (numberOfPayments <= 4) {
                numberOfMonths = numberOfPayments * 3;
                howLong += numberOfMonths + " months.";
            } else {
                howManyYears = Math.floor((numberOfPayments * 3) / 12);
                howManyMonths = (numberOfPayments * 3) % 12;
                howLong += howManyYears + " years, and " + howManyMonths + " months.";
            }
            $("#lengthOfTime").text(howLong);
            break;

        case "Annually":
            howLong += numberOfPayments;
            if (numberOfPayments === 0) {
                howLong = "";
            } else if (numberOfPayments === 1) {
                howLong += " year.";
            } else {
                howLong += " years.";
            }
            $("#lengthOfTime").text(howLong);
            break;

        default:
            $("#lengthOfTime").text("");
        }
        $("#totalRecurringDonationValue").val(TotalRecurringDonationValue);
        replaceDonationAmount();

    }
/* ==========================================================================
    Step 3 dropdown's
    ========================================================================== */
    //Let's add the ability to show and hide fields via the checkboxes
    function addInteractivity() {
        var hiddenFields = [".showUnrestricted", ".ifScholarshipsSelected", ".ifClassScholarshipSelected", ".ifAcademicsSelected", ".ifAthleticsAreSelected"];
        for (var i = 0; i < (hiddenFields.length - 1); i++) {
            $(hiddenFields[i]).css("display", "none");
        }
        //to unrestricted fund
        $("#unrestrictedFund").click(function () {
            if ($("#unrestrictedFund:checked").val() === "unrestricted") {
                $(".showUnrestricted").slideToggle("fast"); //Slide Down Effect
            } else {
                $(".showUnrestricted").slideToggle("fast");  //Slide Up Effect
            }
        });
        //to a specific scholarship
        $(".ScholashipSelection").click(function () {
            if ($("input[name=ScholashipSelection]:checked").val() === "to_Scholarships") {
                $(".ifScholarshipsSelected").slideToggle("fast"); //Slide Down Effect
            } else {
                $(".ifScholarshipsSelected").slideToggle("fast");  //Slide Up Effect
            }
        });
        //to a class scholarship
        $(".showClassScholarshipAllocation").click(function () {
            if ($("input.showClassScholarshipAllocation:checked").val() === "Class_Scholarship") {
                $(".ifClassScholarshipSelected").slideToggle("fast"); //Slide Down Effect
            } else {
                $(".ifClassScholarshipSelected").slideToggle("fast");  //Slide Up Effect
                if ($("[name=classYearScholarshipSelection]").val() != "N/A") {
                    $("[name=classYearScholarshipSelection]").val("N/A");
                    $("[name=classYearScholarshipSelection]").trigger("change");
                }
            }
        });
    //to a academics
        $(".AcademicSelection").click(function () {
            if ($("input[name=toAcademics]:checked").val() === "to_Academics") {
                $(".ifAcademicsSelected").slideToggle("fast"); //Slide Down Effect
            } else {
                $(".ifAcademicsSelected").slideToggle("fast");  //Slide Up Effect
            }
        });
    //Would you like to donate to athletic funds?
        $(".enableAthletics").click(function () {
            if ($('input[name=toAthletics]:checked').val() === "to_athletics") {
                $(".ifAthleticsAreSelected").slideDown("fast"); //Slide Down Effect
            } else {
                $(".ifAthleticsAreSelected").slideUp("fast");  //Slide Up Effect
            }
        });
    }
/* ==========================================================================
    Step 4 Allocations
    ========================================================================== */
    function showResepectiveAllocation() {
        var lastSelected = "";
        //scholarship functions
        $("div.ifScholarshipsSelected input[type=\"checkbox\"]").click(function () {
            $("#" + $(this).val().replace(/_/g, "") + "Allocation").slideToggle("fast");
        });
        $("div.ifAcademicsSelected input[type=\"checkbox\"]").click(function () {
            $("#" + $(this).val().replace(/_/g, "") + "Allocation").slideToggle("fast");
        });
        $("div.ifAthleticsAreSelected input[type=\"checkbox\"]").click(function () {
            //Test if one isn't showing up
            //alert("#" + $(this).val().replace(/_/g, "") + "Allocation");
            $("#" + $(this).val().replace(/_/g, "") + "Allocation").slideToggle("fast");
        });
        $("[name=classYearScholarshipSelection]").change(function () {
            if ($(this).val() === "N/A") {
                $("#ClassOf" + lastSelected + "Allocation").slideToggle("fast");
                lastSelected = $(this).val();
            } else {
                $("#ClassOf" + $(this).val() + "Allocation").slideToggle("fast");
                if (lastSelected != "") {
                    $("#ClassOf" + lastSelected + "Allocation").slideToggle("fast");
                }
                lastSelected = $(this).val();
            }
        });
    }
/* ==========================================================================
    Validation
    ========================================================================== */
    function validateCurrentStep(currentStep) {
        var chosenDonationType, validateTotalAllocationAmount = 0, validateOneTimeDonationAmount, fields, checkAcademicsFields, checkAthleticsFields, checkScholarshipFields, validateRecurringDonationAmount, validateNumberOfPayments, validatePaymentFrequency, validateTotalRecurringDonationAmount;
        chosenDonationType = $("[name=donationType]").val();
        switch (currentStep) {
            //This checks to make sure that they selected a donation type.
        case 1:
            return true;

        //This verifies donation type and checks to make sure they entered a donation amount 
        case 2:
            switch (chosenDonationType) {
            case "oneTimeGift":
                validateOneTimeDonationAmount = $("[name=oneTimeDonationValue]").val();
                if (validateOneTimeDonationAmount < 5) {
                    $("#makingAOneTimeGift").addClass("error");
                    $("#oneTimeDonationValidateError").text("Sorry, we have a $5 donation minimum.");
                    return false;
                }

                if ($("#makingAOneTimeGift").hasClass("error")) {
                    $("#oneTimeDonationValidateError").text("");
                    $("#makingAOneTimeGift").removeClass("error");
                }
                return true;

            case "recurringDonation":
                validateRecurringDonationAmount = $("[name=recurringDonationValue]").val();
                validateNumberOfPayments = $("[name=numberOfPayments]").val();
                validatePaymentFrequency = $("[name=paymentFrequency]").val();
                validateTotalRecurringDonationAmount = validateRecurringDonationAmount * validateNumberOfPayments;
                //first check the total amount, it should be at least $5.00
                if (validateTotalRecurringDonationAmount < 5) {
                    $("#makingARecurringGift").addClass("error");
                    $("#recurringDonationAmountValidateError").text("Sorry, your total donation was less than $5. We have a $5 donation minimum.");
                    return false;
                }
                if (validateNumberOfPayments === 0) {
                    $("#makingARecurringGift").addClass("error");
                    $("#recurringDonationAmountValidateError").text("Sorry, you must choose how many months you would like to make this donation for.");
                    return false;
                }
                if ($("#makingARecurringGift").hasClass("error")) {
                    $("#recurringDonationAmountValidateError").text("");
                    $("#makingARecurringGift").removeClass("error");
                }
                return true;
            }//end chosenDonationType switch
            break;

            //This verifies that they chose a fund to donate to.
        case 3:

            fields = $("#step3 input:checkbox:checked");
            //check that they chose any fund at all
            if (fields.length === 0) {
                $("#step3").addClass("error");
                $("#checkboxError").text("Please choose a fund to donate to.");
                return false;
            }

            //Check Scholarships
            if ($("[name=ScholashipSelection]").is(":checked")) {
                checkScholarshipFields = $(".ifScholarshipsSelected input:checkbox:checked");
                if (checkScholarshipFields.length === 0) {
                    $("#step3").addClass("error");
                    $("#checkboxError").text("Please choose which scholarship you would like to donate to.");
                    return false;
                }
                if ($("#step3").hasClass("error")) {
                    $("#step3").removeClass("error");
                    $("#checkboxError").text("");
                }
            }

            //Check Acadmics
            if ($("[name=toAcademics]").is(":checked")) {
                checkAcademicsFields = $(".ifAcademicsSelected input:checkbox:checked");
                if (checkAcademicsFields.length === 0) {
                    $("#step3").addClass("error");
                    $("#checkboxError").text("Please choose which academic fund you would like to donate to.");
                    return false;
                }
                if ($("#step3").hasClass("error")) {
                    $("#step3").removeClass("error");
                    $("#checkboxError").text("");
                }
            }

            //check Athletics
            if ($("[name=toAthletics]").is(":checked")) {
                checkAthleticsFields = $(".ifAthleticsAreSelected input:checkbox:checked");
                if (checkAthleticsFields.length === 0) {
                    $("#step3").addClass("error");
                    $("#checkboxError").text("Please choose which athletic fund you would like to donate to.");
                    return false;
                }
                if ($("#step3").hasClass("error")) {
                    $("#step3").removeClass("error");
                    $("#checkboxError").text("");
                }
            }

            //if we didn't have to stop anywhere above this, let the step continue
            if ($("#step3").hasClass("error")) {
                $("#step3").removeClass("error");
                $("#oneTimeDonationCheckboxError").text("");
            }
            return true;


        case 4:
            $("#step4 :input[type=\"number\"]").each(function () {
                validateTotalAllocationAmount += parseInt($(this).val(), 10);
            });

            if (validateTotalAllocationAmount < 100) {
                alert("Sorry, your allocation amount adds up to under 100%. Please try again.");
                return false;
            }

            if (validateTotalAllocationAmount > 100) {
                alert("Sorry, your allocation amount adds up to over 100%. Please try again.");
                return false;
            }

            return true;

        case 5:
            //Check user information i.e. Name / State / Etc.
            return true;

        default:
            return false;
        } //end currentStep switch
    }
    function validateBeforeSubmitContent(e) {
        var error = "";
            //credit card number was valid, now let's check to ensure that have the other info
            if ($("[name=nameOnCard]").val() === "") {
                error += "Please enter the name as it appears on the credit card. ";
            }
            if ($("[name=numberOnCard]").val() === "") {
                error += "Please enter the credit card number. ";
            }
            if (!$("[name=numberOnCard]").hasClass("valid")) {
                error += "Please enter a valid credit card number. "; 
            }
            if ($("[name=securityCodeOnCard]").val() === "") {
                //we don't have a security code
                error += "Please enter the security code for your credit card. ";
            }
            if($("[name=expirationMonthOnCard]").val() === "") {
                //we don't have a month
                error += "Please enter the expiration month of your credit card. ";
            } else if ($("[name=expirationMonthOnCard]").val() > 12) {
                error += "Please enter a valid expiration month between 1 and 12. ";
            } else if ($("[name=expirationMonthOnCard]").val() < 1) {
                error += "Please enter a valid expiration month between 1 and 12. ";
            }
            if($("[name=expirationYearOnCard]").val() === "") {
                //we don't have a year
                error += "Please enter the expiration year on the card. ";
            }
            if (error != "") {
                alert(error);
                e.preventDefault();
                return false;
            } else {
                $("[name=resetFormAndStartOver]").hide();
                return true;
            }
    }
/* ==========================================================================
    End functions. Begin the actual calls for the document
    ========================================================================== */
    currentStep = 1;
    hideSteps();
    addInteractivity();
    showResepectiveAllocation();
    $("#recurringDonationValue, #numberOfPayments, #paymentFrequency").change(function () {
        replaceRecurringDonationValue();
    });

    $("#oneTimeGift").click(function () {
        $("[name=donationType]").val("oneTimeGift");
    });
    $("#recurringGift").click(function () {
        $("[name=donationType]").val("recurringDonation");
    });
    $("#replaceDonationAmountNow").click(function () {
        replaceDonationAmount();
        var chosenDonationType = $("[name=donationType]").val();
        switch (chosenDonationType) {
        case "oneTimeGift":
            $("#typeOfGift").text("one-time");
            break;
        case "recurringDonation":
            $("#typeOfGift").text("recurring");
            break;
        default:
            $("#typeOfGift").text("");
            break;
        }
    });

    //change steps
    $(".nextStep").click(function () {
        if (validateCurrentStep(currentStep)) {
            stepsMovedForward = showNextStep(currentStep);
            currentStep += stepsMovedForward;
        } else {
            return false;
        }
    });
    $(".previousStep").click(function () {
        stepsMovedBackward = showPreviousStep(currentStep);
        currentStep -= stepsMovedBackward;
    });

    $("[name=resetFormAndStartOver]").click(function (e) {
        if (confirm("Are you sure you would like to reset this form and start over?")) {
            resetTheFormAndStartOver(currentStep);
            currentStep = 1;
            return true;
        } else {
            e.preventDefault();
            return false;
        }
    });

    $("[name=submit_form]").click(function (e) {
        var options = {
            target: "#step6",
            clearForm: true
        };
        if (validateBeforeSubmitContent(e)) {
            $("#DonationForm").ajaxForm(options);
        } else {
            e.preventDefault();
            return false;
        }
    });
});
