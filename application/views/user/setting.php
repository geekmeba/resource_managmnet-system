<style> 
.form-group.required .control-label:after{
	content: " * ";
	color: red;
}

</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User
        <small>Setting</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('Users/profile'); ?>"><i class="fa fa-user"></i> Profile</a></li>
        <li class="active">Edit profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-6 col-xs-12 col-md-offset-2">


          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>

          <div class="box" >
            <div class="box-header">
              <h3 >Update Information</h3>
            </div>
            <!-- /.box-header -->
             
            <form role="form" action="<?php base_url('Users/setting') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                
                <div class="form-group required">
                  <label for="fname" class="control-label">First name</label>
                  <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" value="<?php echo $user_data['First_name'] ?>" autocomplete="off" required>
                </div>

                <div class="form-group">
                  <label for="lname">Last name</label>
                  <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" value="<?php echo $user_data['Last_name'] ?>" autocomplete="off" required>
                </div>
                
                <div class="form-group required">
                  <label for="email" class="control-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $user_data['Email'] ?>" autocomplete="off" required>
                </div>                


                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?php echo $user_data['Phone_number'] ?>" autocomplete="off" required>
                </div>


                <div class="form-group">
                  <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      Leave the fields below empty if you don't want to change otherwise fill them.
                  </div>
                </div>

                <div class="form-group">
                  <label for="username" class="control-label" >Username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username"autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" required>
                </div>

                <div class="form-group">
                  <label for="cpassword">Confirm password</label>
                  <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" autocomplete="off" required>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('Users/profile') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
       
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  >
  


 
