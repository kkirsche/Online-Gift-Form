//hide the second, third and fourth steps from the user.
$("document").ready(function(){
    
    //Hide additional steps if they have Javascript
    function hideSteps() {
        //hide the divs
        $("#step2").hide();
        $("#step3").hide();
        $("#step4").hide();
    }
    //Show the submit buttons since we're going to take them through the steps
    function showSubmitSteps() {
        $("#submit_first").show();
        $("#submit_second").show();
        $("#submit_third").show();
        $("#return_first").show();
        $("#return_second").show();
        $("#return_third").show();
    }
    //Let's add the ability to show and hide fields via the checkboxes
    function addInteractiveFields() {
        //Class Year Dropdown
        $("#ifClassScholashipsSelected").css("display","none");
        $(".enableClassYearSelection").click(function(){
            if ($("input[name=Class_Scholarships]:checked").val() == "class_scholarships") {
                $("#ifClassScholashipsSelected").slideToggle("fast"); //Slide Down Effect
            } else {
                $("#ifClassScholashipsSelected").slideToggle("fast");  //Slide Up Effect
            }
     });
     //Other Funds Dropdown
        $("#ifOtherFundsSelected").css("display","none");
        $(".enableOtherFunds").click(function(){
            if ($('input[name=OtherFunds]:checked').val() == "other_funds" ) {
                $("#ifOtherFundsSelected").slideDown("fast"); //Slide Down Effect
            } else {
                $("#ifOtherFundsSelected").slideUp("fast");  //Slide Up Effect
            }
     });
     //In Memory Of Dropdown
        $("#ifInMemoryOfSelected").css("display","none");
        $(".enableInMemoryOf").click(function(){
        if ($('input[name=InMemoryOf]:checked').val() == "in_memory_of" ) {
            $("#ifInMemoryOfSelected").slideDown("fast"); //Slide Down Effect
        } else {
            $("#ifInMemoryOfSelected").slideUp("fast");  //Slide Up Effect
        }
     });
        //In Honor Of Dropdown
        $("#ifInHonorOfSelected").css("display","none");
        $(".enableInHonorOf").click(function(){
        if ($('input[name=InHonorOf]:checked').val() == "in_honor_of" ) {
            $("#ifInHonorOfSelected").slideDown("fast"); //Slide Down Effect
        } else {
            $("#ifInHonorOfSelected").slideUp("fast");  //Slide Up Effect
        }
     });
    }
    
    hideSteps();
    showSubmitSteps();
    addInteractiveFields();

    //let's add the "Next" buttons to make this move forward
    $("#submit_first").click(function() {
        $("#step1").slideToggle("slow");
        $("#step2").slideToggle("slow");
        return false; // prevent the link from submitting
    });
    $("#submit_second").click(function() {
        $("#step2").slideToggle("slow");
        $("#step3").slideToggle("slow");
        return false;
    });
    //let's add the "Previous" button
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