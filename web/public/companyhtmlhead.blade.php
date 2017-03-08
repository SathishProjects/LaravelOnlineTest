<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>first.jobs by Techruit Technologies</title>
<!-- core CSS -->
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/jquery.tokenize.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/bootstrapValidator.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}"/>
<link rel="shortcut icon" href="{{ asset('/images1/ico/favicon.ico') }}">  

<script type="text/javascript" src="{{ asset('js/jquery-1.9.1.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery-ui.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrapValidator.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-multiselect.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.tokenize.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/default.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/sathish_oct_2.js') }}"></script>
   <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-70081048-1', 'auto');
  ga('send', 'pageview');

</script>
<script>

    $("#selected_list_upload").validate(
            {

                rules: {
                    csv: {
                        required: true
                    }
                },
                messages: {
                    csv: {
                        required: 'Select file to proceed'
                    }

                }
            }

    );





</script>



<script>
    $('.btn-toggle').click(function() {
        //$(this).find('.btn').toggleClass('active');
        $(this).find('.btn').toggleClass('btn-warning');
    });

</script>


<style>
    .btnpad{
        padding-top: 320px;
    }
    .skip{
        color: white;
        font-size: 18px;
        text-decoration: none;
    }
    .containerpadding{
        padding-top: 100px;
    }
    .form-text{
        color: white;
    }
    @media screen and (max-width: 1200px) {
        .cntmargin{
            text-align: center;
        }
    }
    h2 {
        margin: 0px;
        padding: 5px;
    }
    .dropdown-menu {
        left:0%;}
    .loc_cal{
        color: darkgrey;
        font-size: 12px;

    }
    .panel-tabs {
        position: relative;
        bottom: 30px;
        clear:both;
        border-bottom: 1px solid transparent;
    }

    .panel-tabs > li {
        float: left;
        margin-bottom: -1px;
    }

    .panel-tabs > li > a {
        margin-right: 2px;
        margin-top: 4px;
        line-height: .85;
        border: 1px solid transparent;
        border-radius: 4px 4px 0 0;
        color: #ffffff;
    }

    .panel-tabs > li > a:hover {
        border-color: transparent;
        color: #ffffff;
        background-color: transparent;
    }

    .panel-tabs > li.active > a,
    .panel-tabs > li.active > a:hover,
    .panel-tabs > li.active > a:focus {
        color: #fff;
        cursor: default;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        background-color: rgba(255,255,255, .23);
        border-bottom-color: transparent;
    }
    .panel-primary , .panel-primary>.panel-heading {
        border-color: darkorange;

    }
    .panel-primary>.panel-heading {
        color: #fff;
        background-color: darkorange;
        border-color: darkorange;
    }
    body{
        font-family: arial,sans-serif ;
    }
    a{
        color: black;
    }
    @media screen and (max-width: 1100px){
        .pb {
            text-align: center;
        }
        #img1{
            width: 100px;
            margin-left: 25%;
            margin-right: 25%;
        }

    }
    .dropdown-menu {
        width: 280px;
        margin-left:0px;}
    @media screen and (min-width: 970px ){

        #leftcol12{
            padding-left: 0px;
            padding-right: 5px;
        }
    }
    .tabbable-line > .nav-tabs > li.open, .tabbable-line > .nav-tabs > li:hover {
        border-bottom: 4px solid #ffcc00;
        background-color: darkorange;
    }
    .tabbable-line > .nav-tabs > li.open > a > i, .tabbable-line > .nav-tabs > li:hover > a > i {
        color: white;
    }
    #nopad{
        padding-bottom: 0px;
    }
    .row{
        padding-bottom:10px;
    }
</style>
<script type="text/javascript">

         $(document).ready(function() {
          
		  $(window).keydown(function(event){
          if(event.keyCode == 13) {
               event.preventDefault();
               return false;
              }
           });
		  
			$( "#diploma_maximum_history" ).change(function() {
				if($( "#diploma_maximum_history" ).val() == 0){
					$('#diploma_maximum_standing option:eq(1)').prop('selected', true);
					$('#diploma_maximum_standing').next().children().attr('disabled', 'disabled');
					$("#diploma_maximum_standing").multiselect('refresh');
				}
				if($( "#diploma_maximum_history" ).val() > 0 && $( "#diploma_maximum_history" ).val() < 100){
					$('#diploma_maximum_standing option:eq(0)').prop('selected', true);
					$('#diploma_maximum_standing').next().children().removeAttr('disabled');
					$("#diploma_maximum_standing").multiselect('refresh');
							
				}
				if($( "#diploma_maximum_history" ).val() == 100){
					$('#diploma_maximum_standing option:eq(2)').prop('selected', true);
					$('#diploma_maximum_standing').next().children().attr('disabled', 'disabled');
					$("#diploma_maximum_standing").multiselect('refresh');
							
				}
				
			});
			
			$( "#ug_maximum_history" ).change(function() {
				if($( "#ug_maximum_history" ).val() == 0){
					$('#ug_maximum_standing option:eq(1)').prop('selected', true);
					$('#ug_maximum_standing').next().children().attr('disabled', 'disabled');
					$("#ug_maximum_standing").multiselect('refresh');
							
				}
				if($( "#ug_maximum_history" ).val() > 0 && $( "#ug_maximum_history" ).val() < 100){
					$('#ug_maximum_standing option:eq(0)').prop('selected', true);
					$('#ug_maximum_standing').next().children().removeAttr('disabled');
					$("#ug_maximum_standing").multiselect('refresh');
							
				}
				if($( "#ug_maximum_history" ).val() == 100){
					$('#ug_maximum_standing option:eq(2)').prop('selected', true);
					$('#ug_maximum_standing').next().children().attr('disabled', 'disabled');
					$("#ug_maximum_standing").multiselect('refresh');
							
				}
				
			});
			
			$( "#pg_maximum_history" ).change(function() {
				if($( "#pg_maximum_history" ).val() == 0){
					$('#pg_maximum_standing option:eq(1)').prop('selected', true);
					$('#pg_maximum_standing').next().children().attr('disabled', 'disabled');
					$("#pg_maximum_standing").multiselect('refresh');
							
				}
				if($( "#pg_maximum_history" ).val() > 0 && $( "#pg_maximum_history" ).val() < 100){
					$('#pg_maximum_standing option:eq(0)').prop('selected', true);
					$('#pg_maximum_standing').next().children().removeAttr('disabled');
					$("#pg_maximum_standing").multiselect('refresh');
							
				}
				if($( "#pg_maximum_history" ).val() == 100){
					$('#pg_maximum_standing option:eq(2)').prop('selected', true);
					$('#pg_maximum_standing').next().children().attr('disabled', 'disabled');
					$("#pg_maximum_standing").multiselect('refresh');
							
				}
				
			});
		   
         });
			$(document).ready(function () {
			
			$('#degree_applicable').change(function(){
            $("#sslc_view").hide();$("#hsc_view").hide();$("#diploma_view").hide();$("#ug_view").hide(); $("#pg_view").hide();
            var value = $('#degree_applicable').val();

            $(value).each(function(i){
                if(value[i]=='step-3'){
                    $("#sslc_view").show();
                }
				if(value[i]=='step-4'){
                    $("#hsc_view").show();
                }
                if(value[i]=='step-5'){
					$("#diploma_required_degree").val('30');
                    $("#diploma_view").show();
                }
                if(value[i]=='step-6'){
                    $("#ug_view").show();
                }
                if(value[i]=='step-7'){
                    $("#pg_view").show();
                }
            });


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
                    navListItems.removeClass('btn-primary').addClass('btn-default');
                    $item.addClass('btn-primary');
                    allWells.hide();
                    $target.show();
                    $target.find('input:eq(0)').focus();
                }
            });

            allNextBtn.click(function(){

                var steps = ($('#degree_applicable').val());



                var curStep = $(this).closest(".setup-content"),
                        curStepBtn = curStep.attr("id"),
                        nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                        curInputs = curStep.find("input[type='text'],input[type='select'],input[type='number'],select,select"),
                        isValid = true;
                if(steps != null){
                if(curStepBtn != 'step-1'){

                    if(curStepBtn == 'step-2'){
                        curStepBtn=steps[0];
                        nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().children("a"),
                                curInputs = curStep.find("input[type='text'],input[type='select'],input[type='number'],select"),
                                isValid = true;
                    }
                    else{
                        if(curStepBtn != steps[steps.length-1]){
                            curStepBtn=steps[jQuery.inArray( curStepBtn, steps )+1];
                            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().children("a"),
                                    curInputs = curStep.find("input[type='text'],input[type='select'],input[type='number'],select"),
                                    isValid = true;
                        }
                        else{
							
                            nextStepWizard = $('div.setup-panel div a[href="#' + 'step-8' + '"]').parent().children("a"),
                                    curInputs = curStep.find("input[type='text'],input[type='select'],input[type='number'],select"),
                                    isValid = true;
									
                        }
                    }
                }
                }
				
				

                $(".form-group").removeClass("has-error");
                for(var i=0; i<curInputs.length; i++){
                    if (!curInputs[i].validity.valid){
                        isValid = false;
                        $(".mandatory").removeAttr("hidden");
                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                    }
                    else{
                        $(curInputs[i]).closest(".form-group").addClass("has-success");
                    }
                }

                if (isValid){
                    $(".mandatory").attr("hidden","hidden");
                    nextStepWizard.removeAttr('disabled').trigger('click');
                }
            });
            allPrevBtn.click(function(){
                var steps = ($('#degree_applicable').val());
                
                var curStep = $(this).closest(".setup-content"),
                        curStepBtn = curStep.attr("id");

                if(curStepBtn == steps[0]){

                    var nextStepWizard = $('div.setup-panel div a[href="#' + 'step-2' + '"]').parent().children("a"),
                            isValid = true;

                }
                else if(curStepBtn == 'step-8'){
                    curStepBtn=steps[steps.length-1];
                    var nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().children("a"),
                            isValid = true;
                }
                else{
                    curStepBtn=steps[jQuery.inArray( curStepBtn, steps )-1];
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().children("a"),
                            curInputs = curStep.find("input[type='text'],input[type='select'],input[type='number'],select"),
                            isValid = true;
                }

                if (isValid){
                    nextStepWizard.removeAttr('disabled').trigger('click');
                }

            });
            $('div.setup-panel div a.btn-primary').trigger('click');
        });

</script>
<script>
    /*
     Used for filter,
     include by Vijay deva
     */
    $(document).ready(function(){
        $('.filterable .btn-filter').click(function(){
            var $panel = $(this).parents('.filterable'),
                    $filters = $panel.find('.filters input'),
                    $tbody = $panel.find('.table tbody');
            if ($filters.prop('disabled') == true) {
                $filters.prop('disabled', false);
                $filters.first().focus();
            } else {
                $filters.val('').prop('disabled', true);
                $tbody.find('.no-result').remove();
                $tbody.find('tr').show();
            }
        });

        $('.filterable .filters input').keyup(function(e){
            /* Ignore tab key */
            var code = e.keyCode || e.which;
            if (code == '9') return;
            /* Useful DOM data and selectors */
            var $input = $(this),
                    inputContent = $input.val().toLowerCase(),
                    $panel = $input.parents('.filterable'),
                    column = $panel.find('.filters th').index($input.parents('th')),
                    $table = $panel.find('.table'),
                    $rows = $table.find('tbody tr');
            /* Dirtiest filter function ever ;) */
            var $filteredRows = $rows.filter(function(){
                var value = $(this).find('td').eq(column).text().toLowerCase();
                return value.indexOf(inputContent) === -1;
            });
            /* Clean previous no-result if exist */
            $table.find('tbody .no-result').remove();
            /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
            $rows.show();
            $filteredRows.hide();
            /* Prepend no-result row if all rows are filtered */
            if ($filteredRows.length === $rows.length) {
                $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
            }
        });
    });

</script>
<script>
    function show() {

        $("#title").text($('#job_title').val());
        $("#sslc_marks1").text($('#sslc_marks').val());
        $("#hsc_marks1").text($('#hsc_marks').val());
        $("#diploma_required_degree1").text(
                $("#diploma_required_degree option:selected").map(function () {
                    return $(this).text();
                }).get().join(', ')
        );
        $("#diploma_required_branch1").text(
                $("#diploma_required_branch option:selected").map(function () {
                    return $(this).text();
                }).get().join(', ')
        );
        $("#diploma_marks1").text($('#diploma_marks').val());
        $("#diploma_year_of_passing1").text(
                $("#diploma_year_of_passing option:selected").map(function () {
                    return $(this).text();
                }).get().join(', ')
        );
        $("#diploma_maximum_history1").text($('#diploma_maximum_history option:selected' ).text());
        $("#diploma_maximum_standing1").text($('#diploma_maximum_standing option:selected' ).text());
        $("#ug_required_degree1").text(
                $("#ug_required_degree option:selected").map(function () {
                    return $(this).text();
                }).get().join(', ')
        );
        $("#ug_required_branch1").text(
                $("#ug_required_branch option:selected").map(function () {
                    return $(this).text();
                }).get().join(', ')
        );
        $("#ug_marks1").text($('#ug_marks').val());
        $("#ug_year_of_passing1").text(
                $("#ug_year_of_passing option:selected").map(function () {
                    return $(this).text();
                }).get().join(', ')
        );
        $("#ug_maximum_history1").text($('#ug_maximum_history option:selected' ).text());
        $("#ug_maximum_standing1").text($('#ug_maximum_standing option:selected' ).text());
        $("#pg_required_degree1").text(
                $("#pg_required_degree option:selected").map(function () {
                    return $(this).text();
                }).get().join(', ')
        );
        $("#pg_required_branch1").text(
                $("#pg_required_branch option:selected").map(function () {
                    return $(this).text();
                }).get().join(', ')
        );
        $("#pg_marks1").text($('#pg_marks').val());
        $("#pg_year_of_passing1").text(
                $("#pg_year_of_passing option:selected").map(function () {
                    return $(this).text();
                }).get().join(', ')
        );
        $("#pg_maximum_history1").text($('#pg_maximum_history option:selected' ).text());
        $("#pg_maximum_standing1").text($('#pg_maximum_standing option:selected' ).text());
        $("#skills1").text(
                $("#skills option:selected").map(function () {
                    return $(this).text();
                }).get().join(', ')
        );
        $("#gender1").text($('option:selected',('#gender')).text());
        $("#language1").text(
                $("#language option:selected").map(function () {
                    return $(this).text();
                }).get().join(', ')
        );
        $("#age_from1").text($('#age_from').val());
        $("#age_to1").text($('#age_to').val());
        $("#physically_challenged1").text($('#physically_challenged').val());

    }


</script>
