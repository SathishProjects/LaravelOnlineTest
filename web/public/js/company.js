
//Vijay deva

$(document).ready(function(){

     $(".terms").on("click", function(){
            
        if($('.terms:checked').length == 1){
            
            $('.submit_btn').removeAttr('disabled');
        }
        else{
            $('.submit_btn').attr("disabled","disabled");
        }
            
    }); 

    $('.title').on('keyup',function(e){
         $('.title_view').text($('.title').val());
    });

    $('.designation').on('keyup',function(e){
         $('.designation_view').text($('.designation').val());
    });

    $('.description').on('keyup',function(e){
         $('.description_view').text($('.description').val());
    });

    $('.vacancy').on('keyup',function(e){
         $('.vacancy_view').text($('.vacancy').val());
    });

    $('.salary').on('change',function(e){

         $('.salary_view').text($('.salary option:selected' ).text());
    });

   $('.drive_date').on('keyup',function(e){
         $('.drive_date_view').text($('.drive_date').val());
    });

   $('.lastdate_to_apply').on('keyup',function(e){
         $('.lastdate_to_apply_view').text($('.lastdate_to_apply').val());
    });

   $('.venue_state').on('change',function(e){

         $('.venue_state_view').text($('.venue_state option:selected' ).text());
    });

   $('.venue_district').on('change',function(e){

         $('.venue_district_view').text($('.venue_district option:selected' ).text());
    });

   $('.venue_city').on('change',function(e){

         $('.venue_city_view').text($('.venue_city option:selected' ).text());
    });

   $('.venue_college').on('change',function(e){

         $('.venue_college_view').text($('.venue_college option:selected' ).text());
    });

    $('.invited_state').on('change',function(e){

        var options = Array();
            $('.invited_state option:selected').each(function(index){

                if( parseInt($(this).val()) >= 0 ){
                    options[index] = $(this).text();
                }
                
            
            });

            options = options.join('<br>');

             $('.invited_state_view').empty();   
             $('.invited_state_view').html(options);

    });

   $('.invited_district').on('change',function(e){

        var options = Array();
            $('.invited_district option:selected').each(function(index){

                if( parseInt($(this).val()) >= 0 ){
                options[index] = $(this).text();
            }
                
            
            });

            console.log(options);

            options = options.join('<br>');

             $('.invited_district_view').empty();   
             $('.invited_district_view').html(options);

    });

   $('.invited_college').on('change',function(e){

        var options = Array();
            $('.invited_college option:selected').each(function(index){

                if( parseInt($(this).val()) >= 0 ){
                options[index] = $(this).text();
                }
                
                
            
            });

            options = options.join('<br>');

             $('.invited_college_view').empty();   
             $('.invited_college_view').html(options);
    });

   $('.sslc_marks').on('keyup',function(e){
         $('.sslc_marks_view').text($('.sslc_marks').val());
    });

   $('.sslc_year_from').on('change',function(e){
         $('.sslc_year_from_view').text($('.sslc_year_from option:selected' ).text());
    });
   $('.sslc_year_to').on('change',function(e){
         $('.sslc_year_to_view').text($('.sslc_year_to option:selected' ).text());
    });

    $('.hsc_marks').on('keyup',function(e){
         $('.hsc_marks_view').text($('.hsc_marks').val());
    });

   $('.hsc_year_from').on('change',function(e){
         $('.hsc_year_from_view').text($('.hsc_year_from option:selected' ).text());
    });
   $('.hsc_year_to').on('change',function(e){
         $('.hsc_year_to_view').text($('.hsc_year_to option:selected' ).text());
    });

   $('.diploma_required_branch').on('change',function(e){


        var options = Array();
            $('.diploma_required_branch option:selected').each(function(index){

                if( parseInt($(this).val()) >= -20 ){
                options[index] = $(this).text();
                }
                
                
            
            });

            options = options.join(' ,');

             $('.diploma_required_branch_view').empty();   
             $('.diploma_required_branch_view').html(options);

    });

   $('.diploma_marks').on('keyup',function(e){
         $('.diploma_marks_view').text($('.diploma_marks').val());
    });

   $('.diploma_year_from').on('change',function(e){
         $('.diploma_year_from_view').text($('.diploma_year_from option:selected' ).text());
    });
   $('.diploma_year_to').on('change',function(e){
         $('.diploma_year_to_view').text($('.diploma_year_to option:selected' ).text());
    });


    $('.ug_required_branch').on('change',function(e){

        $('.ug_required_branch_view').empty();
        var options = Array();
        var temp = Array();
        var output = Array();
        var optgroups = Array();

            $('.ug_required_branch optgroup').each(function(index){
                
                var label = $(this).attr('label');

                optgroups[index] = label;

                $('.ug_required_branch option:selected').each(function(i){

                    if($(this).parent().attr('label') == label ){

                        temp[temp.length++] = $(this).text();
                    }
                    
                });

                    temp = temp.join(',');

                     output[label] = temp;

                    temp =  [];  

                     });

            

           for (var key in output) {
                $('.ug_required_branch_view').append('<b>'+ key +'</b> (' + output[key] + ') , ');
            }
        });

   $('.ug_marks').on('keyup',function(e){
         $('.ug_marks_view').text($('.ug_marks').val());
    });

   $('.ug_year_from').on('change',function(e){
         $('.ug_year_from_view').text($('.ug_year_from option:selected' ).text());
    });
   $('.ug_year_to').on('change',function(e){
         $('.ug_year_to_view').text($('.ug_year_to option:selected' ).text());
    });

  
    $('.pg_required_branch').on('change',function(e){

$('.pg_required_branch_view').empty();
        var options = Array();
        var temp = Array();
        var output = Array();
        var optgroups = Array();

            $('.pg_required_branch optgroup').each(function(index){
                
                var label = $(this).attr('label');

                optgroups[index] = label;

                $('.pg_required_branch option:selected').each(function(i){

                    if($(this).parent().attr('label') == label ){

                        temp[temp.length++] = $(this).text();
                    }
                    
                });

                    temp = temp.join(',');

                     output[label] = temp;

                    temp =  [];  

                     });

            

           for (var key in output) {
                $('.pg_required_branch_view').append('<b>'+ key +'</b> (' + output[key] + ') , ');
            }
        });

   $('.pg_marks').on('keyup',function(e){
         $('.pg_marks_view').text($('.pg_marks').val());
    });

   $('.pg_year_from').on('change',function(e){
         $('.pg_year_from_view').text($('.pg_year_from option:selected' ).text());
    });
   $('.pg_year_to').on('change',function(e){
         $('.pg_year_to_view').text($('.pg_year_to option:selected' ).text());
    });

   $('.nextBtn').on('click',function(e){
          var options = Array();
            $('.skills option:selected').each(function(index){

                if( parseInt($(this).val()) >= -20 ){
                options[index] = $(this).text();
                }
                
                
            
            });

            options = options.join(' ,');

             $('.skills_view').empty();   
             $('.skills_view').html(options);
    });

   $('.maximum_standing_arrers').on('change',function(e){
         $('.maximum_standing_arrers_view').text($('.maximum_standing_arrers option:selected' ).text());
    });
    
    $('.maximum_history_arrers').on('change',function(e){
         $('.maximum_history_arrers_view').text($('.maximum_history_arrers option:selected' ).text());
    });


   $('.contact_email').on('keyup',function(e){
         $('.contact_email_view').text($('.contact_email').val());
    });

   $('.contact_mobile').on('keyup',function(e){
         $('.contact_mobile_view').text($('.contact_mobile').val());
    });

     $('.accept_arrers').on('click',function(e){

        if($(this).is(':checked')){
         $('.accept_arrers_view').text('Yes - Can Allow');
         $('.maximum_standing_arrers_view').text(' - ');
         $('.maximum_history_arrers_view').text(' - ');
        }
        else{
            $('.accept_arrers_view').text("No - Can't Allow");
        }
    });


    $('.tokenize').tokenize({
      displayDropdownOnFocus:true,
      placeholder:' Required key skills ',
      sortable:true
    });

  $('.multiselect').multiselect({ 

        enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 800 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true


    });

  $('.multiselect').on('change',function(e){ 
    
    if( parseInt($(this).find('option:selected').length) >= 2 ){

        $(this).find('.disabled_option').prop('disabled',false).prop('selected',false);

         $(this).multiselect('refresh');
    }


    });

  $(".accept_arrers").on('click', function(e) {

    if ($('input.accept_arrers').is(':checked')) {

    $(".arrers").prop('disabled', 'disabled');

    $('.arrers').next().children().addClass("disabled");
    
    $(".arrers").multiselect('refresh');

      
    }
    else{

      $(".arrers").prop('disabled', false);

      $('.arrers').next().children().removeClass("disabled");
    
    $(".arrers").multiselect('refresh');

    }
    
  });

 /* $(".invited_state").on('change', function(e) {

    if($('.invited_state').find('.any_state').is(':selected')){
        
        alert("any state is selected");

         $(".invited_district").prop('disabled', 'disabled');

        $('.invited_district').next().children().addClass("disabled");
    
        $(".invited_district").multiselect('refresh');
        
        $('.invited_state').multiselect('refresh');
    }

    else{

      $(".invited_district").prop('disabled', false);

      $('.invited_district').next().children().removeClass("disabled");
    
      $(".invited_district").multiselect('refresh');

    }
    
  });*/


  /* All Ajax calls */

   $( ".venue_state" ).on('change', function(e) {

    $('.venue_district').multiselect('destroy');$('.venue_district').empty();

    $('.venue_district').append($("<option  class='disabled_option' disabled selected ></option>").attr("value","").text(" Loading Please Wait... "));

        $.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/get_district',
            data : {StateId : $( ".venue_state").val()},

            success : function(response) {


                $('.venue_district').removeAttr('disabled');

                $('.venue_district').multiselect('destroy');$('.venue_district').empty();

                $('.venue_district').append($("<option  class='disabled_option' disabled selected ></option>").attr("value","").text("- Select District - "));

                $.each(response[0], function(key,value) {
                    $('.venue_district').append($("<option></option>").attr("value",key).text(value));
                });
                $('.venue_district').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
                $('.venue_district').multiselect('refresh');
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })
    });


   $( ".venue_district" ).on('change', function(e) {

    $('.venue_city').multiselect('destroy');$('.venue_city').empty();

    $('.venue_city').append($("<option  class='disabled_option' disabled selected ></option>").attr("value","").text(" Loading Please Wait... "));

        $.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/get_city',
            data : { DistrictId : $( ".venue_district").val()},

            success : function(response) {


                $('.venue_city').removeAttr('disabled');

                $('.venue_city').multiselect('destroy');$('.venue_city').empty();

                $('.venue_city').append($("<option  class='disabled_option' disabled selected  ></option>").attr("value","").text("- Select city - "));

                $.each(response[0], function(key,value) {
                    $('.venue_city').append($("<option></option>").attr("value",key).text(value));
                });
                $('.venue_city').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
                $('.venue_city').multiselect('refresh');
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })
    });

   $( ".venue_city" ).on('change', function(e) {

    $('.venue_college').multiselect('destroy');$('.venue_college').empty();

    $('.venue_college').append($("<option  class='disabled_option' disabled selected ></option>").attr("value","").text(" Loading Please Wait... "));

        $.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/get_venue_college',
            data : { cityId : $( ".venue_city").val()},

            success : function(response) {


                $('.venue_college').removeAttr('disabled');

                $('.venue_college').multiselect('destroy');$('.venue_college').empty();

                $('.venue_college').append($("<option  class='disabled_option' disabled selected  ></option>").attr("value","").text("- Select venue_college - "));

                $.each(response[0], function(key,value) {
                    $('.venue_college').append($("<option></option>").attr("value",key).text(value));
                });
                $('.venue_college').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
                $('.venue_college').multiselect('refresh');
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })
    });

   
   $( ".invited_state" ).on('change', function(e) {


    if($('.invited_state').find('.any_state').is(':selected')){
        
        $('.invited_state').val(0);            

        $('.invited_state').multiselect('refresh'); 

        $(".invited_district,.invited_college").prop('disabled', 'disabled');

        $('.invited_district,.invited_college').next().children().addClass("disabled");
    
        $(".invited_district,.invited_college").multiselect('refresh');
        
        return false;
    }
    else{
         $(".invited_district,.invited_college").prop('disabled', false);
         $('.invited_district,.invited_college').next().children().removeClass("disabled");
          $(".invited_district,.invited_college").multiselect('refresh');
    }

    $('.invited_district').multiselect('destroy');$('.invited_district').empty();

    $('.invited_district').append($("<option  class='disabled_option' disabled selected ></option>").attr("value","").text(" Loading Please Wait... "));

        $.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/get_multiple_district',
            data : {StateId : $( ".invited_state").val()},

            success : function(data) {


                $('.invited_district').removeAttr('disabled');

                $('.invited_district').multiselect('destroy');$('.invited_district').empty();

                $('.invited_district').append($("<option  class='disabled_option' disabled selected ></option>").attr("value","").text("- Select District - "));
                $('.invited_district').append($("<option class='any_district'></option>").attr("value","0").text("ANY COLLEGE IN SELECTED STATE(S)"));


                 $.each(data[0], function (key, cat) {


                            var group = $('<optgroup>',{label:key});
                            

                            $.each(cat,function(key,value) {
                                $("<option/>",{value:key,text:value})
                                    .appendTo(group);
                            });
                            $('.invited_district').append(group);
                        });


                $('.invited_district').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
                $('.invited_district').multiselect('refresh');
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })
    
    });


   $( ".invited_district" ).on('change', function(e) {

    if($('.invited_district').find('.any_district').is(':selected')){
        
        $('.invited_district').val(0);            

        $('.invited_district').multiselect('refresh'); 

        $(".invited_college").prop('disabled', 'disabled');

        $('.invited_college').next().children().addClass("disabled");
    
        $(".invited_college").multiselect('refresh');
        
        return false;
    }
    else{
         $(".invited_college").prop('disabled', false);
         $('.invited_college').next().children().removeClass("disabled");
          $(".invited_college").multiselect('refresh');
    }

    $('.invited_college').multiselect('destroy');$('.invited_college').empty();

    $('.invited_college').append($("<option  class='disabled_option' disabled selected ></option>").attr("value","").text(" Loading Please Wait... "));

        $.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/get_invited_college',
            data : { DistrictId : $( ".invited_district").val()},

            success : function(data) {


                $('.invited_college').removeAttr('disabled');

                $('.invited_college').multiselect('destroy');$('.invited_college').empty();

                $('.invited_college').append($("<option  class='disabled_option' disabled selected  ></option>").attr("value","").text("- Invited college(s) -"));

                $('.invited_college').append($("<option class='any_college'></option>").attr("value","0").text(" ANY COLLEGE (S) IN SELECTED DISTRICT"));

                $.each(data[0], function (key, cat) {


                            var group = $('<optgroup>',{label:key});
                            

                            $.each(cat,function(key,value) {
                                $("<option/>",{value:key,text:value})
                                    .appendTo(group);
                            });
                            $('.invited_college').append(group);
                        });


                $('.invited_college').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
                $('.invited_college').multiselect('refresh');
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })
    });


   $( ".invited_college" ).on('change', function(e) {

    if($('.invited_college').find('.any_college').is(':selected')){
        
        $('.invited_college').val(0);            

        $('.invited_college').multiselect('refresh'); 
        
    }
    else{
         $(".invited_college").prop('disabled', false);
         $('.invited_college').next().children().removeClass("disabled");
          $(".invited_college").multiselect('refresh');
    }

    });

   


     $(".sslc_year_from").on("change", function(){
        var sslc_year_from = parseInt($(".sslc_year_from").val());

        var hsc_range1 = sslc_year_from + 1;

        var diploma_range1 = sslc_year_from + 3;


        $(".sslc_year_to option").each(function() {
        
        var thisOptionval = parseInt($(this).val());

        var $thisOption = $(this);
        
        if(thisOptionval < sslc_year_from){

            $thisOption.attr("disabled", "disabled");
        }
        else{
             $thisOption.removeAttr("disabled");
        }
        
        });

        $(".hsc_year_from option").each(function() {
        
        var thisOptionval = parseInt($(this).val());

        var $thisOption = $(this);
        
        if(thisOptionval < hsc_range1){

            $thisOption.attr("disabled", "disabled");
        }
        else{
             $thisOption.removeAttr("disabled");
        }
        
        });

        $(".diploma_year_from option").each(function() {
        
        var thisOptionval = parseInt($(this).val());

        var $thisOption = $(this);
        
        if(thisOptionval < diploma_range1){

            $thisOption.attr("disabled", "disabled");
        }
        else{
             $thisOption.removeAttr("disabled");
        }
        
        });
        
        

        $('.hsc_year_from,.diploma_year_from,.sslc_year_to').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
        $('.hsc_year_from,.diploma_year_from,.sslc_year_to').multiselect('refresh');


    });

    $(".hsc_year_from").on("change", function(){

        var hsc_year_from = parseInt($(".hsc_year_from").val());

        var diploma_range1 = hsc_year_from + 2;

        var ug_range1 = hsc_year_from + 2;

        $(".hsc_year_to option").each(function() {
        
        var thisOptionval = parseInt($(this).val());

        var $thisOption = $(this);
        
        if(thisOptionval < sslc_year_from){

            $thisOption.attr("disabled", "disabled");
        }
        else{
             $thisOption.removeAttr("disabled");
        }
        
        });

         $(".diploma_year_from option").each(function() {
        
        var thisOptionval = parseInt($(this).val());

        var $thisOption = $(this);
        
        if(thisOptionval < diploma_range1){

            $thisOption.attr("disabled", "disabled");
        }
        else{
             $thisOption.removeAttr("disabled");
        }
        
        });

         $(".ug_year_from option").each(function() {
        
        var thisOptionval = parseInt($(this).val());

        var $thisOption = $(this);
        
        if(thisOptionval < ug_range1){

            $thisOption.attr("disabled", "disabled");
        }
        else{
             $thisOption.removeAttr("disabled");
        }
        
        });

        
        $('.ug_year_from,.hsc_year_to,.diploma_year_from').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
        $('.ug_year_from,.hsc_year_to,.diploma_year_from').multiselect('refresh');
        
    });


    $(".diploma_year_from").on("change", function(){

        var diploma_year_from = parseInt($(".diploma_year_from").val());

        var ug_range1 = diploma_year_from + 2;

        $(".ug_year_from option").each(function() {
        
        var thisOptionval = parseInt($(this).val());

        var $thisOption = $(this);
        
        if(thisOptionval < ug_range1){

            $thisOption.attr("disabled", "disabled");
        }
        else{
             $thisOption.removeAttr("disabled");
        }
        
        });

        $('.ug_year_from').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
        $('.ug_year_from').multiselect('refresh');
        
    });

    $(".ug_year_from").on("change", function(){

        var ug_year_from = parseInt($(".ug_year_from").val());

        var pg_range1 = ug_year_from + 2;

        $(".pg_year_from option").each(function() {
        
        var thisOptionval = parseInt($(this).val());

        var $thisOption = $(this);
        
        if(thisOptionval < pg_range1){

            $thisOption.attr("disabled", "disabled");
        }
        else{
             $thisOption.removeAttr("disabled");
        }
        
        });

        $('.pg_year_from').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
        $('.pg_year_from').multiselect('refresh');
        
    });

     $(".sslc_year_to").on("change", function(){
        var sslc_year_to = parseInt($(".sslc_year_to").val());

        var hsc_range1 = sslc_year_to + 2;

        var diploma_range1 = sslc_year_to + 3;

        $(".hsc_year_to option").each(function() {
        
        var thisOptionval = parseInt($(this).val());

        var $thisOption = $(this);
        
        if(thisOptionval < hsc_range1){

            $thisOption.attr("disabled", "disabled");
        }
        else{
             $thisOption.removeAttr("disabled");
        }
        
        });

        $(".diploma_year_to option").each(function() {
        
        var thisOptionval = parseInt($(this).val());

        var $thisOption = $(this);
        
        if(thisOptionval < diploma_range1){

            $thisOption.attr("disabled", "disabled");
        }
        else{
             $thisOption.removeAttr("disabled");
        }
        
        });
        
        

        $('.hsc_year_to').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
        $('.hsc_year_to').multiselect('refresh');

        $('.diploma_year_to').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
        $('.diploma_year_to').multiselect('refresh');

    });

    $(".hsc_year_to").on("change", function(){

        var hsc_year_to = parseInt($(".hsc_year_to").val());

        var diploma_range1 = hsc_year_to + 2;

        var ug_range1 = hsc_year_to + 2;

         $(".diploma_year_to option").each(function() {
        
        var thisOptionval = parseInt($(this).val());

        var $thisOption = $(this);
        
        if(thisOptionval < diploma_range1){

            $thisOption.attr("disabled", "disabled");
        }
        else{
             $thisOption.removeAttr("disabled");
        }
        
        });

         $(".ug_year_to option").each(function() {
        
        var thisOptionval = parseInt($(this).val());

        var $thisOption = $(this);
        
        if(thisOptionval < ug_range1){

            $thisOption.attr("disabled", "disabled");
        }
        else{
             $thisOption.removeAttr("disabled");
        }
        
        });

        
        $('.ug_year_to').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
        $('.ug_year_to').multiselect('refresh');

        $('.diploma_year_to').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
        $('.diploma_year_to').multiselect('refresh');
        
    });


    $(".diploma_year_to").on("change", function(){

        var diploma_year_to = parseInt($(".diploma_year_to").val());

        var ug_range1 = diploma_year_to + 2;

        $(".ug_year_to option").each(function() {
        
        var thisOptionval = parseInt($(this).val());

        var $thisOption = $(this);
        
        if(thisOptionval < ug_range1){

            $thisOption.attr("disabled", "disabled");
        }
        else{
             $thisOption.removeAttr("disabled");
        }
        
        });

        $('.ug_year_to').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
        $('.ug_year_to').multiselect('refresh');
        
    });

    $(".ug_year_to").on("change", function(){

        var ug_year_to = parseInt($(".ug_year_to").val());

        var pg_range1 = ug_year_to + 2;

        $(".pg_year_to option").each(function() {
        
        var thisOptionval = parseInt($(this).val());

        var $thisOption = $(this);
        
        if(thisOptionval < pg_range1){

            $thisOption.attr("disabled", "disabled");
        }
        else{
             $thisOption.removeAttr("disabled");
        }
        
        });

        $('.pg_year_to').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
        $('.pg_year_to').multiselect('refresh');
        
    });


    ////////////////////

       $( ".ug_required_degree" ).on('change', function(e) {


    if($('.ug_required_degree').find('.any_degree').is(':selected')){
        
        $('.ug_required_degree').val(-1);            

        $('.ug_required_degree').multiselect('refresh'); 

        $(".ug_required_branch").prop('disabled', 'disabled');

        $('.ug_required_branch').next().children().addClass("disabled");
    
        $(".ug_required_branch").multiselect('refresh');
        
        return false;
    }

    $('.ug_required_branch').multiselect('destroy');$('.ug_required_branch').empty();

    $('.ug_required_branch').append($("<option  class='disabled_option' disabled selected ></option>").attr("value","").text(" Loading Please Wait... "));

        $.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/get_multiple_branch',
            data : { degreeId : $( ".ug_required_degree").val()},

            success : function(data) {


                $('.ug_required_branch').removeAttr('disabled');

                $('.ug_required_branch').multiselect('destroy');$('.ug_required_branch').empty();

                $('.ug_required_branch').append($("<option  class='disabled_option' disabled selected ></option>").attr("value","").text("- Select Branch - "));


                 $.each(data[0], function (key, cat) {


                            var group = $('<optgroup>',{label:key});
                            
                            $.each(cat,function(key,value) {
                                $("<option/>",{value:key,text:value})
                                    .appendTo(group);
                            });
                            $('.ug_required_branch').append(group);
                        });


                $('.ug_required_branch').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
                $('.ug_required_branch').multiselect('refresh');
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })
    });

     $( ".pg_required_degree" ).on('change', function(e) {


    if($('.pg_required_degree').find('.any_degree').is(':selected')){
        
        $('.pg_required_degree').val(-2);            

        $('.pg_required_degree').multiselect('refresh'); 

        $(".pg_required_branch").prop('disabled', 'disabled');

        $('.pg_required_branch').next().children().addClass("disabled");
    
        $(".pg_required_branch").multiselect('refresh');
        
        return false;
    }

    $('.pg_required_branch').multiselect('destroy');$('.pg_required_branch').empty();

    $('.pg_required_branch').append($("<option  class='disabled_option' disabled selected ></option>").attr("value","").text(" Loading Please Wait... "));

        $.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : '/index.php/get_multiple_branch',
            data : { degreeId : $( ".pg_required_degree").val()},

            success : function(data) {


                $('.pg_required_branch').removeAttr('disabled');

                $('.pg_required_branch').multiselect('destroy');$('.pg_required_branch').empty();

                $('.pg_required_branch').append($("<option  class='disabled_option' disabled selected ></option>").attr("value","").text("- Select Branch - "));


                 $.each(data[0], function (key, cat) {


                            var group = $('<optgroup>',{label:key});
                            
                            $.each(cat,function(key,value) {
                                $("<option/>",{value:key,text:value})
                                    .appendTo(group);
                            });
                            $('.pg_required_branch').append(group);
                        });


                $('.pg_required_branch').multiselect({ enableFiltering: true,enableCaseInsensitiveFiltering: true,enableCaseInsensitiveFiltering: true,maxHeight: 200 ,maxWidth: 300 ,buttonWidth: '100%', nonSelectedText: 'Select the option', selectAllText: true});
                $('.pg_required_branch').multiselect('refresh');
            },
            error   : function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus)
                console.log(errorThrown);
            }

        })
    });
   

    ///////////////////////

  });