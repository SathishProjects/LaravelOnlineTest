@extends('layouts.page')
@section('content')
<style>
a{
	color:black;
}

body {
     background-color: #ffffff !important; 
}

</style>

<style type="text/css">
	.tree, .tree ul {
    margin:0;
    padding:0;
    list-style:none
}
.tree ul {
    margin-left:1em;
    position:relative
}
.tree ul ul {
    margin-left:.5em
}
.tree ul:before {
    content:"";
    display:block;
    width:0;
    position:absolute;
    top:0;
    bottom:0;
    left:0;
    border-left:1px solid
}
.tree li {
    margin:0;
    padding:0 1em;
    line-height:2em;
    color:#d9534f;
    font-weight:700;
    position:relative
}
.tree ul li:before {
    content:"";
    display:block;
    width:10px;
    height:0;
    border-top:1px solid;
    margin-top:-1px;
    position:absolute;
    top:1em;
    left:0
}
.tree ul li:last-child:before {
    background:#fff;
    height:auto;
    top:1em;
    bottom:0
}
.indicator {
    margin-right:5px;
}
.tree li a {
    text-decoration: none;
    color:#d9534f;
}
.tree li button, .tree li button:active, .tree li button:focus {
    text-decoration: none;
    color:#d9534f;
    border:none;
    background:transparent;
    margin:0px 0px 0px 0px;
    padding:0px 0px 0px 0px;
    outline: 0;
}
</style>


<div class="homecontainer">

@if (session()->has('message'))
<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <center><strong>Success!</strong> {!! session('message') !!} </center>
  {!! session()->forget('message') !!}
</div>
@endif

	<div id="test" class="tab-pane tab-pane1 fade in test">

		<hr>
		<div class="row">
			<div class="col-md-2">
				<hr>
					
					<a type="button" href="/index.php/create_batch" class="btn btn-danger btn-sm btn-block" role="button">CREATE BATCH</a>

					<a href="/index.php/create_question" class="btn btn-danger btn-sm btn-block">CREATE QUESTION PAPER</a>
				
				<hr />
				<ul class="nav nav-pills nav-pills1 nav-stacked">
					@if($status == 'active')
					<li class="active"><a href="/index.php/college/batch/active"><span class="glyphicon glyphicon-chevron-right"></span> View Batch</a></li>
					@else
						<li><a href="/index.php/college/batch/active"><span class="glyphicon glyphicon-chevron-down"></span> View Batch</a></li>
					@endif

				</ul>
				
				<ul class="nav nav-pills nav-pills1 nav-stacked">

						<li><a href="/index.php/college/questionpaper/active"><span class="glyphicon glyphicon-chevron-down"></span> Active Qn.Paper<span class="badge pull-right">{!! $count2[0]->qp_active !!}</span></a></li>

						<li><a href="/index.php/college/questionpaper/inactive"><span class="glyphicon glyphicon-chevron-down"></span> Inactive Qn.Paper<span class="badge pull-right">{!! $count2[0]->qp_inactive !!}</span></a></li>

				</ul>
			</div>

			<div class="col-md-10 ">

				<div class="panel panel-default margintop10">
  					<div class="panel-heading">
  						<h4 class="text-danger">COLLEGE DEGREE LIST </h4>
  					</div>
  					<div class="panel-body">
  						<div class="row">
					<div class="col-md-12">
            			
            				@if($status == 'active' )
            				
                			<ul id="tree1">
  							@foreach($degree as $dk => $dv)
                				<li><a href="#">{{$degree[$dk]['degree']}}</a>
                					<ul>
                				            	@foreach($branch as $b2k => $b2v)
                				            	@if( $degree[$dk]['degree'] == $branch[$b2k]['degree'])
                				                <li>{{$branch[$b2k]['branch']}}
                				                	<ul>
                				                		@foreach($year as $yk => $yv)
                				                		@if( $branch[$b2k]['course_id'] == $year[$yk]['course_id'])
                				                		<li><a href="/index.php/college/view_batch/{!! $year[$yk]['batch_id'] !!}">{{ $year[$yk]['batch'] }}</a></li>
                				                		@endif
                				                		@endforeach
                				                	</ul>
                				                </li>
                				                @endif
                				                @endforeach
               				 		</ul>	
                				</li>
                			@endforeach
                			</ul>
  							@endif
            			
        			</div>
				</div>
  					</div>
				</div>
				
			</div>
		</div>



	</div>
</div>

@stop