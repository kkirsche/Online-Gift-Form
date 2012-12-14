$("document").ready(function(){

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
        $("#step"+currentStep).slideToggle("slow", function(){
            if(currentStep == 1) {
                //figure out what kind of donation they are making
                var chosenDonationType = $("[name=donationType]").val();
                //show the apppropriate slide
                switch(chosenDonationType) {
                    case "oneTimeGift":
                        currentStep += 1;
                        $("#makingAOneTimeGift").show();
                        $("#step"+currentStep).slideToggle("slow");
                    break;
                    case "recurringDonation":
                        currentStep += 1;
                        $("#makingARecurringGift").show();
                        $("#step"+currentStep).slideToggle("slow");
                    break;
                    //if somehow they changed it to something else, ignore them and return false.
                    default:
                        return false;
                    break;
                }//end switch
            } else {
                currentStep += 1;
                $("#step"+currentStep).slideToggle("slow");
            }
        });
    }
    function showPreviousStep(currentStep) {
        if(currentStep == 2) {
            var chosenDonationType = $("[name=donationType]").val();
            switch(chosenDonationType) {
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

        $("#step"+currentStep).slideToggle("slow", function(){
            currentStep -= 1;
            $("#step"+currentStep).slideToggle("slow");
        });
    }
    function showResults(currentStep) {
        $("#showResults").slideToggle("slow");

    }
    function validateBeforeSubmitContent() {
        //if true submit form / if false do NOT submit the form
        return true;
    }

    //Replace the Recurring donation amount so they know how much their total gift amount.
    function replaceRecurringDonationValue() {
        //Let's get the values and store them in our variables
        var perDonationValue = $("#recurringDonationValue").val();
        var numberOfPayments = $("#numberOfPayments").val();
        var paymentFrequency = $("#paymentFrequency").val();

        //ensure that the maximum number of months is enforced.
        if(numberOfPayments > 60) {
            alert("Donations can last for a maximum of 60 times.");
            $("#numberOfPayments").val(60);
        } else if(numberOfPayments < 0) {
            alert("You cannot make a negative number of domnations.");
            $("#numberOfPayments").val(0);
        }

        var TotalRecurringDonationValue = perDonationValue * numberOfPayments;
        var howLong = " over ";

        //now say over what time period. Switch will be faster than an if else.
        switch (paymentFrequency) {
            case "Monthly":
                if(numberOfPayments == 0) {
                   howLong = "";
                } else if(numberOfPayments == 1) {
                    howLong += numberOfPayments + " month.";
                } else if(numberOfPayments <= 12) {
                howLong += numberOfPayments + " months.";
                } else {
                   var howManyYears = Math.floor(numberOfPayments / 12);
                   var howManyMonths = numberOfPayments % 12;

                   howLong += howManyYears + " years, and " + howManyMonths + " months.";
                }
                $("#lengthOfTime").text(howLong);
            break;

            case "Quarterly":
                howLong = " will be made quarterly over "
                if (numberOfPayments == 0) {
                    howLong = "";
                } else if(numberOfPayments <= 4) {
                    numberOfMonths = numberOfPayments * 3;
                    howLong += numberOfMonths + " months."
                } else {
                    var howManyYears = Math.floor((numberOfPayments*3) / 12);
                    var howManyMonths = (numberOfPayments*3) % 12;
                    howLong += howManyYears + " years, and " + howManyMonths + " months.";
                }
                $("#lengthOfTime").text(howLong);
            break;

            case "Annually":
                howLong += numberOfPayments;
                if (numberOfPayments == 0) {
                    howLong = "";
                } else if(numberOfPayments == 1) {
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

    function replaceDonationAmount() {
        //check which they used
        var donationAmount = 0;
        var OneTimeDonation = $("[name=oneTimeDonationValue]").val();
        var RecurringDonation = parseInt($("#totalRecurringDonationValue").text());

        if(OneTimeDonation != 0) {
            donationAmount = OneTimeDonation;
        } else {
            donationAmount = RecurringDonation;
        }
        $("#showTotalDonationAmount").text(donationAmount);
    }

    //Let's add the ability to show and hide fields via the checkboxes
    function addInteractiveFields() {
        //to a specific scholarship
        $("#ifScholarshipsSelected").css("display","none");
        $(".ScholashipSelection").click(function(){
            if ($("input[name=ScholashipSelection]:checked").val() == "to_Scholarships") {
                $("#ifScholarshipsSelected").slideToggle("fast"); //Slide Down Effect
            } else {
                $("#ifScholarshipsSelected").slideToggle("fast");  //Slide Up Effect
            }
     });
    //to a academics
        $("#ifAcademicsSelected").css("display","none");
        $(".AcademicSelection").click(function(){
            if ($("input[name=toAcademics]:checked").val() == "to_Academics") {
                $("#ifAcademicsSelected").slideToggle("fast"); //Slide Down Effect
            } else {
                $("#ifAcademicsSelected").slideToggle("fast");  //Slide Up Effect
            }
     });
     //Would you like to donate other funds?
        $("#ifAthleticsAreSelected").css("display","none");
        $(".enableAthletics").click(function(){
            if ($('input[name=toAthletics]:checked').val() == "to_athletics" ) {
                $("#ifAthleticsAreSelected").slideDown("fast"); //Slide Down Effect
            } else {
                $("#ifAthleticsAreSelected").slideUp("fast");  //Slide Up Effect
            }
        });
    }

    function getFundsForAllocation() {
        //get all checkboxes that are checked and show their allocation
        $("#step3 input:checkbox:checked").each(function() {
            switch($(this).val()) {
                case "unrestricted":
                    $("#showUnrestricted").show();
                break;

            }
        });
    }
    function validateCurrentStep(currentStep) {
        var chosenDonationType = $("[name=donationType]").val();
        switch(currentStep) {
            //This checks to make sure that they selected a donation type.
            case 1:
                return true;
            break;

            //This verifies donation type and checks to make sure they entered a donation amount 
            case 2:
                switch(chosenDonationType) {
                    case "oneTimeGift":
                        var validateOneTimeDonationAmount = $("[name=oneTimeDonationValue]").val();
                        if(validateOneTimeDonationAmount < 5) {
                            $("#makingAOneTimeGift").addClass("error");
                            $("#oneTimeDonationValidateError").text("Sorry, we have a $5 donation minimum.");
                            return false;
                        } else {
                            if($("#makingAOneTimeGift").hasClass("error")) {
                                $("#oneTimeDonationValidateError").text("");
                                $("#makingAOneTimeGift").removeClass("error");
                            }
                           return true; 
                        }
                    break;

                    case "recurringDonation":
                        var validateRecurringDonationAmount = $("[name=recurringDonationValue]").val();
                        var validateNumberOfPayments = $("[name=numberOfPayments]").val();
                        var validatePaymentFrequency = $("[name=paymentFrequency]").val();
                        var validateTotalRecurringDonationAmount = validateRecurringDonationAmount * validateNumberOfPayments;
                        //first check the total amount, it should be at least $5.00
                        if(validateTotalRecurringDonationAmount < 5) {
                            $("#makingARecurringGift").addClass("error");
                            $("#recurringDonationAmountValidateError").text("Sorry, your total donation was less than $5. We have a $5 donation minimum.");
                            return false;
                        } else if(validateNumberOfPayments == 0) {
                            $("#makingARecurringGift").addClass("error");
                            $("#recurringDonationAmountValidateError").text("Sorry, you must choose how many months you would like to make this donation for.");
                            return false;
                        } else {
                            if($("#makingARecurringGift").hasClass("error")) {
                                $("#oneTimeDonationValidateError").text("");
                                $("#makingARecurringGift").removeClass("error");
                            }
                           return true; 
                        }
                    break;
                }//end chosenDonationType switch
            break;

            //This verifies that they chose a fund to donate to.
            case 3:

                var fields = $("#step3 input:checkbox:checked");
                //check that they chose any fund at all
                if(fields.length == 0) {
                    $("#step3").addClass("error");
                    $("#checkboxError").text("Please choose a fund to donate to.");
                    return false;
                    break; 
                }

                //Check Scholarships
                if ($("[name=ScholashipSelection]").is(":checked")) {
                    var checkScholarshipFields = $("#ifScholarshipsSelected input:checkbox:checked");
                    if(checkScholarshipFields.length == 0) {
                        $("#step3").addClass("error");
                        $("#checkboxError").text("Please choose which scholarship you would like to donate to.");
                        return false;
                        break;
                    } else {
                        if($("#step3").hasClass("error")) {
                            $("#step3").removeClass("error");
                            $("#checkboxError").text("");
                        }
                    }
                } 

                //Check Acadmics
                if ($("[name=toAcademics]").is(":checked")) {
                    var checkAcademicsFields = $("#ifAcademicsSelected input:checkbox:checked");
                    if(checkAcademicsFields.length == 0) {
                        $("#step3").addClass("error");
                        $("#checkboxError").text("Please choose which academic fund you would like to donate to.");
                        return false;
                        break;
                    } else {
                        if($("#step3").hasClass("error")) {
                            $("#step3").removeClass("error");
                            $("#checkboxError").text("");
                        }
                    }
                }

                //check Athletics
                if($("[name=toAthletics]").is(":checked")) {
                    var checkAthleticsFields = $("#ifAthleticsAreSelected input:checkbox:checked");
                    if(checkAthleticsFields.length == 0) {
                        $("#step3").addClass("error");
                        $("#checkboxError").text("Please choose which athletic fund you would like to donate to.");
                        return false;
                        break;
                    } else {
                        if($("#step3").hasClass("error")) {
                            $("#step3").removeClass("error");
                            $("#checkboxError").text("");
                        }
                    }
                }

                //if we didn't have to stop anywhere above this, let the step continue
                if($("#step2ValidateError").hasClass("error")) {
                    $("#step2ValidateError").removeClass("error");
                    $("#oneTimeDonationCheckboxError").text("");
                }
                return true;
            break;


            case 4:
                return true;
            break;

            case 5:
                return true;
            break;

            default:
                return false;
            break;
        } //end currentStep switch
    }

    currentStep = 1;
    hideSteps();
    addInteractiveFields();
    $("#recurringDonationValue, #numberOfPayments, #paymentFrequency").change(function() {
        replaceRecurringDonationValue();
    });

    $("#oneTimeGift").click(function() {
        $("[name=donationType]").val("oneTimeGift");
    });
    $("#recurringGift").click(function() {
        $("[name=donationType]").val("recurringDonation");
    });
    $("#replaceDonationAmountNow").click(function() {
        replaceDonationAmount();
        var chosenDonationType = $("[name=donationType]").val();
            switch(chosenDonationType) {
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
    $(".nextStep").click(function() {
        if(validateCurrentStep(currentStep)) {
            showNextStep(currentStep);
            currentStep += 1;
        } else {
            return false;
        }
    });
    $(".previousStep").click(function() {
        showPreviousStep(currentStep);
        currentStep -= 1;
    });
    

    $("[name=submit_form]").click(function(e) {
            var options = {
                target: "#step6",
                clearForm: true
        };
        if(validateBeforeSubmitContent(e)){
            $("#DonationForm").ajaxForm(options);
        } else {
            e.preventDefault();
            return false;
        }
    });
});
