/*
 Sathish kumar.R
 */

$( document ).ready(function() {
    $.fn.extend({
    treed: function (o) {
      
      var openedClass = 'glyphicon-minus-sign';
      var closedClass = 'glyphicon-plus-sign';
      
      if (typeof o != 'undefined'){
        if (typeof o.openedClass != 'undefined'){
        openedClass = o.openedClass;
        }
        if (typeof o.closedClass != 'undefined'){
        closedClass = o.closedClass;
        }
      };
      
        //initialize each of the top levels
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this); //li with children ul
            branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this == e.target) {
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                }
            })
            branch.children().children().toggle();
        });
        //fire event from the dynamically added icon
      tree.find('.branch .indicator').each(function(){
        $(this).on('click', function () {
            $(this).closest('li').click();
        });
      });
        //fire event to open branch if the li contains an anchor instead of text
        tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
        //fire event to open branch if the li contains a button instead of text
        tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
    }
});

//Initialization of treeviews

$('#tree1').treed();

$('#tree2').treed();


});

$( document ).ready(function() {

    $( ".ug_degree" ).on('change', function(e) {

        $('.batch_type').val($( ".ug_degree :selected " ).attr('degreetype'));

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

                $('.ug_branch').append($("<option disabled selected  ></option>").attr("value","").text(" Select Branch "));

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
	
	
	
    $('[data-toggle="popover"]').popover({ 
        html : true, 
        content: function() {
          return $('#popover_content_wrapper').html();
        }
    });   
	
	$('body').on('click', function (e) {
    $('[data-toggle=popover]').each(function () {
        // hide any open popovers when the anywhere else in the body is clicked
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            $(this).popover('hide');
        }
    });
});

$("[data-toggle=popover]").mousedown(function(){
  // toggle popover when link is clicked
  $(this).popover('toggle');
   $('.link-popover').not(this).popover('hide');
});



    /* All External or Third party plugin call */

    $('.multiselect').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option'});
	$('.multiselectV').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the venue college'});
	$('.multiselectE').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the eligible college'});


    /* All Ajax calls */

    $( ".section_subject" ).on('change', function(e) {
        $.ajax({
            type	: 'POST',
            dataType: 'json',
            url		: '/index.php/get_chapter',
            data : {subject_id : $( ".section_subject").val()},

            success : function(response) {
                $('.subject_chapter').multiselect('destroy');$('.subject_chapter').empty();
                $.each(response, function(key,value) {
                    $('.subject_chapter').append($("<option></option>").attr("value",key).text(value));
                });
                $('.subject_chapter').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option'});
                $('.subject_chapter').multiselect('refresh');
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })
    });

    $(document).on('click', '.remove_this_option', function() {
        $(this).closest(".answer-option").fadeOut(300, function() { $(this).remove(); });

        $.ajax({
            type	: 'POST',
            dataType: 'json',
            url		: '/index.php/admin/delete_option',
            data : {qpqa_id :$(this).closest(".answer-option .input-group").children('input').val()} ,

            success : function(response) {

                alert(response);
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })

    });

    $(document).on('change', '.test_user_id', function() {
			var text = new Array();
			
			if ($('.getdegree').is(":checked")) {
				$.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/admin/get_degree',

            success : function(response) {
				
                $('.test_degree_id').removeAttr('disabled'); 

                $('.test_degree_id').multiselect('destroy');$('.test_degree_id').empty();

                $('.test_degree_id').append($("<option></option>").attr({value:'',selected:"selected",disabled:"disabled"}).text('Select Branch'));

                $('.test_degree_id').append($("<option></option>").attr("value",0).text('Any Degree'));


                if(typeof(response['diploma'][0]) != "undefined" && response['diploma'][0] !== null){

                    var group = $('<optgroup>',{label:"----- Diploma -----"});

                    $("<option/>",{value:30,text:"Polytechnic"}).appendTo(group);
                           
                    $('.test_degree_id').append(group);

                }

                if(typeof(response['ug'][0]) != "undefined" && response['ug'][0] !== null){

                    var group = $('<optgroup>',{label:"----- UG -----"});

                    $.each(response['ug'],function(key,val) {

                    $("<option/>",{value:val.id,text:val.name}).appendTo(group);

                    }); 
                           
                    $('.test_degree_id').append(group);
                    
                }

                if(typeof(response['pg'][0]) != "undefined" && response['pg'][0] !== null){

                    var group = $('<optgroup>',{label:"----- PG -----"});

                    $.each(response['pg'],function(key1,val1) {

                    $("<option/>",{value:val1.id,text:val1.name}).appendTo(group);

                    }); 
                           
                    $('.test_degree_id').append(group);
                    
                }

                $('.test_degree_id').next().children('button').removeClass('disabled').removeAttr('disabled'); 

                $('.test_degree_id').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option'});

                $('.test_degree_id').multiselect('refresh');
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })
			}
			else{
				$('.test_user_id :selected').each(function(i, selected){ 
			text[i] = $(selected).val(); 
		});
		
		$.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/admin/get_college_degree',
            data : {institution_id : text } ,

            success : function(response) {
				
                $('.test_degree_id').removeAttr('disabled'); 

                $('.test_degree_id').multiselect('destroy');$('.test_degree_id').empty();

                $('.test_degree_id').append($("<option></option>").attr({value:'',selected:"selected",disabled:"disabled"}).text('Select Branch'));

                $('.test_degree_id').append($("<option></option>").attr("value",0).text('Any Degree'));


                if(typeof(response['diploma'][0]) != "undefined" && response['diploma'][0] !== null){

                    var group = $('<optgroup>',{label:"----- Diploma -----"});

                    $("<option/>",{value:30,text:"Polytechnic"}).appendTo(group);
                           
                    $('.test_degree_id').append(group);

                }

                if(typeof(response['ug'][0]) != "undefined" && response['ug'][0] !== null){

                    var group = $('<optgroup>',{label:"----- UG -----"});

                    $.each(response['ug'],function(key,val) {

                    $("<option/>",{value:val.id,text:val.name}).appendTo(group);

                    }); 
                           
                    $('.test_degree_id').append(group);
                    
                }

                if(typeof(response['pg'][0]) != "undefined" && response['pg'][0] !== null){

                    var group = $('<optgroup>',{label:"----- PG -----"});

                    $.each(response['pg'],function(key1,val1) {

                    $("<option/>",{value:val1.id,text:val1.name}).appendTo(group);

                    }); 
                           
                    $('.test_degree_id').append(group);
                    
                }

                $('.test_degree_id').next().children('button').removeClass('disabled').removeAttr('disabled'); 

                $('.test_degree_id').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option'});

                $('.test_degree_id').multiselect('refresh');
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })

			}
	
		
    });
	
	$(document).on('click', '.getdegree', function() {
		if ($('.getdegree').is(":checked")) {
				$.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/admin/get_degree',

            success : function(response) {
				
                $('.test_degree_id').removeAttr('disabled'); 

                $('.test_degree_id').multiselect('destroy');$('.test_degree_id').empty();

                $('.test_degree_id').append($("<option></option>").attr({value:'',selected:"selected",disabled:"disabled"}).text('Select Branch'));

                $('.test_degree_id').append($("<option></option>").addClass("option_any").attr("value",0).text('Any Degree'));


                if(typeof(response['diploma'][0]) != "undefined" && response['diploma'][0] !== null){

                    var group = $('<optgroup>',{label:"----- Diploma -----"});

                    $("<option/>",{value:30,text:"Polytechnic"}).appendTo(group);
                           
                    $('.test_degree_id').append(group);

                }

                if(typeof(response['ug'][0]) != "undefined" && response['ug'][0] !== null){

                    var group = $('<optgroup>',{label:"----- UG -----"});

                    $.each(response['ug'],function(key,val) {

                    $("<option/>",{value:val.id,text:val.name}).appendTo(group);

                    }); 
                           
                    $('.test_degree_id').append(group);
                    
                }

                if(typeof(response['pg'][0]) != "undefined" && response['pg'][0] !== null){

                    var group = $('<optgroup>',{label:"----- PG -----"});

                    $.each(response['pg'],function(key1,val1) {

                    $("<option/>",{value:val1.id,text:val1.name}).appendTo(group);

                    }); 
                           
                    $('.test_degree_id').append(group);
                    
                }

                $('.test_degree_id').next().children('button').removeClass('disabled').removeAttr('disabled'); 

                $('.test_degree_id').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option'});

                $('.test_degree_id').multiselect('refresh');
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })
			}

    });

    $(document).on('change', '.test_degree_id', function() {

		if ($('.getdegree').is(":checked")) {
				$.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/admin/get_branch',
            data : {degree_id : $('.test_degree_id').val() } ,

            success : function(data) {


                $('.test_branch_id').removeAttr('disabled'); 

                $('.test_branch_id').multiselect('destroy');$('.test_branch_id').empty();

                $('.test_branch_id').append($("<option></option>").attr({value:'',selected:"selected",disabled:"disabled"}).text('Select Branch'));


                $.each(data[0], function (key, cat) {
                            var group = $('<optgroup>',{label:key});
                            
							
									
                            $.each(cat,function(key,value) {
                                $("<option/>",{value:key,text:value})
                                    .appendTo(group);
                            });
                            $('.test_branch_id').append(group);
                        });

                $('.test_branch_id').next().children('button').removeClass('disabled').removeAttr('disabled'); 

                $('.test_branch_id').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option'});

                $('.test_branch_id').multiselect('refresh');
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })

			}
			
			else{
				 if($('.test_degree_id').find('.option_any').is(':selected') && $('.test_degree_id :selected').length > 2){

            $('.alert_massage').text("Please remove Any Degree Option");
			$('#alert_box').modal({backdrop: 'static',keyboard: false}); 

            $('.test_degree_id').val('-1');

             $('.test_degree_id').multiselect('refresh');
        
        }


        $.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/admin/get_college_branch',
            data : {institution_id : $('.test_user_id').val(),degree_id : $('.test_degree_id').val() } ,

            success : function(data) {


                $('.test_branch_id').removeAttr('disabled'); 

                $('.test_branch_id').multiselect('destroy');$('.test_branch_id').empty();

                $('.test_branch_id').append($("<option></option>").attr({value:'',selected:"selected",disabled:"disabled"}).text('Select Branch'));


                $.each(data[0], function (key, cat) {
                            var group = $('<optgroup>',{label:key});
                            
							
									
                            $.each(cat,function(key,value) {
                                $("<option/>",{value:key,text:value})
                                    .appendTo(group);
                            });
                            $('.test_branch_id').append(group);
                        });

                $('.test_branch_id').next().children('button').removeClass('disabled').removeAttr('disabled'); 

                $('.test_branch_id').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option'});

                $('.test_branch_id').multiselect('refresh');
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })

			}
		
       
    });


     $(document).on('change', '.ug_degree_id', function() {

        $.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/admin/get_degree_branch',
            data : { degree_id : $('.ug_degree_id').val() } ,

            success : function(data) {

                $('.ug_branch_id').removeAttr('disabled'); 

                $('.ug_branch_id').multiselect('destroy');$('.ug_branch_id').empty();

                $('.ug_branch_id').append($("<option></option>").attr({value:'',selected:"selected",disabled:"disabled"}).text('Select Branch'));


                $.each(data[0], function(key,value) {
                            $('.ug_branch_id').append($("<option></option>").attr("value",key).text(value));
                        });

                $('.ug_branch_id').next().children('button').removeClass('disabled').removeAttr('disabled'); 

                $('.ug_branch_id').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option'});

                $('.ug_branch_id').multiselect('refresh');
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })

    });

     $(document).on('change', '.pg_degree_id', function() {

        $.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/admin/get_degree_branch',
            data : { degree_id : $('.pg_degree_id').val() } ,

            success : function(data) {

                $('.pg_branch_id').removeAttr('disabled'); 

                $('.pg_branch_id').multiselect('destroy');$('.pg_branch_id').empty();

                $('.pg_branch_id').append($("<option></option>").attr({value:'',selected:"selected",disabled:"disabled"}).text('Select Branch'));


                $.each(data[0], function(key,value) {
                            $('.pg_branch_id').append($("<option></option>").attr("value",key).text(value));
                        });

                $('.pg_branch_id').next().children('button').removeClass('disabled').removeAttr('disabled'); 

                $('.pg_branch_id').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option'});

                $('.pg_branch_id').multiselect('refresh');
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })

    });



    $(document).on('change', '.test_branch_id', function() {


        if($('.test_branch_id').find('.option_any').is(':selected') && $('.test_branch_id :selected').length > 2){
        
            $('.alert_massage').text("Please remove Any Branch Option");
			$('#alert_box').modal({backdrop: 'static',keyboard: false}); 

            $('.test_branch_id').val('-1');

             $('.test_branch_id').multiselect('refresh');
        
        }

        });



    $(document).on('click', '.end_test', function() {
		
        $.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/college/endtest',
            data : { test_id : $(this).attr("value") } ,

            success : function(response) {

				$('.alert_massage').text(response);
                
                $('#confirmation_modal').hide();
                $('#alert_box').modal({backdrop: 'static',keyboard: false}); 
                
                $('#alert_box').on('hidden.bs.modal', function () {
                    location.reload();
                }); 
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })

    });
	
	$(document).on('click', '.delete_test_id', function() {
        
        $.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/college/delete_test', 
            data : { test_id : $(this).attr("value") } ,

            success : function(response) {
                
                $('.alert_massage').text(response);
                
                $('#confirmation_modal').hide();
                $('#alert_box').modal({backdrop: 'static',keyboard: false}); 
                
                $('#alert_box').on('hidden.bs.modal', function () {
                    location.reload();
                }); 
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })

    });

    $(document).on('click', '.starttest', function() {
		
        $.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/college/starttest', 
            data : { test_id : $(this).attr("value") } ,

            success : function(response) {
				
				$('.alert_massage').text(response);
				
				$('#confirmation_modal').hide();
				$('#alert_box').modal({backdrop: 'static',keyboard: false}); 
				
                $('#alert_box').on('hidden.bs.modal', function () {
					location.reload();
				}); 
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })

    });


    $(document).on('click', '.reappear', function() {
       
        $.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/college/reappear_student',
            data    :  $('.reappear_form').serialize(),

            success : function(response) {

                $('.return_message').html(response);
				$('.feedback_form').hide();$('#Reappear_modal').hide();
				$('.reload_button').show();
				$('#admin_feedback').modal('show'); 
				
				$('#admin_feedback').on('hidden.bs.modal', function () {
					location.reload();
				});

            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })

    });

     $(document).on('click', '.next_url', function(){

        
        $('.next_url').attr("disabled","disabled");
		
		$('.test_submit').attr("disabled","disabled");
		
          var current_time = $('.duration').val();
          var next_url = $(this).val();
          var test_id = $('.test_id').val();
          var time_remaining = $('.duration').val();
          var user_id = $('.user_id').val();
          var logouturl= '/index.php/test/logout/'+test_id;  
          

        $.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/admin/update_remaining_time',
            data : { user_id : user_id , test_id : test_id , time_remaining : time_remaining   } ,

            success : function(response) {
                
                $(window).unbind('beforeunload');
                window.location.href = next_url;

            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })         

    });

    $(document).on('click', '.check_btn', function() {
        $('.progress1').show();
        $.ajax({
            type	: 'POST',
            dataType: 'json',
            url		: '/index.php/college/check_questionpaper',
            data : {qp_id :$('.qpaper_id').val()} ,

            success : function(response) {
                $('.progress1').hide();

                if(response == 'Failed'){
                    $('.error_details_container').show();
                    $('.question_details_container').hide();
                    $('.note_div').hide();
                    $('.qpaper_id').val('');
                    $('.submit_btn').prop('disabled','disabled');
                }
                else{
                    $('.qn_title').html(response[0].title);

                    var t = response[0].created_on.split(/[- :]/);

                    var date = new Date(t[0], t[1]-1, t[2], t[3] ,t[4] ,t[5]);

                    $('.qn_created').html(date.toLocaleString());

                    $('.number_of_questions').val(response[0].number_of_questions);
                    $('.total_marks').val(response[0].total_marks);
                    $('.duration').val(response[0].duration);
                    $(".is_negative[value="+response[0].is_negative+"]").prop( "checked", true );

                    $('.question_details_container').show();
                    $('.note_div').show();
                    $('.error_details_container').hide();
                    $('.submit_btn').removeAttr('disabled');
                }


            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })
    });

    /**/

    /* Form validations */

    $('#createquestion_paper').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            title: {
                validators: {
                    notEmpty: {
                        message: "QuestionPaper Title is required and can't be empty"
                    },
                    stringLength: {
                        min: 3,max: 128,message: 'QuestionPaper Title should range between 3 to 128 characters'
                    }
                }
            },
            terms_conditions: {
                validators: {

                    stringLength: {
                       max: 1000,message: 'Instruction should not exceed 1000 characters'
                    }
                }
            },
            number_of_questions: {
                validators: {
                    notEmpty:{message: ' '}
                }
            },
            total_marks: {
                validators: {
                    notEmpty:{message: ' '}
                }
            },
            duration: {
                validators: {
                    notEmpty:{message: ' '}
                }
            }
        }
    });

    $('#create_sections')
        .find('[name="section_subject"]')
        .multiselect({
            onChange: function(element, checked) {
                $('#multiselectForm').formValidation('revalidateField', 'section_subject');

                adjustByScrollHeight();
            },
            onDropdownShown: function(e) {
                adjustByScrollHeight();
            },
            onDropdownHidden: function(e) {
                adjustByHeight();
            }
        })
        .end()
        .bootstrapValidator({
        ignore: ":hidden",
        excluded: ':disabled',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {

            terms_conditions: {
                validators: {

                    stringLength: {
                        max: 1000,message: 'Instruction should not exceed 1000 characters'
                    }
                }
            },

            section_hint: {
                validators: {

                    stringLength: {
                        min: 10,message: 'Hints should not be less than 10 characters'
                    }
                }
            },

            section_type: {
                validators: {
                    notEmpty: {
                        message: "Division type is required and can't be empty"
                    }
                }
            },
            section_subject: {
                validators: {
                    notEmpty:{message: 'Subject is required and cant be empty'}
                }
            },
            number_of_questions_section: {
                validators: {
                    notEmpty:{message: 'Number of question is required'},
                    lessThan: {
                        message: 'Questions exceeds maximum total questions'
                    }
                }
            },
            marks_per_question: {
                validators: {
                    notEmpty: {
                        message: 'Mark is required and cant be empty'
                    }
                }
            }

        }

    });

    $('#edit_sections')
        .find('[name="section_subject"]')
        .multiselect({
            onChange: function(element, checked) {
                $('#multiselectForm').formValidation('revalidateField', 'section_subject');

                adjustByScrollHeight();
            },
            onDropdownShown: function(e) {
                adjustByScrollHeight();
            },
            onDropdownHidden: function(e) {
                adjustByHeight();
            }
        })
        .end()
        .bootstrapValidator({
            ignore: ":hidden",
        excluded: ':disabled',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {

            terms_conditions: {
                validators: {

                    stringLength: {
                        max: 1000,message: 'Instruction should not exceed 1000 characters'
                    }
                }
            },

             section_hint: {
                validators: {

                    stringLength: {
                        min: 10,message: 'Hints should not be less than 10 characters'
                    }
                }
            },

            section_type: {
                validators: {
                    notEmpty: {
                        message: "Division type is required and can't be empty"
                    }
                }
            },
            section_subject: {
                validators: {
                    notEmpty:{message: 'Subject is required and cant be empty'}
                }
            },
            number_of_questions_section: {
                validators: {
                    lessThan: {
                        message: 'Questions exceeds maximum total questions'
                    }
                }
            }
        }
    });

        $('#testlogin').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            id: {
                validators: {
                    notEmpty: {
                        message: "Test id is required and can't be empty "
                    }
                }
            }
        }
    });
		
		
     /*$( '#Date_of_Birth' ).datepicker({
		  yearRange: '1910:2010' ,
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true
    });*/  
	
	
        $('.submit_signup').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            first_name: {
                validators: {
                    notEmpty: {
                        message: "First Name is required and can't be empty "
                    },
                    regexp: {
                        regexp: '^[a-zA-Z 0-9\.\,\+\-]*$',
                        message: "First Name can't accept special characters"
                    },
                    stringLength: {
                        min: 3,
                        message: 'Minimum 3 characters required'
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
                        format: 'YYYY-MM-DD',
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
            SSLC_institution: {
                validators: {
                    notEmpty: {
                        message: "School Name is required and can't be empty "
                    },
                    regexp: {
                        regexp: '^[a-zA-Z 0-9\.\,\+\-\@\&]*$',
                        message: "School Name can't accept special characters"
                    },
                    stringLength: {
                        min: 3,
                        message: 'Minimum 3 characters required'
                    }
                }
            },
            SSLC_percentage: {
                validators: {
                    notEmpty: {
                        message: "Marks field is required and can't be empty "
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
            HSC_institution: {
                validators: {
                    notEmpty: {
                        message: "School Name is required and can't be empty "
                    },
                    regexp: {
                        regexp: '^[a-zA-Z 0-9\.\,\+\-\@\&]*$',
                        message: "School Name can't accept special characters"
                    },
                    stringLength: {
                        min: 3,
                        message: 'Minimum 3 characters required'
                    }
                }
            },
            HSC_percentage: {
                validators: {
                    notEmpty: {
                        message: "Marks field is required and can't be empty "
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
            diploma1_institution: {
                validators: {
                    notEmpty: {
                        message: "College Name is required and can't be empty "
                    },
                    regexp: {
                        regexp: '^[a-zA-Z 0-9\.\,\+\-\@\&]*$',
                        message: "College Name can't accept special characters"
                    },
                    stringLength: {
                        min: 3,
                        message: 'Minimum 3 characters required'
                    }
                }
            },
            diploma1_percentage: {
                validators: {
                    notEmpty: {
                        message: "Marks field is required and can't be empty "
                    }
                }
            },
            UG1_institution: {
                validators: {
                    notEmpty: {
                        message: "College Name is required and can't be empty "
                    },
                    regexp: {
                        regexp: '^[a-zA-Z 0-9\.\,\+\-\@\&]*$',
                        message: "College Name can't accept special characters"
                    },
                    stringLength: {
                        min: 3,
                        message: 'Minimum 3 characters required'
                    }
                }
            },
            UG1_percentage: {
                validators: {
                    notEmpty: {
                        message: "Marks field is required and can't be empty "
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
            PG1_institution: {
                validators: {
                    notEmpty: {
                        message: "College Name is required and can't be empty "
                    },
                    regexp: {
                        regexp: '^[a-zA-Z 0-9\.\,\+\-\@\&]*$',
                        message: "College Name can't accept special characters"
                    },
                    stringLength: {
                        min: 3,
                        message: 'Minimum 3 characters required'
                    }
                }
            },
            PG1_percentage: {
                validators: {
                    notEmpty: {
                        message: "Marks field is required and can't be empty "
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

	 $('#createbatch')
        .find('[name="section_subject"]')
        .multiselect({
            onChange: function(element, checked) {
                $('#multiselectForm').formValidation('revalidateField', 'section_subject');

                adjustByScrollHeight();
            },
            onDropdownShown: function(e) {
                adjustByScrollHeight();
            },
            onDropdownHidden: function(e) {
                adjustByHeight();
            }
        })
        .end()
        .bootstrapValidator({
            ignore: ":hidden",
        excluded: ':disabled',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            batch_degree: {
                validators: {
                    notEmpty: {
                        message: "Degree is required "
                    }
                }
            },
            batch_branch: {
                validators: {
                    notEmpty: {
                        message: "Branch is required "
                    }
                }
            },
            batch_year: {
                validators: {
                    notEmpty: {
                        message: "Year of joining is required "
                    }
                }
            },
            batch_year_to: {
                validators: {
                    notEmpty: {
                        message: "Year of leaving is required "
                    }
                }
            },
            student_count: {
                validators: {
                    notEmpty: {
                        message: "Class Strength is required "
                    }

                }
            },
            hod_name: {
                validators: {
                    
                    regexp: {
                        regexp: '^[a-zA-Z 0-9\.\,\+\-]*$',
                        message: "HOD Name can't accept special characters"
                    },
                    stringLength: {
                        min: 3,
                        message: 'Minimum 3 characters required'
                    }
                }
            },
            hod_email: {
                validators: {
                    
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
            hod_mobile: {
                validators: {
                    
                    regexp: {
                        regexp: '^([0|\+[0-9]{1,5})?([7-9][0-9]{9})$',
                        message: 'Enter valid mobile number' 
                    }
                }
            },
            class_teacher_name: {
                validators: {
                    
                    regexp: {
                        regexp: '^[a-zA-Z 0-9\.\,\+\-]*$',
                        message: "Class teacher Name can't accept special characters"
                    },
                    stringLength: {
                        min: 3,
                        message: 'Minimum 3 characters required'
                    }
                }
            },
            class_teacher_email: {
                validators: {
                    
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
            class_teacher_mobile: {
                validators: {
                    
                    regexp: {
                        regexp: '^([0|\+[0-9]{1,5})?([7-9][0-9]{9})$',
                        message: 'Enter valid mobile number' 
                    }
                }
            },
            rep_name: {
                validators: {
                    
                    regexp: {
                        regexp: '^[a-zA-Z 0-9\.\,\+\-]*$',
                        message: "Class Leader Name can't accept special characters"
                    },
                    stringLength: {
                        min: 3,
                        message: 'Minimum 3 characters required'
                    }
                }
            },
            rep_email: {
                validators: {
                    
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
            rep_mobile: {
                validators: {
                    
                    regexp: {
                        regexp: '^([0|\+[0-9]{1,5})?([7-9][0-9]{9})$',
                        message: 'Enter valid mobile number' 
                    }
                }
            }
        }
    });

    /* Other internal Jquery calls */

    $( ".marks_per_question" ).on('keyup mouseup', function(e) {
        var a = $( ".number_of_questions_section").val();
        var b = $( ".marks_per_question").val();

        $( ".section_total").val(a*b).trigger('change');

        var c = $( ".question_remaining").val();
        var d = parseInt(c)-parseInt(a);

        var count = parseInt($( ".section_count").val());

        if(d=='0' && count != '0'){
            $('.btn1').fadeOut(300);
        }else{
            $('.btn1').fadeIn(300);
        }

	});

    $( ".number_of_questions_section" ).on('keyup mouseup', function(e) {
        var a = $( ".number_of_questions_section").val();
        var b = $( ".marks_per_question").val();

            $( ".section_total").val(a*b).trigger('change');

        var c = $( ".question_remaining").val();
        var d = parseInt(c)-parseInt(a);

        var count = parseInt($( ".section_count").val());

        if(d=='0' && count != '0'){
            $('.btn1').fadeOut(300);
        }else{
            $('.btn1').fadeIn(300);
        }

    });

    $(document).on('change', '.section_total', function(){

        var a = ($( ".section_total").val());
        var b = ($( ".max_remaining").val());

        if(parseInt(a)>parseInt(b)){
            $('.alert_massage').text('Section mark exceeds maximum total marks');
			$('#alert_box').modal({backdrop: 'static',keyboard: false}); 
			
            $( ".section_total").val('');
        }
    });

    $( ".delete_section_href" ).on('click', function(e) {
        $( ".section_id").val(this.id);
    });
	
	$( ".finishtest" ).on('click', function(e) {
       $('#myModal').modal('toggle');
    });

    $('input:checkbox.question_type').click(function(){
        if($(this).attr("value")=="1"){
            $(".question_text").toggle();
        }
        if($(this).attr("value")=="2"){
            $(".question_image").toggle();
        }
    });

    $('input:checkbox.answer_option_type1').change(function(){
        if($(this).attr("value") == 2)
        if ($('.btn_option1').attr('disabled')) {
            $('.btn_option1').removeAttr('disabled');
        } else {
            $('.btn_option1').attr('disabled','disabled');
        }
    });

    $('input:checkbox.answer_option_type2').change(function(){
        if($(this).attr("value") == 2)
            if ($('.btn_option2').attr('disabled')) {
                $('.btn_option2').removeAttr('disabled');
            } else {
                $('.btn_option2').attr('disabled','disabled');
            }
    });

    $('.answer_type').change(function(){
        if($('.answer_type').val()==1){
            $(".answer_type1").show();$(".answer_type2").hide();$(".answer_type3").hide();$(".answer_type4").hide();
        }
        if($('.answer_type').val()==2){
            $(".answer_type2").show();$(".answer_type1").hide();$(".answer_type3").hide();$(".answer_type4").hide();
        }
        if($('.answer_type').val()==3){
            $(".answer_type3").show();$(".answer_type1").hide();$(".answer_type2").hide();$(".answer_type4").hide();
        }
        if($('.answer_type').val()==4){
            $(".answer_type4").show();$(".answer_type2").hide();$(".answer_type3").hide();$(".answer_type1").hide();
        }
    });

    $('.append_option_for1').click(function(){
        var values = new Array();
        $("input[name='option_is_correct[]']").each( function () {
            values.push($(this).val());
        });

        var option_value = Math.max.apply(Math,values)+1;
        var div_name = 'new-answer-option'+option_value;

        var type=$('.answer_option_type1:checked').length;

        if(type == 2){
            $('.multiple-choice-options').append('<div class="answer-option '+ div_name +'"> <div class="col-xs-12 option_margin_bottom"><center> <div class="option_image_view option_margin_bottom" hidden> <img src="" name="option_image_file" class="option_image_file" width="150px" height="150px"> </div><span class="remove_option_image" hidden><a href="javascript:void(0)" class="href1 remove_option_image_file "><span class="glyphicon glyphicon-minus-sign"></span> Remove Image</a></span> </center> <div class="input-group"> <span class="input-group-btn"> <input name="option_is_correct[]" class="option_is_correct" value= '+ option_value +' type="checkbox"> </span> <span class="input-group-btn file_btn option_image1"> <span class="btn btn2 btn-file btn_option1 btn_file_margin">Browse option image <input type="file" name="option_image[]"  class="option_image_url"> </span> </span> <textarea name="option_text[]" required cols="40" rows="10" class="form-control answer-option1" placeholder="Option text"></textarea> <span class="input-group-btn"> <span class="btn btn-danger remove_this_option"> <span class="glyphicon glyphicon-remove"></span> </span> </span> </div> </div> </div>');
        }
        else{
            $('.multiple-choice-options').append('<div class="answer-option ' + div_name + '"> <div class="col-xs-12 option_margin_bottom"><center> <div class="option_image_view option_margin_bottom" hidden> <img src="" name="option_image_file" class="option_image_file" width="150px" height="150px"> </div> <span class="remove_option_image" hidden><a href="javascript:void(0)" class="href1 remove_option_image_file"><span class="glyphicon glyphicon-minus-sign"></span> Remove Image</a></span></center> <div class="input-group"> <span class="input-group-btn"> <input name="option_is_correct[]" class="option_is_correct" value= ' + option_value + ' type="checkbox"> </span> <span class="input-group-btn file_btn option_image1"> <span class="btn btn2 btn-file btn_option1 btn_file_margin" disabled>Browse option image <input type="file" name="option_image[]"  class="option_image_url"> </span> </span> <textarea name="option_text[]" required cols="40" rows="10" class="form-control answer-option1" placeholder="Option text"></textarea> <span class="input-group-btn"> <span class="btn btn-danger remove_this_option"> <span class="glyphicon glyphicon-remove"></span> </span> </span> </div> </div> </div>');
        }

    });

    $('.append_update_option_for1').click(function(){

        var values = new Array();
        $("input[name='option_is_correct[]']").each( function () {
            values.push($(this).val());
        });

        var option_value = Math.max.apply(Math,values)+1;
        var div_name = 'new-answer-option'+option_value;

        var type=$('.answer_option_type1:checked').length;

        if(type == 2){
            $('.multiple-choice-options').append('<div class="answer-option '+ div_name +'"> <div class="col-xs-12 option_margin_bottom"><center> <div class="option_image_view option_margin_bottom" hidden> <img src="" name="option_image_file" class="option_image_file" width="150px" height="150px"> </div><span class="remove_option_image" hidden><a href="javascript:void(0)" class="href1 remove_option_image_file "><span class="glyphicon glyphicon-minus-sign"></span> Remove Image</a></span> </center> <div class="input-group"> <span class="input-group-btn"> <input name="option_is_correct[]" class="option_is_correct" value= '+ option_value +' type="checkbox"> </span> <span class="input-group-btn file_btn option_image1"> <span class="btn btn2 btn-file btn_option1 btn_file_margin">Browse option image <input type="file" name="option_image[]"  class="option_image_url"> </span> </span> <textarea name="option_text[]" required cols="40" rows="10" class="form-control answer-option1" placeholder="Option text"></textarea> <span class="input-group-btn"> <span class="btn btn-danger remove_this_option"> <span class="glyphicon glyphicon-remove"></span> </span> </span> </div> </div> </div>');
        }
        else{
            $('.multiple-choice-options').append('<div class="answer-option ' + div_name + '"> <div class="col-xs-12 option_margin_bottom"><center> <div class="option_image_view option_margin_bottom" hidden> <img src="" name="option_image_file" class="option_image_file" width="150px" height="150px"> </div> <span class="remove_option_image" hidden><a href="javascript:void(0)" class="href1 remove_option_image_file"><span class="glyphicon glyphicon-minus-sign"></span> Remove Image</a></span></center> <div class="input-group"> <span class="input-group-btn"> <input name="option_is_correct[]" class="option_is_correct" value= ' + option_value + ' type="checkbox"> </span> <span class="input-group-btn file_btn option_image1"> <span class="btn btn2 btn-file btn_option1 btn_file_margin" disabled>Browse option image <input type="file" name="option_image[]"  class="option_image_url"> </span> </span> <textarea name="option_text[]" required cols="40" rows="10" class="form-control answer-option1" placeholder="Option text"></textarea> <span class="input-group-btn"> <span class="btn btn-danger remove_this_option"> <span class="glyphicon glyphicon-remove"></span> </span> </span> </div> </div> </div>');
        }

    });

    $('.remove_option_for1').click(function(){
        var values = new Array();
        $("input[name='option_is_correct[]']").each( function () {
            values.push($(this).val());
        });

        var option_value = Math.max.apply(Math,values);

        if(option_value == 1){$('.alert_massage').text("Question should contain atleast 2 option");
		$('#alert_box').modal({backdrop: 'static',keyboard: false}); }
        else{
        var div_name = '.new-answer-option'+option_value;

        $(div_name).remove();}
    });

    $('.append_option_for2').click(function(){
        var values = new Array();
        $("input[name='option_is_correct[]']").each( function () {
            values.push($(this).val());
        });

        var option_value = Math.max.apply(Math,values)+1;
        var div_name = 'new-answer-choice'+option_value;

        var type=$('.answer_option_type2:checked').length;

        if(type == 1) {
            $('.choose-the-best').append('<div class="answer-option  '+ div_name +'"> <div class="col-xs-12 option_margin_bottom"> <center> <div class="option_image_view option_margin_bottom" hidden> <img src="" name="option_image_file" class="option_image_file" width="150px" height="150px"> </div> </center><div class="input-group"> <span class="input-group-btn"> <input name="option_is_correct[]" class="option_is_correct" value='+ option_value +' type="radio"> </span> <span class="input-group-btn" > <span class="btn btn2 btn-file btn_option2 btn_file_margin" disabled>Browse option image <input type="file"  name="option_image[]"  class="option_image_url"> </span> </span> <textarea name="option_text[]" required cols="40" rows="10" class="form-control answer-option1" placeholder="Option text"></textarea> <span class="input-group-btn"> <span class="btn btn-danger remove_this_option"> <span class="glyphicon glyphicon-remove"></span> </span> </span> </div> </div> </div>');
        }
        else{
            $('.choose-the-best').append('<div class="answer-option  '+ div_name +'"> <div class="col-xs-12 option_margin_bottom"> <center> <div class="option_image_view option_margin_bottom" hidden> <img src="" name="option_image_file" class="option_image_file" width="150px" height="150px"> </div> </center><div class="input-group"> <span class="input-group-btn"> <input name="option_is_correct[]" class="option_is_correct" value='+ option_value +' type="radio"> </span> <span class="input-group-btn" > <span class="btn btn2 btn-file btn_option2 btn_file_margin">Browse option image <input type="file"  name="option_image[]"  class="option_image_url"> </span> </span> <textarea name="option_text[]" required cols="40" rows="10" class="form-control answer-option1" placeholder="Option text"></textarea> <span class="input-group-btn"> <span class="btn btn-danger remove_this_option"> <span class="glyphicon glyphicon-remove"></span> </span> </span> </div> </div> </div>');
        }


    });

    $('.remove_option_for2').click(function(){
        var values = new Array();
        $("input[name='option_is_correct[]']").each( function () {
            values.push($(this).val());
        });

        var option_value = Math.max.apply(Math,values);

        if(option_value == 1){$('.alert_massage').text("Question should contain atleast 2 option");$('#alert_box').modal({backdrop: 'static',keyboard: false}); }
        else{
            var div_name = '.new-answer-choice'+option_value;
            $(div_name).remove();
        }

    });

    $('.append_option_for4').click(function(){
        var values = new Array();
        $("input[name='option_is_correct[]']").each( function () {
            values.push($(this).val());
        });

        var option_value = Math.max.apply(Math,values)+1;
        var div_name = 'new-answer-choice'+option_value;

        $('.fill_in_the_blanks').append('<div class="answer-option"><div class="col-xs-12 option_margin_bottom"> <div class="input-group"> <span class="input-group-btn"> <input name="option_is_correct[]" class="option_is_correct" value="0" type="checkbox" checked disabled> </span> <textarea name="option_text[]" required cols="40" rows="10" class="form-control answer-option1"></textarea> <span class="input-group-btn"> <span class="btn btn-danger remove_this_option"> <span class="glyphicon glyphicon-remove"></span> </span> </span> </div> </div> </div>');
    });

    $('.remove_option_for4').click(function(){
        var values = new Array();
        $("input[name='option_is_correct[]']").each( function () {
            values.push($(this).val());
        });

        var option_value = Math.max.apply(Math,values);
        if(option_value == 1){$('.alert_massage').text("Cant remove default option");
		$('#alert_box').modal({backdrop: 'static',keyboard: false}); }
        var div_name = '.new-answer-choice'+option_value;

        $(div_name).remove();

    });

    $(".remove_question_image_file").click(function (){
        $("input:file[name='question_image']").val('');
        $(".question_image_file").removeAttr("src");
        $(".question_image_view").hide();
    });

    $(document).on('change', '.option_image_url', function(){
        var input =this;
        $(input).parent().parent().parent().parent().find('.option_image_view').show();
        $(input).parent().parent().parent().parent().find('.remove_option_image').show();

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(input).parent().parent().parent().parent().find('.option_image_file').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
    });
	
	$(document).on('change' , '.terms' , function(){

    if(this.checked) {
        $(".terms_btn").removeAttr('disabled');
    }
	else{
		$(".terms_btn").attr('disabled','disabled');
	}

	});

    $(document).on('click', '.remove_option_image', function(){
        $(this).hide();
        $(this).siblings().hide().children('.option_image_file').removeAttr("src");
        $(this).parent().siblings().children('.file_btn option_image1').children().children().val('');

    });

    $(document).on('click', '.close_window', function(){
        window.opener = self;
        window.close();
    });

    $(document).on('click', '.test_submit', function(){
        $(this).attr("disabled","disabled");
		 $('.next_url').attr("disabled","disabled");
        $('.submit_question_form').submit();
    });

    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    $(document).on('change', '.section_type', function() {

    if($('.section_type:checked').val()==2){
        $('.comp_container').show();
    }else{
        $('.comp_container').hide();
    }
    });

    $(".remove_section_image").click(function (){
        if($('.section_type:checked').val()==1){
            $('.comp_container').remove();
        }
    });

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.question_image_file').attr('src', e.target.result);
                $('.question_image_view').show();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("input:file[name='question_image']").change(function (){
        readURL(this);
    });

    $(".submit_btn").click(function (){

       if($(".answer_type").val() == 1){
           
           if(!$('.option_is_correct:checked').val()){
               $('.alert_massage').text("Please choose atleast one option to submit");
			   $('#alert_box').modal({backdrop: 'static',keyboard: false}); 
			   return false;exit;
           }
           if($('.answer_option_type1:checked').length != 2){
                $(".option_image1").remove();
           }
           $(".answer_type2").remove();$(".answer_type3").remove();$(".answer_type4").remove();
       }
       else if($(".answer_type").val() == 2){

          
           if(!$('.option_is_correct:checked').val()){
               $('.alert_massage').text("Please choose atleast one option to submit");
			   $('#alert_box').modal({backdrop: 'static',keyboard: false}); return false;exit;
           }
           if($('.answer_option_type2:checked').length != 2){
               $(".option_image2").remove();
           }
            $(".answer_type1").remove();$(".answer_type3").remove();$(".answer_type4").remove();
       }
        else if($(".answer_type").val() == 3){
           
           if(!$('.option_is_correct:checked').val()){
               $('.alert_massage').text("Please choose atleast one option to submit");
			   $('#alert_box').modal({backdrop: 'static',keyboard: false}); return false;exit;
           }
           $(".answer_type1").remove();$(".answer_type2").remove();$(".answer_type4").remove();
       }
        else if($(".answer_type").val() == 4){
           
           if(!$('.option_is_correct:checked').val()){
               $('.alert_massage').text("Please choose atleast one option to submit");
			   $('#alert_box').modal({backdrop: 'static',keyboard: false}); return false;exit;
           }
           $(".answer_type1").remove();$(".answer_type2").remove();$(".answer_type3").remove();
       }

    });


    $(".change_question_id").click(function (){
        if( parseInt($(".change_question_id:checked").length)){
            $(".check_btn").removeAttr('disabled');
            $(".submit_btn").attr('disabled','disabled');
        }else{
            location.reload();
        }
    });


});

$(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');
        allPrevBtn = $('.prevBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='select'],input[type='number'],select,select"),
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

            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a"),
            
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
});


$(document).ready(function () {


   
	$(".hsc").on("click", function(){ 
	
			var curStep = $(this).next(".setup-content");
         
			var sslc_year = $('.SSLC_year_of_completion').val();
			var hsc_year = $('.HSC_year_of_completion').val();
			var diploma_year = $('.diploma1_year_of_completion').val();
			var ug_year = $('.UG1_year_of_completion').val();
			var pg_year = $('.PG1_year_of_completion').val();
			
			var difference1 =  hsc_year - sslc_year;
			var difference2 =  diploma_year - hsc_year;
			var difference3 =  ug_year - hsc_year;
			
			if(sslc_year && difference1 < 2){
				$('.alert_massage').text("Minimum 2 year  difference is required between  SSLC & HSC year of passing");
				$('#alert_box').modal({backdrop: 'static',keyboard: false});
				
				var curStep = $(this).closest(".setup-content");
			
			var curStepBtn = curStep.attr("id");
			
            var nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().children("a");
			
			nextStepWizard.removeAttr('disabled').trigger('click');
			}
			
		
			
    });

	$(".diploma").on("click", function(){ 	
			var sslc_year = $('.SSLC_year_of_completion').val();
			var hsc_year = $('.HSC_year_of_completion').val();
			var diploma_year = $('.diploma1_year_of_completion').val();
			var ug_year = $('.UG1_year_of_completion').val();
			var pg_year = $('.PG1_year_of_completion').val();
			
			var difference1 =  diploma_year - sslc_year;
			var difference2 =  diploma_year - hsc_year;
			var difference3 =  ug_year - diploma_year;
			
			if(sslc_year && difference1 < 3){
				$('.alert_massage').text("Minimum 3 year  difference is required between  SSLC & Diploma year of passing");
				$('#alert_box').modal({backdrop: 'static',keyboard: false});
				
				var curStep = $(this).closest(".setup-content");
			
			var curStepBtn = curStep.attr("id");
			
            var nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().children("a");
			
			nextStepWizard.removeAttr('disabled').trigger('click');
			}
			if(hsc_year && difference2 < 2){
				$('.alert_massage').text("Minimum 2 year  difference is required between  HSC & Diploma year of passing");
				$('#alert_box').modal({backdrop: 'static',keyboard: false});
				
				var curStep = $(this).closest(".setup-content");
			
			var curStepBtn = curStep.attr("id");
			
            var nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().children("a");
			
			nextStepWizard.removeAttr('disabled').trigger('click');
			}
			
			
    });	
	
	$(".ug").on("click", function(){ 
			var sslc_year = $('.SSLC_year_of_completion').val();
			var hsc_year = $('.HSC_year_of_completion').val();
			var diploma_year = $('.diploma1_year_of_completion').val();
			var ug_year = $('.UG1_year_of_completion').val();
			var pg_year = $('.PG1_year_of_completion').val();
			
			var difference1 =  ug_year - diploma_year;
			var difference2 =  pg_year - ug_year;
			var difference3 =  ug_year - hsc_year;
			
			if(diploma_year && difference1 < 2){
				$('.alert_massage').text("Minimum 2 year  difference is required between  Diploma & UG  year of passing");
				$('#alert_box').modal({backdrop: 'static',keyboard: false});
				
				var curStep = $(this).closest(".setup-content");
			
			var curStepBtn = curStep.attr("id");
			
            var nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().children("a");
			
			nextStepWizard.removeAttr('disabled').trigger('click');
			}
			
			if(hsc_year && difference3 < 3){
				$('.alert_massage').text("Minimum 3 year  difference is required between  HSC & UG year of passing");
				$('#alert_box').modal({backdrop: 'static',keyboard: false});
						
			var curStep = $(this).closest(".setup-content");
			
			var curStepBtn = curStep.attr("id");
			
            var nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().children("a");
			
			nextStepWizard.removeAttr('disabled').trigger('click');
			}		
			
		
			
    });	
	
	$(".pg").on("click", function(){ 
			var sslc_year = $('.SSLC_year_of_completion').val();
			var hsc_year = $('.HSC_year_of_completion').val();
			var diploma_year = $('.diploma1_year_of_completion').val();
			var ug_year = $('.UG1_year_of_completion').val();
			var pg_year = $('.PG1_year_of_completion').val(); 
			
			var difference1 =  pg_year - ug_year;
			
			if(ug_year && difference1 < 2){
				$('.alert_massage').text("Minimum 2 year  difference is required between  UG & PG year of passing");
				$('#alert_box').modal({backdrop: 'static',keyboard: false});
				
				var curStep = $(this).closest(".setup-content");
			
			var curStepBtn = curStep.attr("id");
			
            var nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().children("a");
			
			nextStepWizard.removeAttr('disabled').trigger('click');
			}
    });	
	

});


function popup(mylink, windowname)
{
    window.close();

    if (! window.focus)return true; var href;
    if (typeof(mylink) == 'string') href=mylink;
    else href=mylink.href;
    window.open(href, 'windowname', 'type=fullWindow,fullscreen,directories=no,titlebar=no,toolbar=no, menubar=no, location=no,resizable=no');
    return false;
}

function showwindow() {


    //window.history.pushState("", "", "/onlinetest");
    window.moveTo(0, 0);
    top.window.resizeTo(screen.availWidth, screen.availHeight);


   
}

function keypressaction(e)
{
    if ((e.which || e.keyCode) == 116  || e.ctrlKey && e.keyCode == 'C'.charCodeAt(0) || e.ctrlKey && e.keyCode == 'U'.charCodeAt(0) || e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0) || e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0) || (e.which || e.keyCode) == 82|| (e.which || e.keyCode) == 112|| (e.which || e.keyCode) == 114|| (e.which || e.keyCode) == 122|| (e.which || e.keyCode) == 123|| (e.which || e.keyCode) == 27)
    {
        e.preventDefault();
        $('.alert_massage').text("can't preform the action");
		$('#alert_box').modal({backdrop: 'static',keyboard: false}); 
    }
};

 $(document).ready(function () {
	 
	 
    $(document).on('change', '.get_institution_id', function(e) { 

			var institution_id = $('.get_institution_id :selected').attr('institution_id');
			var university_id = $('.get_institution_id :selected').attr('university_id');
			
			if($('.get_institution_id').val() != 99999){
			$('.set_institution_id').val(institution_id);
			$('.set_UG1_university').val(university_id);
			$('.set_PG1_university').val(university_id);
			$('.get_new_institution').empty();
			}
			else{
				$('.set_institution_id').val(99999);
				$('.set_UG1_university').val(0);
				$('.set_PG1_university').val(0);
				
				$('.get_new_institution').append('<br><br><input type="text" name="new_institution" required="required" class="form-control" placeholder="College / Institution Name"/>');
				
			}
			
        });

	$(".delete_test").on("click", function(event){
		
		$('.show_delete_test_id').html(this.value);
		$('.delete_test_id').val(this.value);
		
		$('#confirmation_modal').modal({backdrop: 'static',keyboard: false}); 
		
    }); 
	
	$(".Reappear").on("click", function(event){
		
		$('.show_name').html($(".Reappear").attr('valuename'));
		$('.show_email').html(this.value);
		$('.reappear_email').val(this.value);
		$('#Reappear_modal').modal({backdrop: 'static',keyboard: false}); 
		
    }); 
    
	$(".TermsOfService").on("click", function(){
            
        if($('.TermsOfService:checked').length == 1){
            
            $('.submit_btn').removeAttr('disabled');
        }
        else{
            $('.submit_btn').attr("disabled","disabled");
        }
            
    }); 

    $(".check").on("click", function(event){
            
        if($('.eligible:checked').length != 3){
            
            $('.alert_massage').text("Your should have all eligibility to attend test");
			$('#alert_box').modal({backdrop: 'static',keyboard: false}); 
        }
		
		var degree_type = $('.datatype:checked').map(function() {return this.value;}).get().join();
			
			
            

        if($('.eligible:checked').length == 3){
            
        if($('.degree:checked').length >= 1 ){
			
            var checkedValues = $('.degree:checked').map(function() {return this.value;}).get().join();
			
            var split_str = checkedValues.split(",");
            if (split_str.indexOf("1") !== -1 || split_str.indexOf("26") !== -1) {
                
				if( (degree_type == '21' || degree_type == 21) && split_str.indexOf("20") == -1){
				
					$('.alert_massage').text('Select UG '); 
					$('#alert_box').modal({backdrop: 'static',keyboard: false}); 
				
				}
				
				else{
					
                $('.other_degree').val(checkedValues);

                $('.signup_details').submit();
				}
				
            }
            else{
                
				$('.alert_massage').text('Select HSC or Diploma '); 
				$('#alert_box').modal({backdrop: 'static',keyboard: false}); 
            }
            
        }
        else{
            
			$('.alert_massage').text('select atleast one additional qualification'); 
					$('#alert_box').modal({backdrop: 'static',keyboard: false}); 
        }
            }
    }); 
});

