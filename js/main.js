$("document").ready(function(){

    //Hide additional steps and the differences between the two steps if they have Javascript
    function hideSteps() {
        //hide the divs
        $("#step2").hide();
        $("#step3").hide();
        $("#step4").hide();
        $("#step5").hide();
        $("#makingAOneTimeGift").hide();
        $("#makingARecurringGift").hide();
        $("#dialog-modal").hide();
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

        $("#totalRecurringDonationValue").text(TotalRecurringDonationValue);
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

    function validateCurrentStep(currentStep) {
        var chosenDonationType = $("[name=donationType]").val();
        switch(currentStep) {
            //if submitting first step
            case 1:
                return true;
            break;
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

            case 3:
                return true;
            break;
                return true;
            case 4:
                return true;
            break;
                return true;
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
    

    $("[name=submit_form]").click(function() {
            var options = {
                target: "#ajaxReplacement"
        //beforeSubmit: 
        };
    $("#DonationForm").ajaxForm(options);
    });
});
