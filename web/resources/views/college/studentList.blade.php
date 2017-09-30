<!-- Vijay deva -->
@extends('layouts.layout_college')
@section('content')
<div class="container">
        <div class="row fj_mrg_1">
          <ol class="breadcrumb breadcrumb-arrow">
          <li><a href="../college/jobview" class="fj_fnt_6 fj_color_1"><i class="glyphicon glyphicon-arrow-left"></i> back</a></li>
            <li><a href="../college/dashboard" class="fj_fnt_6 fj_color_1"> <i class="glyphicon glyphicon-home"></i></a></li>
            <li class="">Eligible student list</li>
          </ol>
      </div>
</div>
<link rel="stylesheet" href="{{ asset('css/bootstrap-table.css') }}"/>   

  <script type="text/javascript" src="{{ asset('js/bootstrap-table.js') }}"></script>  

  <div class="container">
  <h4 style="margin-bottom: -45px;">Eligible Students list</h4>
    <table data-toggle="table"
       data-url="http://mikepenz.com/jsfiddle/"
       data-pagination="true"
       data-side-pagination="server"
       data-page-list="[10, 20, 50, 100, 200]"
       data-search="true"
       data-height="528" 
       data-show-refresh="true"
       data-show-toggle="true"
       data-show-columns="true"
       style="background-color: white">
    <thead>
    <tr>
        <th data-field="state" data-checkbox="true"></th>
        <th data-field="id" data-align="center" data-sortable="true">ID</th>
        <th data-field="name" data-align="center" data-sortable="true">Name</th>
        <th data-field="price" data-align="center" data-sortable="true" data-sortable="true">Gender</th>
        <th data-field="mobile" data-align="center" data-sortable="true" data-sortable="true">Mobile</th>
        <th data-field="total" data-align="center" data-sortable="true" data-sortable="true">Email</th>
        <th data-field="Department" data-align="center" data-sortable="true" data-sortable="true">Department</th>
    </tr>
    </thead>
</table>
</div>
@stop