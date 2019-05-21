//login script

function startloading() {
    var loading = document.getElementById("loading");
    loading.style.display = "inline-block";
}

function stoploading() {
    var loading = document.getElementById("loading");
    loading.style.display = 'none';

}


function startsearchloading() {
    var searchloading = document.getElementById("searchingloading");
    searchloading.style.display = "inline-block";
}

function stopsearchloading() {
    var searchloading = document.getElementById("searchingloading");
    searchloading.style.display = "none";
}



function startpayloading() {
    var payloading = document.getElementById("payloading");
    payloading.style.display = "inline-block";
}

function stoppayloading() {
    var payloading = document.getElementById("payloading");
    payloading.style.display = "none";
}


$("body").delegate("#loginbtn", "click", function (e) {
    e.preventDefault();

    var emailtxtbox = document.getElementById('email');
    var passwordtxtbox = document.getElementById('pwd');
    var email = emailtxtbox.value;
    var password = passwordtxtbox.value;



    if (email === "") {
        document.getElementById('email-error-msg').innerHTML = "Email cannot be empty";
        emailtxtbox.classList.add("error");
        return false;

    } else {
        document.getElementById('email-error-msg').innerHTML = "";
        emailtxtbox.classList.add("success");

    }

    if (password === "") {
        document.getElementById('password-error-msg').innerHTML = "Password cannot be empty";
        passwordtxtbox.classList.add("error");
        return false;


    } else if (password.length < 8) { // checks the password value length
        document.getElementById('password-error-msg').innerHTML = "Password must not be less than 8 characters";
        passwordtxtbox.classList.add("error");
        $(passwordtxtbox).focus(); // focuses the current field.
        return false; // stops the execution.
    } else {

        document.getElementById('password-error-msg').innerHTML = "";
        passwordtxtbox.classList.add("success");


    }


    startloading();

    $.ajax({




        url: "../action/login-agent-action.php",
        method: "POST",
        data: {
            emailLogin: email,
            password: password
        },
        success: function (data) {
            loginmsg();
            $('#loginmsg').html(data);

        }




    })

});


//end of login script



//sign up script


$("body").delegate("#regbtn", "click", function (e) {
    var emailtxtbox = document.getElementById('email');
    var passwordtxtbox = document.getElementById('pwd');
    var fnametxtbox = document.getElementById('fname');
    var lnametxtbox = document.getElementById('lname');
    var phonetxtbox = document.getElementById('phone');
    var cpasswordtxtbox = document.getElementById('cpwd');
    var gendertxtbox = document.getElementById('gender');
    var stationtxtbox = document.getElementById('station');




    e.preventDefault();

    if (fnametxtbox.value === "") {
        document.getElementById('fname-error-msg').innerHTML = "First name cannot be empty";
        fnametxtbox.classList.add("error");
        return false;

    } else {
        document.getElementById('fname-error-msg').innerHTML = "";
        fnametxtbox.classList.add("success");

    }

    if (lnametxtbox.value === "") {
        document.getElementById('lname-error-msg').innerHTML = "Last Name cannot be empty";
        lnametxtbox.classList.add("error");
        return false;

    } else {
        document.getElementById('lname-error-msg').innerHTML = "";
        lnametxtbox.classList.add("success");

    }



    if (emailtxtbox.value === "") {
        document.getElementById('email-error-msg').innerHTML = "Email cannot be empty";
        emailtxtbox.classList.add("error");
        return false;

    } else {
        document.getElementById('email-error-msg').innerHTML = "";
        emailtxtbox.classList.add("success");

    }


    if (phonetxtbox.value === "") {
        document.getElementById('phone-error-msg').innerHTML = "Phone cannot be empty";
        phonetxtbox.classList.add("error");
        return false;

    } else {
        document.getElementById('phone-error-msg').innerHTML = "";
        phonetxtbox.classList.add("success");

    }

    if (passwordtxtbox.value === "") {
        document.getElementById('password-error-msg').innerHTML = "Password cannot be empty";
        passwordtxtbox.classList.add("error");
        return false;


    } else if (passwordtxtbox.value.length < 8) { // checks the password value length
        document.getElementById('password-error-msg').innerHTML = "Password must not be less than 8 characters";
        passwordtxtbox.classList.add("error");

        return false; // stops the execution.
    } else {

        document.getElementById('password-error-msg').innerHTML = "";
        passwordtxtbox.classList.add("success");


    }

    if (cpasswordtxtbox.value != passwordtxtbox.value) {
        document.getElementById('cpassword-error-msg').innerHTML = "Passwords do not match";
        cpasswordtxtbox.classList.add("error");
        return false;


    } else {

        document.getElementById('cpassword-error-msg').innerHTML = "";
        cpasswordtxtbox.classList.add("success");


    }

    startloading();
    $.ajax({



        url: "../action/register-agent-action.php",
        method: "POST",
        data: {

            emailRegister: emailtxtbox.value,
            fname: fnametxtbox.value,
            lname: lnametxtbox.value,
            gender: gendertxtbox.value,
            station: stationtxtbox.value,
            phone: phonetxtbox.value,
            password: passwordtxtbox.value

        },
        success: function (data) {
            registermsgsuccess();
            $('#registermsg').html(data);
            registermsgsuccessclose();
        }




    })


});

function trigger_add_matatu_form() {
    var x = document.getElementById('add-matatu-form');
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}

function displaymatatu() {



    var target = document.getElementById('registered-matatu');
    //alert(0);
    $.ajax({
        url: "../action/all-registered-matatu.php",
        data: {},
        method: "POST",
        success: function (data) {
            $(target).html(data);
        }




    });

}


$(document).ready(function (e) {
    $('form.ajax').on('submit', function (e) {


        e.preventDefault();
        // alert(0);

        var loading = document.getElementById('loading');
        var addmatloading = document.getElementById('addmatloading');
        addmatloading.style.display = "inline-block";



        $.ajax({
            url: "../action/add-matatu-action.php", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function (data) // A function to be called if request succeeds
            {

                //alert(data);
                //$('#loading').hide();
                $("#matatu-add-msg").html(data);
            }
        });


    });
});






$(document).ready(function (e) {
    $('form.stakeholderform').on('submit', function (e) {
        e.preventDefault();

        startloading();

        //  alert(0);
        $.ajax({
            url: "../action/register-stakeholder-action.php", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function (data) // A function to be called if request succeeds
            {

                //alert(data);
                registermsgsuccess();
                //$('#loading').hide();
                $("#registermsg").html(data);
                registermsgsuccessclose();
            }
        });





    });

});



function displaystakeholders() {
    var target = document.getElementById('all-stakeholders');

    // startloading();

    $.ajax({
        url: "../action/display-all-stakeholders.php",
        data: {},
        method: "POST",
        success: function (data) {

            $(target).html(data);
        }




    });

}


function displayagents() {
    var target = document.getElementById('all-agents');

    //startloading();

    $.ajax({
        url: "../action/display-all-agents.php",
        data: {},
        method: "POST",
        success: function (data) {
            $(target).html(data);
        }




    });

}


function linktomatatu() {
    // startloading();
    $("body").delegate("#link-to-matatu-btn", "click", function (e) {
        e.preventDefault();

        var x = document.getElementById('my-modal-div');
        var y = document.getElementById('my-modal');
        x.style.filter = "grayscale(0%";
        x.style.opacity = 1;
        x.style.zIndex = 20;
        y.style.transform = "scale(1)";
        //  
        //
        // var target=document.getElementById('my-modal');

        var uid = $(this).attr('uid');

        $.ajax({
            url: "../action/link-matatu-stakeholder.php",
            data: {

                userid: uid
            },
            method: "POST",
            success: function (data) {

                $('#my-modal').html(data);
                //stoploading();

            }




        });



        // x.style.display="block";
        //x.fadeIn(1000);
        //alert(0);

    });
}


function closemymodal() {
    var x = document.getElementById('my-modal-div');
    var y = document.getElementById('my-modal');
    x.style.filter = "grayscale(100%)";




    y.style.transform = "scale(0)";

    setTimeout(function () {
        x.style.zIndex = 0;
        x.style.opacity = 0;
    }, 400);



}


function triggersidemenu() {

    var x = document.getElementById('sidenav');
    var y = document.getElementById('form-div');

    if (x.style.left === "-500px") {
        x.style.left = "0px";
        y.style.width = "";
    } else {
        x.style.left = "-500px";
         y.style.width = "100%";
         y.style.float= "right";
    }
}



$("body").delegate("#link_matatu_stakeholder_btn", "click", function (e) {
    e.preventDefault();

    var stakeholderuid = $(this).attr('uid');
    var matid = $(this).attr('matid');
    //alert(stakeholderuid);
    $.ajax({
        url: "../action/link-matatu-stakeholder-final.php", // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: {
            stakeholderuserid: stakeholderuid,
            matid: matid

        },
        success: function (data) // A function to be called if request succeeds
        {
            displaystakeholders();
            // alert(data);
            linksuccess();
            $('#linksuccessnotification').html(data);

        }
    });





});




$("body").delegate("#unlink_matatu_stakeholder_btn", "click", function (e) {
    e.preventDefault();

    var stakeholderuid = $(this).attr('uid');
    var matid = $(this).attr('matid');
    //alert(stakeholderuid);
    $.ajax({
        url: "../action/unlink-matatu-stakeholder-final.php", // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: {
            stakeholderuserid: stakeholderuid,
            matid: matid

        },
        success: function (data) // A function to be called if request succeeds
        {
            displaystakeholders();
            // alert(data);
            linksuccess();
            $('#linksuccessnotification').html(data);

        }
    });





});

function agent_search_matatu() {
    $("body").delegate("#agent-search-matatu-btn", "click", function (e) {
        e.preventDefault();



        // alert(0);

        var input = document.getElementById('input').value;
        var uid = $(this).attr('userid');

        startsearchloading();



        $.ajax({
            url: "../action/agent-action/search-matatu.php",
            data: {

                input: input,
                uid: uid
            },
            method: "POST",
            success: function (data) {

                $('#matatu-search-result').html(data);
            }





        });




    });
}



$("body").delegate("#agent-make-payment-btn", "click", function (e) {

    e.preventDefault();
    startpayloading();

    this.disabled = 'true';


    var uid = $(this).attr('userid');
    var matid = $(this).attr('matid');
    

    //alert(matid);

    // alert(0);

    var cash_input = document.getElementById('cash-input').value;
     var payment_type = document.getElementById('payment-type').value;



    $.ajax({
        url: "../action/agent-action/make-matatu-payment.php",
        data: {

            cash_input: cash_input,
            uid: uid,
            matid: matid,
            payment_type:payment_type
        },
        method: "POST",
        success: function (data) {


            document.getElementById("make-mat-payment").reset(); //reset form 
            agentdisplayallpayment();
            displaytodaypayment();
            stakeholder_mat_link();



            $('#matatu-search-result').html(data);
        }





    });






});


function displaytodaypayment() {
    //alert(0);
    var target = document.getElementById('today-payment');


    $.ajax({

        url: "../action/agent-action/display-today-payment.php",
        data: {},
        method: "POST",
        success: function (data) {
            //alert(data);
            $(target).html(data);
        }




    });

}


function agentdisplayallpayment() {
    //alert(0);
    var target = document.getElementById('all-payment');

    // alert(0);



    $.ajax({

        url: "../action/agent-action/display-all-payment.php",
        data: {},
        method: "POST",
        success: function (data) {

            $(target).html(data);
        }




    });

}



$("body").delegate("#stakeholderloginbtn", "click", function (e) {
    e.preventDefault();
    var emailtxtbox = document.getElementById('email');
    var passwordtxtbox = document.getElementById('pwd');
    var email = emailtxtbox.value;
    var password = passwordtxtbox.value;



    startloading();

    $.ajax({



        url: "../action/stakeholder-action/stakeholder-login-action.php",
        method: "POST",
        data: {
            emailLogin: email,
            password: password
        },
        success: function (data) {
            loginmsg();
            $('#loginmsg').html(data);

        }




    })

});




function stakeholder_mat_link() {
    //alert(0);
    var target = document.getElementById('matat-today-payment');



    $.ajax({

        url: "../action/stakeholder-action/display-stakeholder-matatu.php",
        data: {},
        method: "POST",
        success: function (data) {
            // alert(0);
            $(target).html(data);
        }




    });

}



function linksuccess() {
    var linksuccessnotification = document.getElementById('linksuccessnotification');
    linksuccessnotification.style.bottom = "10px";
}

function linksuccessclose() {
    var linksuccessnotification = document.getElementById('linksuccessnotification');

    setTimeout(function () {
        linksuccessnotification.style.bottom = "-400px";
    }, 6000);
}



function registermsgsuccess() {
    var registermsg = document.getElementById('registermsg');
    registermsg.style.bottom = "10px";
}

function registermsgsuccessclose() {
    var registermsg = document.getElementById('registermsg');

    setTimeout(function () {
        registermsg.style.bottom = "-400px";
    }, 10000);
}

function loginmsg() {
    var loginmsg = document.getElementById('loginmsg');
    loginmsg.style.bottom = "10px";
}

function loginmsgclose() {
    var loginmsg = document.getElementById('loginmsg');

    setTimeout(function () {
        loginmsg.style.bottom = "-400px";
    }, 6000);
}



function displaypayments() {
    var target = document.getElementById('all-payments');
      var sortform=document.getElementById('sortform');
    sortform.reset();

    //startloading();

    $.ajax({
        url: "../action/display-all-payments.php",
        data: {},
        method: "POST",
        success: function (data) {
            $(target).html(data);
            stoploading();
        }




    });

}


$("body").delegate("#sortpayments-btn", "click", function (e) {
     e.preventDefault();
    var target = document.getElementById('all-payments');
    var plate = document.getElementById('plate').value;
    var date = document.getElementById('date').value;
    var agentid = document.getElementById('agent').value;
    var payment_type_input=document.getElementById('payment-type').value;

    //startloading();
//     alert(payment_type_input);

    $.ajax({
        url: "../action/sort-according-to-plate.php",
        data: {
            plateno: plate,
            date:date,
            aid:agentid,
            payment_type:payment_type_input
        },
        method: "POST",
        success: function (data) {
            //echo(data);
            $(target).html(data);
        }




    });   
});


function sort(){
      var target = document.getElementById('all-payments');
    var plate = document.getElementById('plate').value;
    var date = document.getElementById('date').value;
    var agentid = document.getElementById('agent').value;
    var payment_type_input=document.getElementById('payment-type').value;

    //startloading();
//     alert(payment_type_input);

    $.ajax({
        url: "../action/sort-according-to-plate.php",
        data: {
            plateno: plate,
            date:date,
            aid:agentid,
            payment_type:payment_type_input
        },
        method: "POST",
        success: function (data) {
            //echo(data);
            $(target).html(data);
        }




    }); 
}





function sort_according_to_agent() {
    
    var target = document.getElementById('all-payments');
    var agentid = document.getElementById('agent').value;
  
//alert(agentid);
    //startloading();
    // alert(plate);

    $.ajax({
        url: "../action/sort-according-to-agent.php",
        data: {
            agid: agentid
        },
        method: "POST",
        success: function (data) {
            //echo(data);
            $(target).html(data);
        }




    });

}




function sort_according_to_date() {
    var target = document.getElementById('all-payments');
    var date = document.getElementById('date').value;

    //startloading();
    //alert(date);

    $.ajax({
        url: "../action/sort-according-to-date.php",
        data: {
            date: date
        },
        method: "POST",
        success: function (data) {
            //echo(data);
            $(target).html(data);
        }




    });

}



function sort_between_date() {
    $("body").delegate("#sort-btn-date-btn", "click", function (e) {
        e.preventDefault();

    });

    var target = document.getElementById('all-payments');
    var start = document.getElementById('start-date').value;
    var end = document.getElementById('end-date').value;

    //startloading();
    //alert(date);

    $.ajax({
        url: "../action/sort-mat-between-dates.php",
        data: {
            start: start,
            end: end
        },
        method: "POST",
        success: function (data) {
            //echo(data);
            $(target).html(data);
        }




    });

}



function sort_between_dateAgent() {
    $("body").delegate("#sort-btn-date-btn", "click", function (e) {
        e.preventDefault();

    });
   

    var target = document.getElementById('all-payment');
    var start = document.getElementById('start-date').value;
    var end = document.getElementById('end-date').value;

    //startloading();
    //alert(date);

    $.ajax({
        url: "../action/sort-mat-between-dates.php",
        data: {
            start: start,
            end: end
        },
        method: "POST",
        success: function (data) {
            //echo(data);
            $(target).html(data);
            
        }




    });

}

function sort_according_to_number() {
    var target = document.getElementById('all-payments');
    var number = document.getElementById('number').value;
    //number=Number(number);

    //startloading();
    //alert(number);

    $.ajax({
        url: "../action/sort-according-to-number.php",
        data: {
            number: number
        },
        method: "POST",
        success: function (data) {
            //echo(data);
            $(target).html(data);
        }




    });

}




function sort_this_mat_according_to_date() {

    $("body").delegate("#date", "change", function (e) {
        e.preventDefault();

        var target = document.getElementById('all-payments-for-matatu');
        var date = document.getElementById('date').value;
        var matid = $(this).attr('matid');



        //startloading();
        //alert(matid);

        $.ajax({
            url: "../action/sort-this-mat-according-to-date.php",
            data: {
                date: date,
                matid: matid
            },
            method: "POST",
            success: function (data) {
                //echo(data);
                $(target).html(data);
            }




        });





    });



}


function back_employee_login() {
    var login_email_form = document.getElementById('login-email-form');

    var login_password_form = document.getElementById('login-password-form');

    login_email_form.style.left = "10px";
    login_email_form.style.opacity = "1";
    login_password_form.style.left = "-500px";

}



$("body").delegate("#next-btn-employee-login", "click", function (e) {
    e.preventDefault();

    var emailtxtbox = document.getElementById('email');
    var email = emailtxtbox.value;
    var passwordtxtbx = document.getElementById('password');
    var password = passwordtxtbx.value;
    var login_email_form = document.getElementById('login-email-form');

    var login_password_form = document.getElementById('login-password-form');




    if (email === "") {
        document.getElementById('email-error-msg').innerHTML = "Email cannot be empty";
        emailtxtbox.classList.add("error");
        emailtxtbox.focus();
        return false;

    } else {
        document.getElementById('email-error-msg').innerHTML = "";
        emailtxtbox.classList.remove("error");

    }

    login_email_form.style.left = "-500px";
    login_email_form.style.opacity = "0";
    login_password_form.style.left = "10px";
    passwordtxtbx.focus();
    document.getElementById('email-span-msg').innerHTML = email;


    //startloading();

    $("body").delegate("#login-btn-employee,#login-btn-employee", "click", function (e) {
        e.preventDefault();

        var passwordtxtbx = document.getElementById('password');
        var password = passwordtxtbx.value;

        startloading();
        $.ajax({




            url: "../action/employee-login-action.php",
            method: "POST",
            data: {
                email: email,
                password: password
            },
            success: function (data) {
                loginmsg();
                $('#loginmsg').html(data);

            }




        })
    });









});


function triggerprofilediv() {

    var profilediv = document.getElementById('profile-div');
    profilediv.style.top = "50px";
    profilediv.style.opacity = "1";
    var body = document.getElementById('body');
    body.style.overflow = "hidden";

}


function untriggerprofilediv() {

    var profilediv = document.getElementById('profile-div');
    var body = document.getElementById('body');
    body.style.overflow = "auto";
    profilediv.style.top = "-500px";
    profilediv.style.opacity = "-1";
}

//end of sign up script




function triggerEditAgentModal() {
    $("body").delegate("#edit-agent-btn", "click", function (e) {
        e.preventDefault();
        //alert();

        var x = document.getElementById('my-modal-div');
        var y = document.getElementById('my-modal');
        x.style.filter = "grayscale(0%";
        x.style.opacity = 1;
        x.style.zIndex = 20;
        y.style.transform = "scale(1)";

        // var target=document.getElementById('my-modal');

        var uid = $(this).attr('uid');

        /*
        $.ajax({
            url: "../action/link-matatu-stakeholder.php",
            data: {

                userid: uid
            },
            method: "POST",
            success: function (data) {
                $('#my-modal').html(data);
            }




        });
        */



        // x.style.display="block";
        //x.fadeIn(1000);
        //alert(0);

    });
}


function triggerViewAgentModal() {
    startloading();
    $("body").delegate("#view-agent-btn", "click", function (e) {
        e.preventDefault();
        //alert();

        var aid = $(this).attr('agentid');
        var x = document.getElementById('view-agent-modal');


        var y = document.getElementById('all-agents');
        // var y = document.getElementById('my-modal');
        //x.style.filter="grayscale(0%";
        //x.style.opacity = 1;
        //x.style.zIndex = 20;
        x.style.bottom = "-200px";









        // var target=document.getElementById('my-modal');

        //var uid = $(this).attr('uid');


        $.ajax({
            url: "../action/view-agent-action.php",
            data: {

                agentid: aid
            },
            method: "POST",
            success: function (data) {
                y.style.height = "150px";
                x.style.bottom = "0";
                $('#view-agent-modal-body').html(data);
            }




        });




        // x.style.display="block";
        //x.fadeIn(1000);
        //alert(0);

    });
}


function closeViewAgentModal() {
    var x = document.getElementById('view-agent-modal');
    var y = document.getElementById('all-agents');



    x.style.bottom = "-1000px";
    y.style.height = "auto";






}


function maximizeViewAgentModal() {
    var x = document.getElementById('view-agent-modal');
    var y = document.getElementById('view-agent-modal-body');


    // x.style.bottom = "0";

    y.style.minHeight = "500px";
    x.style.minHeight = "580px";







}


function matatu_linked_to_stakeholder() {
    //alert(0);
    var target = document.getElementById('matatu-linked-to-stakeholder');
    //alert(0);



    $.ajax({

        url: "../action/stakeholder-action/all-matatu-linked-to-stakeholder.php",
        data: {},
        method: "POST",
        success: function (data) {
            // alert(0);
            $(target).html(data);
        }




    });

}



function stakeholdermat_today_payment() {
    //alert(0);
    var target = document.getElementById('total-pay-today');
    //alert(0);



    $.ajax({

        url: "../action/stakeholder-action/stakeholder_total_pay_today.php",
        data: {},
        method: "POST",
        success: function (data) {
            // alert(0);
            $(target).html(data);
        }




    });

}



function stakeholder_today_payments() {
    //alert(0);
    var target = document.getElementById('all-today-payment');



    $.ajax({

        url: "../action/stakeholder-action/display-todays-payments.php",
        data: {},
        method: "POST",
        success: function (data) {
            // alert(0);
            $(target).html(data);
        }




    });

}




function stakeholder_display_all_payments() {
    //alert(0);
    var target = document.getElementById('all-payment');



    $.ajax({

        url: "../action/stakeholder-action/display-all-payments.php",
        data: {},
        method: "POST",
        success: function (data) {
            // alert(0);
            $(target).html(data);
        }




    });

}




$("body").delegate("#dropdown-trigger", "click", function (e) {
     e.preventDefault();
    
    var dropdown_content = document.getElementById('dropdown-content');
    
   
    
    
    if(dropdown_content.style.display === 'block'){
       dropdown_content.style.display = 'none';  
    }
    
    else{
         dropdown_content.style.display = 'block';
    }
    
   
    
});