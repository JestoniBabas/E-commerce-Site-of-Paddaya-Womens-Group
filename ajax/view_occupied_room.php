<?php
include '../db/dbh.php';

$room_ref = $_POST['room_ref'];

$ex = explode("-", $room_ref);

$room_type = $ex[0];
$room_no = $ex[1];

$get = $conn->query("SELECT * FROM check_in WHERE room_type='".$room_type."' AND room_no='".$room_no."'");
$get->execute();

if($get->rowCount() > 0){


$r = $get->fetch(PDO::FETCH_OBJ);

$x = explode("-", $r->xpected_out);
$xpected_out = $x[1]."-".$x[2]."-".$x[0];

$bal = $r->to_pay - $r->amount_given;
$coun = $r->num_stay - $r->stay_counter;

echo '
    <h1 class="text-center">'.$room_type.' '.$room_no.'</h1>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-info">
                    <h3><span class="glyphicon glyphicon-info-sign text-primary"></span> Basic info</h3>
                        <p><b>Full name:</b> '.$r->fname.' '.$r->mname.' '.$r->lname.' '.$r->xname.'</p>
                        <p><b>Address:</b> '.$r->address.'</p>
                        <p><b>Nationality:</b> '.ucfirst($r->nationality).'</p>
                        <p><b>Contact no.:</b> '.$r->contact_no.'</p>
                        <p><b>Email:</b> <a href="mailto:'.$r->email.'">'.$r->email.'</a></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="alert alert-success">
                    <h3><span class="glyphicon glyphicon-bed text-success"></span> More info</h3>
                        <p><b>Check-in date:</b> '.$r->in_date.'</p>
                        <p><b>Check-in time</b> '.$r->in_time.'</p>
                        <p><b>No. of stay:</b> '.$r->num_stay.'</p>
                        <p><b>Expected check-out:</b> '.$xpected_out.'</p>
                        <p><b>Check-in by:</b> '.$r->in_by.'</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-warning">
                    <h3><span class="glyphicon glyphicon-credit-card text-warning"></span> Room and Payments</h3>
                    <p><b>Total payables:</b> '.number_format($r->to_pay).'</p>
                    <p><b>Amount paid:</b> '.number_format($r->amount_given).'</p>
                    <p><b>Balance:</b> '.number_format($bal).'</p>
                    <br/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="alert alert-light">
                    <h3><span class="glyphicon glyphicon-star text-danger"></span> Closure</h3>
                    <p><b>Days/Nights stayed:</b> '.$r->stay_counter.'</p>
                    <p><b>Days/Nights left:</b> '.$coun.'</p>
                    
                        <div class="row">
                            <div class="col-md-6">
                                <br/>
                                <input type="number" name="out_amount_paid" id="out_amount_paid" class="form-control" onkeyup="to_pay_inp_out()" placeholder="To pay" required />
                                <input type="hidden" name="amount_given" id="amount_given" value="'.$r->amount_given.'" />
                                <input type="hidden" name="to_pay" id="to_pay" value="'.$bal.'"/>
                                <input type="hidden" name="in_id" id="in_id" value="'.$r->in_id.'"/>
                            </div>
                            <div class="col-md-6" align="right">
                                <br/>
                                <button type="button" onClick="btn_checkout()" id="btn_checkout" class="btn btn-danger">
                                    <b><span class="glyphicon glyphicon-log-out"></span> Check out</b>
                                </button>
                            </div>
                        </div>
                  </div>
            </div>
        </div>
    </div>
';

}