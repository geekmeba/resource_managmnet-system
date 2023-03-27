

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User
        <small>Information</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('Users'); ?>"><i class="fa fa-users"></i> Users</a></li>
        <li class="active">User Information</li>
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
                  <th>First Name</th>
                  <td><?php echo $user_info['First_name']; ?></td>
                </tr>
                <tr>
                  <th>Last Name</th>
                  <td><?php echo $user_info['Last_name']; ?></td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td><?php echo $user_info['Email']; ?></td>
                </tr>
                <tr>
                  <th>Phone No.</th>
                  <td><?php echo $user_info['Phone_number']; ?></td>
                </tr>
                <tr>
                  <th>Role</th>
                  <td><?php echo $user_info['Role']; ?></td>
                </tr>
                <tr>
                  <th>Start Date</th>
                  <td><?php echo $startdate; ?></td>
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

 
