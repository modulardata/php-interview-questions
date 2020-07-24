<?php echo $this->load->view('home/header'); ?>
<?php echo $this->load->view('home/agent_header'); ?>
<!-----  Top destination content ----->
 <link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/customagent.css">
<div class="accountCntr">
  <div class="container"> 
    
    <!--hotel search section-->
    <div class="row">
      
      <div class="col-md-12">

          <h2 class="agentHdng">My Booking</h2>
          <div class="white-container padding20">
				<!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li class="active"><a href="#htl_bkngs" data-toggle="tab">HOTEL BOOKINGS</a></li>
  <li><a href="#flt_bkngs" data-toggle="tab">FLIGHT BOOKINGS</a></li>
  <li><a href="#bus_bkngs" data-toggle="tab">BUS BOOKINGS</a></li>
  <li><a href="#car_bkngs" data-toggle="tab">CAR BOOKINGS</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="htl_bkngs">
  		<div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Booking Number</th>
            <th>Booking Date</th>
            <th>Checkin</th>
            <th>Checkout</th>
            <th>Status</th>
            <th>Cancel Till</th>
            <th>Amount</th>
            <th>Net Amount</th>
            <th>Margin</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>03434</td>
            <td>17-02-2014</td>
            <td>19-02-2014</td>
            <td>23-02-2014</td>
            <td>Active</td>
            <td>23-02-2014</td>
            <td>Rs.19000</td>
            <td>15652</td>
            <td>12</td>
            <td class="action"><a href="#" title="Delete"><i class="fa fa-trash-o"></i></a><a href="#" title="Edit"><i class="fa fa-edit"></i></a></td>
          </tr>
          <tr>
            <td>03434</td>
            <td>17-02-2014</td>
            <td>19-02-2014</td>
            <td>23-02-2014</td>
            <td>Active</td>
            <td>23-02-2014</td>
            <td>Rs.19000</td>
            <td>15652</td>
            <td>12</td>
            <td class="action"><a href="#" title="Delete"><i class="fa fa-trash-o"></i></a><a href="#" title="Edit"><i class="fa fa-edit"></i></a></td>
          </tr>
          <tr>
            <td>03434</td>
            <td>17-02-2014</td>
            <td>19-02-2014</td>
            <td>23-02-2014</td>
            <td>Active</td>
            <td>23-02-2014</td>
            <td>Rs.19000</td>
            <td>15652</td>
            <td>12</td>
            <td class="action"><a href="#" title="Delete"><i class="fa fa-trash-o"></i></a><a href="#" title="Edit"><i class="fa fa-edit"></i></a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="tab-pane" id="flt_bkngs">
  		<div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Booking Number</th>
            <th>Booking Date</th>
            <th>Checkin</th>
            <th>Checkout</th>
            <th>Status</th>
            <th>Cancel Till</th>
            <th>Amount</th>
            <th>Net Amount</th>
            <th>Margin</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          
          <tr>
            <td>4343</td>
            <td>17-02-2014</td>
            <td>19-02-2014</td>
            <td>23-02-2014</td>
            <td>Active</td>
            <td>23-02-2014</td>
            <td>Rs.19000</td>
            <td>15652</td>
            <td>12</td>
            <td class="action"><a href="#" title="Delete"><i class="fa fa-trash-o"></i></a><a href="#" title="Edit"><i class="fa fa-edit"></i></a></td>
          </tr>
          <tr>
            <td>57647</td>
            <td>17-02-2014</td>
            <td>19-02-2014</td>
            <td>23-02-2014</td>
            <td>Active</td>
            <td>23-02-2014</td>
            <td>Rs.19000</td>
            <td>15652</td>
            <td>12</td>
            <td class="action"><a href="#" title="Delete"><i class="fa fa-trash-o"></i></a><a href="#" title="Edit"><i class="fa fa-edit"></i></a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="tab-pane" id="bus_bkngs">
  		<table class="table table-bordered">
        <thead>
          <tr>
            <th>Booking Number</th>
            <th>Booking Date</th>
            <th>Checkin</th>
            <th>Checkout</th>
            <th>Status</th>
            <th>Cancel Till</th>
            <th>Amount</th>
            <th>Net Amount</th>
            <th>Margin</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          
          
          <tr>
            <td>89786</td>
            <td>17-02-2014</td>
            <td>19-02-2014</td>
            <td>23-02-2014</td>
            <td>Active</td>
            <td>23-02-2014</td>
            <td>Rs.19000</td>
            <td>15652</td>
            <td>12</td>
            <td class="action"><a href="#" title="Delete"><i class="fa fa-trash-o"></i></a><a href="#" title="Edit"><i class="fa fa-edit"></i></a></td>
          </tr>
        </tbody>
      </table>
  </div>
  <div class="tab-pane" id="car_bkngs">
  		<table class="table table-bordered">
        <thead>
          <tr>
            <th>Booking Number</th>
            <th>Booking Date</th>
            <th>Checkin</th>
            <th>Checkout</th>
            <th>Status</th>
            <th>Cancel Till</th>
            <th>Amount</th>
            <th>Net Amount</th>
            <th>Margin</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>2324</td>
            <td>17-02-2014</td>
            <td>19-02-2014</td>
            <td>23-02-2014</td>
            <td>Active</td>
            <td>23-02-2014</td>
            <td>Rs.19000</td>
            <td>15652</td>
            <td>12</td>
            <td class="action"><a href="#" title="Delete"><i class="fa fa-trash-o"></i></a><a href="#" title="Edit"><i class="fa fa-edit"></i></a></td>
          </tr>
          <tr>
            <td>56676</td>
            <td>17-02-2014</td>
            <td>19-02-2014</td>
            <td>23-02-2014</td>
            <td>Active</td>
            <td>23-02-2014</td>
            <td>Rs.19000</td>
            <td>15652</td>
            <td>12</td>
            <td class="action"><a href="#" title="Delete"><i class="fa fa-trash-o"></i></a><a href="#" title="Edit"><i class="fa fa-edit"></i></a></td>
          </tr>
          <tr>
            <td>097343</td>
            <td>17-02-2014</td>
            <td>19-02-2014</td>
            <td>23-02-2014</td>
            <td>Active</td>
            <td>23-02-2014</td>
            <td>Rs.19000</td>
            <td>15652</td>
            <td>12</td>
            <td class="action"><a href="#" title="Delete"><i class="fa fa-trash-o"></i></a><a href="#" title="Edit"><i class="fa fa-edit"></i></a></td>
          </tr>
          <tr>
            <td>097343</td>
            <td>17-02-2014</td>
            <td>19-02-2014</td>
            <td>23-02-2014</td>
            <td>Active</td>
            <td>23-02-2014</td>
            <td>Rs.19000</td>
            <td>15652</td>
            <td>12</td>
            <td class="action"><a href="#" title="Delete"><i class="fa fa-trash-o"></i></a><a href="#" title="Edit"><i class="fa fa-edit"></i></a></td>
          </tr>
        </tbody>
      </table>
  </div>
</div>
          </div>     
          
      </div>
      
    </div>
  </div>
</div>
</div>

<!-- FOOTER --><?php echo $this->load->view('home/footer'); ?>

