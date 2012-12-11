//hide the second, third and fourth steps from the user.
$("document").ready(function(){

    //Hide additional steps and the differences between the two steps if they have Javascript
    function hideSteps() {
        //hide the divs
        $("#step1").hide();
        $("#step2").hide();
        $("#step3").hide();
        $("#step4").hide();
        $("#makingAOneTimeGift").hide();
        $("#makingARecurringGift").hide();
        $("#dialog-modal").hide();
    }
    //Show the submit buttons since we're going to take them through the steps
    function showSubmitSteps() {
        $("#submit_first").show();
        $("#submit_second").show();
        $("#submit_third").show();
        $("#return_question").show();
        $("#return_first").show();
        $("#return_second").show();
        $("#return_third").show();
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
                    howLong += numberOfPayments + " month";
                } else if(numberOfPayments <= 12) {
                howLong += numberOfPayments + " months";
                } else {
                   var howManyYears = Math.floor(numberOfPayments / 12);
                   var howManyMonths = numberOfPayments % 12;

                   howLong += howManyYears + " years, and " + howManyMonths + " months";
                }
                $("#lengthOfTime").text(howLong);
            break;

            case "Quarterly":
                howLong = " will be made quarterly over "
                if (numberOfPayments == 0) {
                    howLong = "";
                } else if(numberOfPayments <= 4) {
                    numberOfMonths = numberOfPayments * 3;
                    howLong += numberOfMonths + " months"
                } else {
                    var howManyYears = Math.floor((numberOfPayments*3) / 12);
                    var howManyMonths = (numberOfPayments*3) % 12;
                    howLong += howManyYears + " years, and " + howManyMonths + " months";
                }
                $("#lengthOfTime").text(howLong);
            break;

            case "Annually":
                howLong += numberOfPayments;
                if (numberOfPayments == 0) {
                    howLong = "";
                } else if(numberOfPayments == 1) {
                    howLong += " year";
                } else {
                    howLong += " years";
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

    function validateOneTimeGiftandRecurringGift() {
    //check if we have to validate a recurring gift or a one-time gift
    var typeOfDonation = $("#typeOfGift").text();
        if(typeOfDonation == "one-time") {
            var validateOneTimeGiftAmount = $("[name=oneTimeDonationValue]").val();
            if (validateOneTimeGiftAmount == 0) {
                alert("Sorry, but the donation amount has been left at 0. Please change this to an amount above $5")
            } else if(validateOneTimeGiftAmount < 5) {
                alert("Sorry, but we have a $5 minimum donation.")
            } else {
                $("#step1").slideToggle("slow");
                $("#step2").slideToggle("slow");
            }
        }  else if(typeOfDonation == "total recurring") {
            var validateRecurringGiftAmount = parseInt($("#totalRecurringDonationValue").text());
            if(validateRecurringGiftAmount != 0) {
                if(validateRecurringGiftAmount < 5) {
                    alert("Sorry, but we have a $5 minimum donation.")
            } else {
                    $("#step1").slideToggle("slow");
                    $("#step2").slideToggle("slow");
                }
            } else {
                var validateNumberofTimes = $("#numberOfPayments").val();
                var validateAmount = $("#recurringDonationValue").val();
                var validateFrequency = $("#paymentFrequency").val()

                //check if they didn't enter either
                if(validateAmount == 0) {
                    $("[name=giftModal]").attr('title', 'Sorry!');
                    $("#giftModal").text("Please enter a donation amount.");
                    $(function() {
                        $( "#dialog-modal" ).dialog({
                            modal: true
                        });
                    });
                } else if(validateNumberofTimes == 0) {
                    alert("Please select how for how many times you would like to make your donation.");
                } else if(validateFrequency == 0) {
                    alert("Please choose how often you would like to make this gift.")
                }
            }
        } else {
            alert("How'd you get here?")
        }
    }

    hideSteps();
    showSubmitSteps();
    addInteractiveFields();
    $("#recurringDonationValue, #numberOfPayments, #paymentFrequency").change(function() {
        replaceRecurringDonationValue();
    });

    //they chose a one-time gift
    $("#oneTimeGift").click(function() {
        $("#makingAOneTimeGift").show();
        $("#typeOfGift").text("one-time");
        $("#step0").slideToggle("slow");
        $("#step1").slideToggle("slow");
        return false; // prevent the link from submitting
    });
     $("#recurringGift").click(function() {
        $("#makingARecurringGift").show();
        $("#typeOfGift").text("total recurring");
        $("#step0").slideToggle("slow");
        $("#step1").slideToggle("slow");
        return false; // prevent the link from submitting
    });
    //let's add the "Next" buttons to make this move forward
    $("#submit_first").click(function() {
        validateOneTimeGiftandRecurringGift()
        replaceDonationAmount();
        return false; // prevent the link from submitting
    });
    $("#submit_second").click(function() {
        $("#step2").slideToggle("slow");
        $("#step3").slideToggle("slow");
        replaceDonationAmount();
        return false;
    });
    //let's add the "Previous" button
    $("#return_question").click(function() {
        $("#step1").slideToggle("slow");
        $("#step0").slideToggle("slow");
        $("#makingARecurringGift").hide();
        $("#makingAOneTimeGift").hide();
        return false;
    });
    $("#return_first").click(function() {
        $("#step2").slideToggle("slow");
        $("#step1").slideToggle("slow");
        return false;
    });
    $("#submit_third").click(function() {
        $("#step3").slideToggle("slow");
        $("#step4").slideToggle("slow");
        return false;
    });
    $("#return_second").click(function() {
        $("#step3").slideToggle("slow");
        $("#step2").slideToggle("slow");
        return false;
    });
    $("#return_third").click(function() {
        $("#step4").slideToggle("slow");
        $("#step3").slideToggle("slow");
        return false;
    });
    $("#submit_form").click(function() {
        return true; //submit the form using ajax!
    });
});
