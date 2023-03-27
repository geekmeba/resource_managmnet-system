

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <b><?php echo $this->session->userdata('role') ?></b> 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->


        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            
            <?php if($this->session->userdata('role') == 'Store Manager' || $this->session->userdata('role') == 'Department Head' || $this->session->userdata('role') == 'Store Keeper'): ?>
            <div class="small-box bg-aqua">
              <div class="inner">
               
                  <h3><?php echo $total_active_items; ?></h3>
                <p>Total Active Items</p>
              </div>
              <div class="icon">
                <i class="ion ion-cube"></i>
              </div>
              <a href="<?php echo base_url('Items') ?>" class="small-box-footer"><strong> More info <i class="fa fa-arrow-circle-right"></i> </strong></a>
            </div>
            <?php else: ?>

              <div class="small-box bg-aqua">
              <div class="inner">
               
                  <h3><?php echo $myapproved; ?></h3>
                <p>My Approved Requests</p>
              </div>
              <div class="icon">
                <i class="ion ion-check"></i>
              </div>
              <a href="<?php echo base_url('Loans/myapproved') ?>" class="small-box-footer"><strong> More info <i class="fa fa-arrow-circle-right"></i> </strong></a>
            </div>

          <?php endif; ?>
          </div>

          
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <?php if($this->session->userdata('role') == 'Store Manager' || $this->session->userdata('role') == 'Department Head'): ?>
            <div class="small-box bg-green">
              <div class="inner">
        
                  <h3><?php echo $total_loan_requests; ?></h3>
                <p>Total Loan Requests</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo base_url('Loans/approve') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>

            <?php elseif($this->session->userdata('role') == 'Store Keeper'): ?>

              <div class="small-box bg-green">
              <div class="inner">
        
                  <h3><?php echo $total_return; ?></h3>
                <p>Return Items</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo base_url('Loans/returnitem') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>

            <?php else: ?>

              <div class="small-box bg-green">
              <div class="inner">
        
                  <h3><?php echo $mypending; ?></h3>
                <p>My Pending Requests</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo base_url('Loans/pending') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          <?php endif; ?>


          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->

            <?php if($this->session->userdata('role') == 'Store Manager' || $this->session->userdata('role') == 'Department Head'): ?>

            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo $total_users; ?></h3>

                <p>Total Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-people"></i>
              </div>
              <a href="<?php echo base_url('Users/') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>


            <?php elseif($this->session->userdata('role') == 'Store Keeper'): ?>
              <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo $approved; ?></h3>

                <p>Approved Requests</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-people"></i>
              </div>
              <a href="<?php echo base_url('Loans/approved') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>

            <?php else: ?>

              <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo $myhistory; ?></h3>

                <p>My Loan History</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-people"></i>
              </div>
              <a href="<?php echo base_url('Loans/myhistory') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          <?php endif; ?>

          </div>
          <!-- ./col -->
          
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->

             <?php if($this->session->userdata('role') == 'Staff Member'): ?>
            <div class="small-box bg-red">
              <div class="inner">
                <h3><i class="ion ion-forward"></i></h3>

                <p>Submit Loan Request</p>
              </div>
              <div class="icon">
                <i class="ion ion-forward"></i>
              </div>
              <a href="<?php echo base_url('Loans') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>

             <?php elseif($this->session->userdata('role') == 'Store Manager' || $this->session->userdata('role') == 'Department Head' ): ?>

              <div class="small-box bg-red">
              <div class="inner">
                <h3><i class="ion ion-forward"></i></h3>

                <p>Register User</p>
              </div>
              <div class="icon">
                <i class="ion ion-forward"></i>
              </div>
              <a href="<?php echo base_url('Users/create') ?>" class="small-box-footer">Click here <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <?php else: ?>
                            <div class="small-box bg-red">
              <div class="inner">
                <h3><i class="ion ion-forward"></i></h3>

                <p>Register New Item</p>
              </div>
              <div class="icon">
                <i class="ion ion-forward"></i>
              </div>
              <a href="<?php echo base_url('Items/create') ?>" class="small-box-footer">Click here <i class="fa fa-arrow-circle-right"></i></a>
            </div>

          <?php endif; ?>

          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
   
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
    $(document).ready(function() {
      $("#dashboardMainMenu").addClass('active');
    }); 
  </script>
