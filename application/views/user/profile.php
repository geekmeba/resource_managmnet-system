

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        My
        <small>Profile</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">My Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-8 col-xs-12 col-md-offset-1">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Profile</h3>

          		<a href="<?php echo base_url('Users/setting') ?>" class="pull pull-right"><i class="fa fa-edit"></i> <strong>Edit profile</strong> </a>
       	 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-condensed table-hovered">
                <tr>
                  <th>Username</th>
                  <td><?php echo $user_data['username']; ?></td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td><?php echo $user_data['Email']; ?></td>
                </tr>
                <tr>
                  <th>First Name</th>
                  <td><?php echo $user_data['First_name']; ?></td>
                </tr>
                <tr>
                  <th>Last Name</th>
                  <td><?php echo $user_data['Last_name']; ?></td>
                </tr>
                <tr>
                  <th>Phone</th>
                  <td><?php echo $user_data['Phone_number']; ?></td>
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

 
