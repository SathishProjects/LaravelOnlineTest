<!-- Vijay deva -->
@extends('layouts.layout_login')
@section('content')

<style type="text/css">
.table {
     margin-bottom: 0; 
}
  .panel
{
    text-align: center;
}
.panel:hover { box-shadow: 0 1px 5px rgba(0, 0, 0, 0.4), 0 1px 5px rgba(130, 130, 130, 0.35); }
.panel-body
{
    padding: 0px;
    text-align: center;
}

.the-price
{
    background-color: rgba(220,220,220,.17);
    box-shadow: 0 1px 0 #dcdcdc, inset 0 1px 0 #fff;
    padding: 20px;
    margin: 0;
}

.the-price h1
{
    line-height: 1em;
    padding: 0;
    margin: 0;
}

.subscript
{
    font-size: 25px;
}

/* CSS-only ribbon styles    */
.cnrflash
{
    /*Position correctly within container*/
    position: absolute;
    top: -9px;
    right: 4px;
    z-index: 1; /*Set overflow to hidden, to mask inner square*/
    overflow: hidden; /*Set size and add subtle rounding      to soften edges*/
    width: 100px;
    height: 100px;
    border-radius: 3px 5px 3px 0;
}
.cnrflash-inner
{
    /*Set position, make larger then      container and rotate 45 degrees*/
    position: absolute;
    bottom: 0;
    right: 0;
    width: 145px;
    height: 145px;
    -ms-transform: rotate(45deg); /* IE 9 */
    -o-transform: rotate(45deg); /* Opera */
    -moz-transform: rotate(45deg); /* Firefox */
    -webkit-transform: rotate(45deg); /* Safari and Chrome */
    -webkit-transform-origin: 100% 100%; /*Purely decorative effects to add texture and stuff*/ /* Safari and Chrome */
    -ms-transform-origin: 100% 100%;  /* IE 9 */
    -o-transform-origin: 100% 100%; /* Opera */
    -moz-transform-origin: 100% 100%; /* Firefox */
    background-image: linear-gradient(90deg, transparent 50%, rgba(255,255,255,.1) 50%), linear-gradient(0deg, transparent 0%, rgba(1,1,1,.2) 50%);
    background-size: 4px,auto, auto,auto;
    background-color: #aa0101;
    box-shadow: 0 3px 3px 0 rgba(1,1,1,.5), 0 1px 0 0 rgba(1,1,1,.5), inset 0 -1px 8px 0 rgba(255,255,255,.3), inset 0 -1px 0 0 rgba(255,255,255,.2);
}
.cnrflash-inner:before, .cnrflash-inner:after
{
    /*Use the border triangle trick to make         it look like the ribbon wraps round it's        container*/
    content: " ";
    display: block;
    position: absolute;
    bottom: -16px;
    width: 0;
    height: 0;
    border: 8px solid #800000;
}
.cnrflash-inner:before
{
    left: 1px;
    border-bottom-color: transparent;
    border-right-color: transparent;
}
.cnrflash-inner:after
{
    right: 0;
    border-bottom-color: transparent;
    border-left-color: transparent;
}
.cnrflash-label
{
    /*Make the label look nice*/
    position: absolute;
    bottom: 0;
    left: 0;
    display: block;
    width: 100%;
    padding-bottom: 5px;
    color: #fff;
    text-shadow: 0 1px 1px rgba(1,1,1,.8);
    font-size: 0.95em;
    font-weight: bold;
    text-align: center;
}

</style>

<div class="container">
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="account-wall">
                <div id="my-tab-content" class="tab-content">

                  <div class="tab-pane active" id="login">
                  
                    <center>

                  <a href="/"><img style="max-width: 280px;" class="image_responsive logo_response" src="/images/logo.png" alt="logo"/></a>
                  <h4> Welcome ! to first.jobs </h4>  

                  <span class="text-center">( Please select your subscription type )</span><br><br>

                  </center> 
                                    
                  
                 

               

                  <div class="form-group ">
                    <div class="row">
                      <div class="col-xs-12" style="padding: 15px 5% 15px 5%;">
                         <div class="col-xs-12 col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Trial</h3>
                </div>
                <div class="panel-body">
                    <div class="the-price">
                        <h1>
                            <i class="fa fa-inr" aria-hidden="true"></i> Free <span class="subscript">/ 3 mo</span> </h1>
                        <small></small>
                    </div>
                    <table class="table">
                        <tr>
                            <td>
                                 <span class=""> <b>500</b> </span> - Access to student Profile
                            </td>
                        </tr>
                        <tr class="active">
                            <td>
                              <span class=""> <b>0</b> </span> - Online Aptitude Test 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 <span class=""> <b>500</b> </span> - Email Alerts to student
                            </td>
                        </tr>
                        <tr class="active">
                            <td>
                                <span class=""> <b>0</b> </span> - SMS Alerts to student
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 <span class=""> <b>0</b> </span> - Online Test-Technical/Domain
                            </td>
                        </tr>
                       
                    </table>
                </div>
                <div class="panel-footer">
                {!! Form :: open(['url' => 'subscription/buy_package', 'id'=>'try']) !!}
                    <?php
                        $a= base64_encode('1');
                        $b= base64_encode('2');
                        $c= base64_encode('0');
                    ?>
                    <input type="hidden" value="{{ $a }}" name="sub_type">
                    <input type="hidden" value="{{ $college_id }}" name="user_id">
                    <input type="hidden" value="{{ $b }}" name="user_type">
                    <input type="hidden" value="{{ $c }}" name="amount">
                    <input type="hidden" value="{{ $c }}" name="use_of_pack">
                    <a type="button" class="btn btn-primary" onclick="document.getElementById('try').submit()">Try</a>
                    {!! Form::close() !!}
                 <!--    <button class="btn btn-primary" type="submit" name="subscription_type" value="1" >Try</button> -->
                    </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="panel panel-success">
                <div class="cnrflash">
                    <div class="cnrflash-inner">
                        <span class="cnrflash-label">Free 
                            <br>
                            3 Events*</span>
                    </div>
                </div>
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Premium</h3>
                </div>
                <div class="panel-body">
                    <div class="the-price">
                        <h1>
                            <i class="fa fa-inr" aria-hidden="true"></i>30000<span class="subscript">/ 3 mo</span></h1>
                        <small></small>
                    </div>
                   <table class="table">
                        <tr>
                            <td>
                                 <span class=""> <b>10,000</b> </span> - Access to student Profile
                            </td>
                        </tr>
                        <tr class="active">
                            <td>
                              <span class=""> <b>1</b> </span> - Online Aptitude Test 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 <span class=""> <b>10,000 </b></span> - Email Alerts to student
                            </td>
                        </tr>
                        <tr class="active">
                            <td>
                                <span class=""> <b>10,000</b> </span> - SMS Alerts to student
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 <span class=""> <b>1</b> </span> - Online Test-Technical/Domain
                            </td>
                        </tr>
                       
                    </table>
                </div>
                <div class="panel-footer">
                <button class="btn btn-success" data-toggle="modal" data-target="#myModal" type="submit" name="subscription_type" value="2" >Purchase</button>
                    
                    </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Enterprise</h3>
                </div>
                <div class="panel-body">
                    <div class="the-price">
                        <h1>
                            <i class="fa fa-inr" aria-hidden="true"></i>120000<span class="subscript">/ 1 Yr</span></h1>
                        <small></small>
                    </div>
                    <table class="table">
                        <tr>
                            <td>
                                 <span class=""> <b>Unlimited</b> </span> - Access to student Profile
                            </td>
                        </tr>
                        <tr class="active">
                            <td>
                              <span class=""> <b>5</b> </span> - Online Aptitude Test 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 <span class=""> <b>1,00,000</b> </span> - Email Alerts to student
                            </td>
                        </tr>
                        <tr class="active">
                            <td>
                                <span class=""> <b>1,00,000</b> </span> - SMS Alerts to student
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 <span class=""> <b>5</b> </span> - Online Test-Technical/Domain
                            </td>
                        </tr>
                       
                    </table>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-info" data-toggle="modal" data-target="#myModal" type="submit" name="subscription_type" value="3" >Purchase</button>
            </div>
        </div>
                      </div>
                    </div>
                  </div>

                       

                        

                  </div>



                </div>


            </div>
        </div>
        <div class="col-lg-1 "></div>
    </div>
</div>




<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Account Details</h4>
      </div>
      <div class="modal-body">
     
        <p>Payment can be sent through EFT from Banks in India using the following account details. </p>
<pre>
<b>Account Name:</b> Techruit Technologies <br>
<b>Current Account No:</b> 6325616858<br>
<b>Bank :</b> Indian Bank<br>
<b>Branch:</b> Nesapakkam Branch<br>
<b>IFSC Code :</b> IDIB000N122<br>
<b>Phone :</b> 7401746525
</pre>
<b>Address</b><br>
Techruit Technologies<br>
5 A , First Floor, Reddy Street<br>
Virugambakkam, Chennai - 600092<br>
Email: ajbala@techruit.in / prmadhan@techruit.in<br>
Mobile: 7401746525 / 98848 12328 / 98410 32400<br>
<br>

        
                
          <center><b> Note : Our first.jobs support team will contact you for verification and use the trial pack till your subscription pack gets alive.</b></center>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@stop