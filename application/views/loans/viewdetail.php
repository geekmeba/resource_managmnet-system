

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Loan
        <small>Information</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('Loans/approve') ?>"><i class="fa fa-check"></i> Approve Requests</a></li>
        <li class="active">Loan Information</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-8 col-xs-12 col-md-offset-1">

          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-condensed table-hovered">
                <tr>
                  <th>Item Name</th>
                  <td><?php echo $loan_info['Item_name']; ?></td>
                </tr>
                <tr>
                  <th>Requested By</th>
                  <td><?php echo $loan_info['First_name'] .'  '.$loan_info['Last_name']; ?></td>
                </tr>
                <tr>
                  <th>Requested At</th>
                  <td><?php echo $Date_requested; ?></td>
                </tr>
                <tr>
                  <th>Requested Quantity</th>
                  <td><?php echo $loan_info['requested_quantity']; ?></td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 
