$("document").ready(function () {
    "use strict";
    var currentStep;
    //Hide additional steps and the differences between the two steps if they have Javascript
    function hideSteps() {
        //hide the divs
        $("#step2").hide();
        $("#step3").hide();
        $("#step4").hide();
        $("#step5").hide();
        $("#step6").hide();
        $("#showResults").hide();
        $("#makingAOneTimeGift").hide();
        $("#makingARecurringGift").hide();
    }
    function showNextStep(currentStep) {
        $("#step" + currentStep).slideToggle("slow", function () {
            if (currentStep === 1) {
                //figure out what kind of donation they are making
                var chosenDonationType = $("[name=donationType]").val();
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
                    return false;
                    //break; not needed due to return
                }//end switch
            } else {
                currentStep += 1;
                $("#step" + currentStep).slideToggle("slow");
            }
        });
    }
    function showPreviousStep(currentStep) {
        if (currentStep === 2) {
            var chosenDonationType = $("[name=donationType]").val();
            switch (chosenDonationType) {
            case "oneTimeGift":
                $("#makingAOneTimeGift").slideToggle();
                break;
            case "recurringDonation":
                $("#makingARecurringGift").slideToggle();
                break;
            default:
                $("#makingARecurringGift").hide();
                $("#makingAOneTimeGift").hide();
                break;
            }
        }

        $("#step" + currentStep).slideToggle("slow", function () {
            currentStep -= 1;
            $("#step" + currentStep).slideToggle("slow");
        });
    }
    function showResults(currentStep) {
        $("#showResults").slideToggle("slow");

    }
    function validateBeforeSubmitContent() {
        //if true submit form / if false do NOT submit the form
        return true;
    }

    function replaceDonationAmount() {
        //check which they used
        var donationAmount, OneTimeDonation, RecurringDonation;
        donationAmount = 0;
        OneTimeDonation = $("[name=oneTimeDonationValue]").val();
        RecurringDonation = parseInt($("#totalRecurringDonationValue").text(), 10);

        if (OneTimeDonation !== 0) {
            donationAmount = OneTimeDonation;
        } else {
            donationAmount = RecurringDonation;
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
    function showResepectiveAllocation() {
        //scholarship functions
        $("#showGoodMenGoodCitizensAllocation").click(function () {
            if($("#showGoodMenGoodCitizensAllocation:checked").val() === "Good_Men_Good_Citizens") {
                $("#goodMenGoodCitizensAllocation").slideToggle("fast");
            } else {
                $("#goodMenGoodCitizensAllocation").slideToggle("fast");
            }
        });
        $("#showClassof2012Allocation").click(function () {
            if($("#showClassof2012Allocation:checked").val() === "Class_Of_2012") {
                $("#classOf2012Allocation").slideToggle("fast");
            } else {
                $("#classOf2012Allocation").slideToggle("fast");
            }
        });
        $("#showClassof2011Allocation").click(function () {
            if($("#showClassof2011Allocation:checked").val() === "Class_Of_2011") {
                $("#classOf2011Allocation").slideToggle("fast");
            } else {
                $("#classOf2011Allocation").slideToggle("fast");
            }
        });
        $("#showClassof2010Allocation").click(function () {
            if($("#showClassof2010Allocation:checked").val() === "Class_Of_2010") {
                $("#classOf2010Allocation").slideToggle("fast");
            } else {
                $("#classOf2010Allocation").slideToggle("fast");
            }
        });
        $("#showClassof2009Allocation").click(function () {
            if($("#showClassof2009Allocation:checked").val() === "Class_Of_2009") {
                $("#classOf2009Allocation").slideToggle("fast");
            } else {
                $("#classOf2009Allocation").slideToggle("fast");
            }
        });
        $("#showClassof2008Allocation").click(function () {
            if($("#showClassof2008Allocation:checked").val() === "Class_Of_2008") {
                $("#classOf2008Allocation").slideToggle("fast");
            } else {
                $("#classOf2008Allocation").slideToggle("fast");
            }
        });
        $("#showClassof2007Allocation").click(function () {
            if($("#showClassof2007Allocation:checked").val() === "Class_Of_2007") {
                $("#classOf2007Allocation").slideToggle("fast");
            } else {
                $("#classOf2007Allocation").slideToggle("fast");
            }
        });
        $("#showClassof2006Allocation").click(function () {
            if($("#showClassof2006Allocation:checked").val() === "Class_Of_2006") {
                $("#classOf2006Allocation").slideToggle("fast");
            } else {
                $("#classOf2006Allocation").slideToggle("fast");
            }
        });
        $("#showClassof2005Allocation").click(function () {
            if($("#showClassof2005Allocation:checked").val() === "Class_Of_2005") {
                $("#classOf2005Allocation").slideToggle("fast");
            } else {
                $("#classOf2005Allocation").slideToggle("fast");
            }
        });
        $("#showClassof2004Allocation").click(function () {
            if($("#showClassof2004Allocation:checked").val() === "Class_Of_2004") {
                $("#classOf2004Allocation").slideToggle("fast");
            } else {
                $("#classOf2004Allocation").slideToggle("fast");
            }
        });
        $("#showClassof2003Allocation").click(function () {
            if($("#showClassof2003Allocation:checked").val() === "Class_Of_2003") {
                $("#classOf2003Allocation").slideToggle("fast");
            } else {
                $("#classOf2003Allocation").slideToggle("fast");
            }
        });
        $("#showClassof1980Allocation").click(function () {
            if($("#showClassof1980Allocation:checked").val() === "Class_Of_1980") {
                $("#classOf1980Allocation").slideToggle("fast");
            } else {
                $("#classOf1980Allocation").slideToggle("fast");
            }
        });
        $("#showClassof1961Allocation").click(function () {
            if($("#showClassof1961Allocation:checked").val() === "Class_Of_1961") {
                $("#classOf1961Allocation").slideToggle("fast");
            } else {
                $("#classOf1961Allocation").slideToggle("fast");
            }
        });
        $("#showClassof1960Allocation").click(function () {
            if($("#showClassof1960Allocation:checked").val() === "Class_Of_1960") {
                $("#classOf1960Allocation").slideToggle("fast");
            } else {
                $("#classOf1960Allocation").slideToggle("fast");
            }
        });
        $("#showClassof1958Allocation").click(function () {
            if($("#showClassof1958Allocation:checked").val() === "Class_Of_1958") {
                $("#classOf1958Allocation").slideToggle("fast");
            } else {
                $("#classOf1958Allocation").slideToggle("fast");
            }
        });
        $("#showClassof1954Allocation").click(function () {
            if($("#showClassof1954Allocation:checked").val() === "Class_Of_1954") {
                $("#classOf1954Allocation").slideToggle("fast");
            } else {
                $("#classOf1954Allocation").slideToggle("fast");
            }
        });
        $("#showClassof1953Allocation").click(function () {
            if($("#showClassof1953Allocation:checked").val() === "Class_Of_1953") {
                $("#classOf1953Allocation").slideToggle("fast");
            } else {
                $("#classOf1953Allocation").slideToggle("fast");
            }
        });
        $("#showClassof1951Allocation").click(function () {
            if($("#showClassof1951Allocation:checked").val() === "Class_Of_1951") {
                $("#classOf1951Allocation").slideToggle("fast");
            } else {
                $("#classOf1951Allocation").slideToggle("fast");
            }
        });
        $("#showAtkinsonMuseumAllocation").click(function () {
            if($("#showAtkinsonMuseumAllocation:checked").val() === "Atkinson_Museum") {
                $("#atkinsonMuseumAllocation").slideToggle("fast");
            } else {
                $("#atkinsonMuseumAllocation").slideToggle("fast");
            }
        });
        $("#showBortzLibraryAllocation").click(function () {
            if($("#showBortzLibraryAllocation:checked").val() === "Bortz_Library") {
                $("#bortzLibraryAllocation").slideToggle("fast");
            } else {
                $("#bortzLibraryAllocation").slideToggle("fast");
            }
        });
        $("#showCultureAndCommunityAllocation").click(function () {
            if($("#showCultureAndCommunityAllocation:checked").val() === "Culture_and_Community") {
                $("#cultureAndCommunityAllocation").slideToggle("fast");
            } else {
                $("#cultureAndCommunityAllocation").slideToggle("fast");
            }
        });
        $("#showTheWilsonCenterAllocation").click(function () {
            if($("#showTheWilsonCenterAllocation:checked").val() === "Wilson_Center") {
                $("#wilsonCenterAllocation").slideToggle("fast");
            } else {
                $("#wilsonCenterAllocation").slideToggle("fast");
            }
        });
    }
    //Let's add the ability to show and hide fields via the checkboxes
    function addInteractivity() {
        //to unrestricted fund
        $(".showUnrestricted").css("display", "none");
        $("#unrestrictedFund").click(function () {
            if ($("#unrestrictedFund:checked").val() === "unrestricted") {
                $(".showUnrestricted").slideToggle("fast"); //Slide Down Effect
            } else {
                $(".showUnrestricted").slideToggle("fast");  //Slide Up Effect
            }
        });
        //to a specific scholarship
        $(".ifScholarshipsSelected").css("display", "none");
        $(".ScholashipSelection").click(function () {
            if ($("input[name=ScholashipSelection]:checked").val() === "to_Scholarships") {
                $(".ifScholarshipsSelected").slideToggle("fast"); //Slide Down Effect
            } else {
                $(".ifScholarshipsSelected").slideToggle("fast");  //Slide Up Effect
            }
        });
    //to a academics
        $(".ifAcademicsSelected").css("display", "none");
        $(".AcademicSelection").click(function () {
            if ($("input[name=toAcademics]:checked").val() === "to_Academics") {
                $(".ifAcademicsSelected").slideToggle("fast"); //Slide Down Effect
            } else {
                $(".ifAcademicsSelected").slideToggle("fast");  //Slide Up Effect
            }
        });
     //Would you like to donate other funds?
        $(".ifAthleticsAreSelected").css("display", "none");
        $(".enableAthletics").click(function () {
            if ($('input[name=toAthletics]:checked').val() === "to_athletics") {
                $(".ifAthleticsAreSelected").slideDown("fast"); //Slide Down Effect
            } else {
                $(".ifAthleticsAreSelected").slideUp("fast");  //Slide Up Effect
            }
        });
    }

    function validateCurrentStep(currentStep) {
        var chosenDonationType, validateOneTimeDonationAmount, fields, checkAcademicsFields, checkAthleticsFields, checkScholarshipFields, validateRecurringDonationAmount, validateNumberOfPayments, validatePaymentFrequency, validateTotalRecurringDonationAmount;
        chosenDonationType = $("[name=donationType]").val();
        switch (currentStep) {
            //This checks to make sure that they selected a donation type.
        case 1:
            return true;
        //break; Can't break due to return

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
                    $("#oneTimeDonationValidateError").text("");
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
            if ($("#step2ValidateError").hasClass("error")) {
                $("#step2ValidateError").removeClass("error");
                $("#oneTimeDonationCheckboxError").text("");
            }
            return true;


        case 4:
            return true;

        case 5:
            return true;

        default:
            return false;
        } //end currentStep switch
    }

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
            showNextStep(currentStep);
            currentStep += 1;
        } else {
            return false;
        }
    });
    $(".previousStep").click(function () {
        showPreviousStep(currentStep);
        currentStep -= 1;
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
