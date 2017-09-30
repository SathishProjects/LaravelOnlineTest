/*
 Sathish kumar.R
 */

$( document ).ready(function() {
	

    /* All External or Third party plugin call */

  
 /* $(function() {
    $( ".datepicker1" ).datepicker({

        yearRange: '-30:-16',
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true

    });

    

  });*/
  

    $('.multiselect').multiselect({ 

       enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true


    });

    /* All Ajax calls */

   $( ".state" ).on('change', function(e) {

    $('.district').multiselect('destroy');$('.district').empty();

    $('.district').append($("<option disabled selected ></option>").attr("value","").text(" Loading Please Wait... "));

        $.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/get_district',
            data : {StateId : $( ".state").val()},

            success : function(response) {


                $('.district').removeAttr('disabled');

                $('.district').multiselect('destroy');$('.district').empty();

                $('.district').append($("<option disabled selected ></option>").attr("value","").text("- Select District - "));

                $.each(response[0], function(key,value) {
                    $('.district').append($("<option></option>").attr("value",key).text(value));
                });
                $('.district').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
                $('.district').multiselect('refresh');
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })
    });


   $( ".district" ).on('change', function(e) {

    $('.city').multiselect('destroy');$('.city').empty();

    $('.city').append($("<option disabled selected ></option>").attr("value","").text(" Loading Please Wait... "));

        $.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/get_city',
            data : { DistrictId : $( ".district").val()},

            success : function(response) {


                $('.city').removeAttr('disabled');

                $('.city').multiselect('destroy');$('.city').empty();

                $('.city').append($("<option disabled selected  ></option>").attr("value","").text("- Select city - "));

                $.each(response[0], function(key,value) {
                    $('.city').append($("<option></option>").attr("value",key).text(value));
                });
                $('.city').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
                $('.city').multiselect('refresh');
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })
    });


   $( ".degree" ).on('change', function(e) {

        $('.branch').multiselect('destroy');$('.branch').empty();

        $('.branch').append($("<option disabled selected ></option>").attr("value","").text(" Loading Please Wait... "));

        $.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/get_branch',
            data : { degreeId : $( ".degree").val()},

            success : function(data) {


                $('.branch').removeAttr('disabled');

                $('.branch').multiselect('destroy');$('.branch').empty();

                $('.branch').append($("<option disabled selected  ></option>").attr("value","").text(" Select Branch (s) offered "));

                $.each(data[0], function (key, cat) {
                            var group = $('<optgroup>',{label:key});
                            
                            
                                    
                            $.each(cat,function(key,value) {
                                $("<option/>",{value:key,text:value})
                                    .appendTo(group);
                            });
                            $('.branch').append(group);
                        });

                $('.branch').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
                $('.branch').multiselect('refresh');
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })
    });

    $( ".ug_degree" ).on('change', function(e) {

        

        $('.ug_branch').multiselect('destroy');$('.ug_branch').empty();

        $('.ug_branch').append($("<option disabled selected ></option>").attr("value","").text(" Loading Please Wait... "));

        $.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/get_ug_branch',
            data : { degreeId : $( ".ug_degree").val()},

            success : function(data) {


                $('.ug_branch').removeAttr('disabled');

                $('.ug_branch').multiselect('destroy');$('.ug_branch').empty();

                $('.ug_branch').append($("<option disabled selected  ></option>").attr("value","").text(" Select Branch (s) offered "));

                $.each(data[0], function (key, cat) {
                            var group = $('<optgroup>',{label:key});
                            
                            
                                    
                            $.each(cat,function(key,value) {
                                $("<option/>",{value:key,text:value})
                                    .appendTo(group);
                            });
                            $('.ug_branch').append(group);
                        });

                $('.ug_branch').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
                $('.ug_branch').multiselect('refresh');
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })
    });

     $( ".pg_degree" ).on('change', function(e) {

        $('.pg_branch').multiselect('destroy');$('.pg_branch').empty();

        $('.pg_branch').append($("<option disabled selected ></option>").attr("value","").text(" Loading Please Wait... "));

        $.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/get_ug_branch',
            data : { degreeId : $( ".pg_degree").val()},

            success : function(data) {


                $('.pg_branch').removeAttr('disabled');

                $('.pg_branch').multiselect('destroy');$('.pg_branch').empty();

                $('.pg_branch').append($("<option disabled selected  ></option>").attr("value","").text(" Select Branch (s) offered "));

                $.each(data[0], function (key, cat) {
                            var group = $('<optgroup>',{label:key});
                            
                            
                                    
                            $.each(cat,function(key,value) {
                                $("<option/>",{value:key,text:value})
                                    .appendTo(group);
                            });
                            $('.pg_branch').append(group);
                        });

                $('.pg_branch').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
                $('.pg_branch').multiselect('refresh');
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })
    });

    /* Form validations */

    $('.stud_signup').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            first_name: {
                validators: {
                    notEmpty: {
                        message: "First Name is required "
                    },
                    stringLength: {
                        min: 3,max: 128,message: 'First Name should range between 3 to 128 characters'
                    },
                    regexp: {
                        regexp: '^[a-zA-Z 0-9\.\,\&\@]*$',
                        message: "First Name can't accept special characters"
                    }
                }
            },
             last_name: {
                validators: {
                    notEmpty: {
                        message: "Last Name is required and can't be empty "
                    },
                    regexp: {
                        regexp: '^[a-zA-Z 0-9\.\,\+\-]*$',
                        message: "Last Name can't accept special characters"
                    }
                }
            },
             email: {
                validators: {
                    notEmpty: {
                        message: 'Email is required and cannot be empty'
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'Enter a valid email address'
                    },
                    stringLength: {
                        max: 128,
                        message: 'Maximum 128 characters allowed'
                    }
                }
            },
            date_of_birth: {
                validators: {
                    notEmpty: {
                        message: 'The date is required'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'The date is not a valid'
                    }
                }
            },
            mobile: {
                validators: {
                    notEmpty: {
                        message: 'Mobile number cannot be empty'
                    },
                    regexp: {
                        regexp: '^([0|\+[0-9]{1,5})?([7-9][0-9]{9})$',
                        message: 'Enter valid mobile number' 
                    }
                }
            },
            address1: {
                validators: {
                    notEmpty: {
                        message: 'Address1 is required'
                    },
                    stringLength: {
                        min: 6,
                        max: 64,
                        message: 'Address1 should range between 6 to 64 characters'
                    },
                    regexp: {
                        regexp: '^[a-zA-Z 0-9\.\,\+\-\@\&]*$',
                        message: "Address1 can't accept special characters"
                    },                    
                }
            },

            address2: {
                validators: {
                    notEmpty: {
                        message: 'Address2 is required'
                    },
                    stringLength: {
                        min: 6,
                        max: 64,
                        message: 'Address2 should range between 6 to 64 characters'
                    },
                    regexp: {
                        regexp: '^[a-zA-Z 0-9\.\,\+\-\@\&]*$',
                        message: "Address2 can't accept special characters"
                    },
                    
                }
            },

            pincode: {
                validators: {
                    notEmpty: {
                        message: 'Pincode is required'
                    },
                     stringLength: {
                        min:6,
                        max:6,
                        message: 'Pincode should contain 6 characters'
                    },
                     regexp: {
                        regexp: '^[0-9-+]+$',
                        message: 'Invalid Pincode'
                    }
                }
            },

            sslc_school: {
                validators: {
                    notEmpty: {
                        message: 'School / Institution name is required'
                    },
                    stringLength: {
                        min: 10,
                        message: 'School / Institution name requires minimum 10 characters'
                    },
                    regexp: {
                        regexp: '^[a-zA-Z 0-9\.\,\+\-\@\&]*$',
                        message: "School Name can't accept special characters"
                    },
                }
            },

            sslc_marks: {
                validators: {
                    notEmpty: {
                        message: "Marks is required"
                    },
                    between: {
                        min: 35,
                        max: 100,
                        message: 'Marks should range between 35 to 100'
                    },
                    regexp: {
                        regexp: '(^(\+|\-)(0|([1-9][0-9]*))(\.[0-9]{1,2})?$)|(^(0{0,1}|([1-9][0-9]*))(\.[0-9]{1,2})?$)',
                        message: "Invalid Marks"
                    }
                }
            },

            hsc_school: {
                validators: {
                    notEmpty: {
                        message: 'School / Institution name is required'
                    },
                    stringLength: {
                        min: 10,
                        message: 'School / Institution name requires minimum 10 characters'
                    },
                    regexp: {
                        regexp: '^[a-zA-Z 0-9\.\,\+\-\@\&]*$',
                        message: "School Name can't accept special characters"
                    },
                }
            },

            hsc_marks: {
                validators: {
                    notEmpty: {
                        message: "Marks is required"
                    },
                    between: {
                        min: 35,
                        max: 100,
                        message: 'Marks should range between 35 to 100'
                    },
                    regexp: {
                        regexp: '(^(\+|\-)(0|([1-9][0-9]*))(\.[0-9]{1,2})?$)|(^(0{0,1}|([1-9][0-9]*))(\.[0-9]{1,2})?$)',
                        message: "Invalid Marks"
                    }
                }
            },

            diploma_marks: {
                validators: {
                    notEmpty: {
                        message: "Marks is required"
                    },
                    between: {
                        min: 35,
                        max: 100,
                        message: 'Marks should range between 35 to 100'
                    },
                    regexp: {
                        regexp: '(^(\+|\-)(0|([1-9][0-9]*))(\.[0-9]{1,2})?$)|(^(0{0,1}|([1-9][0-9]*))(\.[0-9]{1,2})?$)',
                        message: "Invalid Marks"
                    }
                }
            },

            ug_marks: {
                validators: {
                    notEmpty: {
                        message: "Marks is required"
                    },
                    between: {
                        min: 35,
                        max: 100,
                        message: 'Marks should range between 35 to 100'
                    },
                    regexp: {
                        regexp: '(^(\+|\-)(0|([1-9][0-9]*))(\.[0-9]{1,2})?$)|(^(0{0,1}|([1-9][0-9]*))(\.[0-9]{1,2})?$)',
                        message: "Invalid Marks"
                    }
                }
            },

            pg_marks: {
                validators: {
                    notEmpty: {
                        message: "Marks is required"
                    },
                    between: {
                        min: 35,
                        max: 100,
                        message: 'Marks should range between 35 to 100'
                    },
                    regexp: {
                        regexp: '(^(\+|\-)(0|([1-9][0-9]*))(\.[0-9]{1,2})?$)|(^(0{0,1}|([1-9][0-9]*))(\.[0-9]{1,2})?$)',
                        message: "Invalid Marks"
                    }
                }
            }

        }
    });



    $('.college_signup').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            college_name: {
                validators: {
                    notEmpty: {
                        message: "College Name is required "
                    },
                    stringLength: {
                        min: 3,max: 128,message: 'College Name should range between 3 to 128 characters'
                    },
                    regexp: {
                        regexp: '^[a-zA-Z 0-9\.\,\&\@]*$',
                        message: "College Name can't accept special characters"
                    }
                }
            },


            email: {
                validators: {
                    notEmpty: {
                        message: "Contact Email id is required "
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'Contact Email id is not valid'
                    },
                    stringLength: {
                        max: 128,
                        message: 'Email id accepts maximum upto 128 characters'
                    }
                }
            },

            phone: {
                validators: {
                    notEmpty: {
                        message: "Phone number is required "
                    },
                    stringLength: {
                        min:6,
                        max:15,
                        message: 'Phone number must range between 6 - 15 digits'
                    }
                }
            },


            address: {
                validators: {
                    notEmpty: {
                        message: "Address is required "
                    }
                }
            },

            

            pincode: {
                validators: {
                    notEmpty: {
                        message: "Pincode is required "
                    },
                    stringLength: {
                        min:6,
                        max:6,
                        message: 'Pincode should contain 6 digits'
                    },
                     regexp: {
                        regexp: '^[0-9-+]+$',
                        message: 'Pincode is not valid'
                    }
                }
            },

            landmark: {
                validators: {
                    notEmpty: {
                        message: "Land Mark is required "
                    }
                }
            }

        }
    });
   

    /* Other internal Jquery calls */

    $(function(){
    $(".dropdown").hover(            
            function() {
                $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");                
            },
            function() {
                $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");                
            });
    });
    
    
});


$(document).ready(function () {

    $( document ).ready(function(){
    $('#message_box').modal('show');
    });

    $(".terms").on("click", function(){
            
        if($('.terms:checked').length == 1){
            
            $('.submit_btn').removeAttr('disabled');
        }
        else{
            $('.submit_btn').attr("disabled","disabled");
        }
            
    }); 

     $( ".diploma_college" ).on('change', function(e) {

            var val = $( ".diploma_college :selected" ).val();

            if(val == 0){
                $(".new_diploma_college").append('<div class="row"><div class="col-sm-6"><div class="form-group has-feedback"> <label class="control-label">College Name <span class="note"> *</span></label><input type="text" class="form-control" placeholder="College  Name" name="new_diploma_college_name" required /></div></div><div class="col-sm-6"><div class="form-group has-feedback"><label class="control-label">Address <span class="note"> *</span></label><input type="text" class="form-control" placeholder="Address of college" name="new_diploma_college_location" required/></div></div><br><br></div>');
            }
            else{
                $(".new_diploma_college").empty();
            }

    });

     $( ".ug_college" ).on('change', function(e) {

            var val = $( ".ug_college :selected" ).val();

            if(val == 0){
                $(".new_ug_college").append('<div class="row"><div class="col-sm-6"><div class="form-group has-feedback"> <label class="control-label">College Name <span class="note"> *</span></label><input type="text" class="form-control" placeholder="College  Name" name="new_ug_college_name" required /></div></div><div class="col-sm-6"><div class="form-group has-feedback"><label class="control-label">Address <span class="note"> *</span></label><input type="text" class="form-control" placeholder="Address of college" name="new_ug_college_location" required/></div></div><br><br></div>');
            }
            else{
                $(".new_ug_college").empty();
            }

    });

     $( ".pg_college" ).on('change', function(e) {

            var val = $( ".pg_college :selected" ).val();

            if(val == 0){
                $(".new_pg_college").append('<div class="row"><div class="col-sm-6"><div class="form-group has-feedback"> <label class="control-label">College Name <span class="note"> *</span></label><input type="text" class="form-control" placeholder="College  Name" name="new_pg_college_name" required /></div></div><div class="col-sm-6"><div class="form-group has-feedback"><label class="control-label">Address <span class="note"> *</span></label><input type="text" class="form-control" placeholder="Address of college" name="new_pg_college_location" required/></div></div><br><br></div>');
            }
            else{
                $(".new_pg_college").empty();
            }

    });


    $( ".city" ).on('change', function(e) {

     $( ".college_city").val( $( ".city option:selected").text() );

    });

    $( ".signup_btn" ).on("click", function(event){

        var checkedValues = $('.qualification:checked').map(function() {return this.value;}).get().join();

        var split_str = checkedValues.split(",");

         if (split_str.indexOf("2") !== -1 || split_str.indexOf("26") !== -1) {


            if (split_str.indexOf("20") !== -1 || split_str.indexOf("21") !== -1 || split_str.indexOf("26") !== -1) {

                if (split_str.indexOf("20") == -1 && split_str.indexOf("21") !== -1) {

                 $('.alert_massage').text('Sorry ! You should select UG degree'); 
                $('#alert_box').modal({backdrop: 'static',keyboard: false}); 

                return false;
                
                }

                 $('.student_qualification').submit();
            }
            else{
                $('.alert_massage').text('Sorry ! You should select atleast One degree'); 
                $('#alert_box').modal({backdrop: 'static',keyboard: false}); 
            }
            
         }

         else{
            $('.alert_massage').text('Sorry ! You should select atleast HSC or Diploma to continue'); 
            $('#alert_box').modal({backdrop: 'static',keyboard: false}); 
         }

    });


    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn'),
            allPrevBtn = $('.prevBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-danger').addClass('btn-default');
            $item.addClass('btn-danger');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

     allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='email'],input[type='select'],input[type='number'],select"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(".mandatory").removeAttr("hidden");
                $('.alert_massage').text('Provide all required fields to proceed next step'); 
                $('#alert_box').modal({backdrop: 'static',keyboard: false}); 
                
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid){
             $(".mandatory").attr("hidden","hidden");
            nextStepWizard.removeAttr('disabled').trigger('click');
        }
    });

    allPrevBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

        $(".form-group").removeClass("has-error");
        prevStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-danger').trigger('click');
});


$(document).ready(function () {

    $(".sslc_year").on("change", function(){
        var sslc_year = parseInt($(".sslc_year").val());

        var hsc_range1 = sslc_year + 2;

        var diploma_range1 = sslc_year + 3;

        $(".hsc_year option").each(function() {
        
        var thisOptionval = parseInt($(this).val());

        var $thisOption = $(this);
        
        if(thisOptionval < hsc_range1){

            $thisOption.attr("disabled", "disabled");
        }
        else{
             $thisOption.removeAttr("disabled");
        }
        
        });

        $(".diploma_year option").each(function() {
        
        var thisOptionval = parseInt($(this).val());

        var $thisOption = $(this);
        
        if(thisOptionval < diploma_range1){

            $thisOption.attr("disabled", "disabled");
        }
        else{
             $thisOption.removeAttr("disabled");
        }
        
        });
        
        

        $('.hsc_year').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
        $('.hsc_year').multiselect('refresh');

        $('.diploma_year').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
        $('.diploma_year').multiselect('refresh');

    });

    $(".hsc_year").on("change", function(){

        var hsc_year = parseInt($(".hsc_year").val());

        var diploma_range1 = hsc_year + 2;

        var ug_range1 = hsc_year + 2;

         $(".diploma_year option").each(function() {
        
        var thisOptionval = parseInt($(this).val());

        var $thisOption = $(this);
        
        if(thisOptionval < diploma_range1){

            $thisOption.attr("disabled", "disabled");
        }
        else{
             $thisOption.removeAttr("disabled");
        }
        
        });

         $(".ug_year option").each(function() {
        
        var thisOptionval = parseInt($(this).val());

        var $thisOption = $(this);
        
        if(thisOptionval < ug_range1){

            $thisOption.attr("disabled", "disabled");
        }
        else{
             $thisOption.removeAttr("disabled");
        }
        
        });

        
        $('.ug_year').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
        $('.ug_year').multiselect('refresh');

        $('.diploma_year').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
        $('.diploma_year').multiselect('refresh');
        
    });


    $(".diploma_year").on("change", function(){

        var diploma_year = parseInt($(".diploma_year").val());

        var ug_range1 = diploma_year + 2;

        $(".ug_year option").each(function() {
        
        var thisOptionval = parseInt($(this).val());

        var $thisOption = $(this);
        
        if(thisOptionval < ug_range1){

            $thisOption.attr("disabled", "disabled");
        }
        else{
             $thisOption.removeAttr("disabled");
        }
        
        });

        $('.ug_year').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
        $('.ug_year').multiselect('refresh');
        
    });

    $(".ug_year").on("change", function(){

        var ug_year = parseInt($(".ug_year").val());

        var pg_range1 = ug_year + 2;

        $(".pg_year option").each(function() {
        
        var thisOptionval = parseInt($(this).val());

        var $thisOption = $(this);
        
        if(thisOptionval < pg_range1){

            $thisOption.attr("disabled", "disabled");
        }
        else{
             $thisOption.removeAttr("disabled");
        }
        
        });

        $('.pg_year').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
        $('.pg_year').multiselect('refresh');
        
    });

});
