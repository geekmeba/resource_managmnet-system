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
        Create
        <small>user</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('Users/') ?>"><i class="fa fa-users"></i>Users</a></li>
        <li class="active">Create User</li>
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
              <h3 >User Information</h3>
            </div>
            <!-- /.box-header -->
            <form id="createuserform" role="form" action="<?php base_url('Items/create') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group required">
                  <label for="fname" class="control-label" >First Name</label>
                  <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" autocomplete="off" required>
                </div>

                <div class="form-group required">
                  <label for="lname" class="control-label" >Last Name</label>
                  <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" autocomplete="off" required>
                </div>

                <div class="form-group required">
                  <label for="email" class="control-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" autocomplete="off" required>
                </div>                


                <div class="form-group required">
                  <label for="phno" class="control-label">Phone No.</label><br>
                  <small><i>(e.g. +25100000000)</i></small>
                  <input type="text" class="form-control" id="phno" name="phno" placeholder="Phone No." autocomplete="off" required>
                </div>

                  <div class="form-group required" >
                  <label for="role" class="control-label">Role</label>
                  <select class="form-control" id="role" name="role" required>
                    <option disabled >--Select User Role--</option>
                      <option value="Store Manager">Store Manager</option>
                      <option value="Store Keeper">Store Keeper</option>
                      <option value="Department Head">Department Head</option>
                      <option value="Staff Member">Staff Member</option>
                  </select>
                </div>

                <div class="form-group required">
                  <label for="uname" class="control-label">Username</label>
                  <input type="text" class="form-control" id="uname" name="uname" placeholder="User Name" autocomplete="off" required>
                </div>

                <div class="form-group required">
                  <label for="pass" class="control-label">Password</label>
                  <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" autocomplete="off" required>
                </div>

                <div class="form-group required">
                  <label for="cpass" class="control-label">Confirm Password</label>
                  <input type="password" class="form-control" id="cpass" name="cpass" placeholder="Confirm Password" autocomplete="off" required>
                </div>


                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="<?php echo base_url('Users/') ?>" class="btn btn-warning">Back</a>
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

 
<script type="text/javascript">
  $(document).ready(function() {
    

     $('#createuserform').bootstrapValidator({
    message: 'This value is not valid',
    fields: {
      fname: {
                validators: {
                    notEmpty: {
                        message: 'First name is required and can\'t be empty'
                    },
                    
                   regexp: {
                    regexp: /^[a-zA-Z\.]+$/,
                    message: 'Firstname can only consist of alphabetical'
                }
                }
            },

            
            lname: {
             
                validators: {
                    notEmpty: {
                        message: 'Last name is required and can\'t be empty'
                    },
                    
                    regexp: {
                    regexp: /^[a-zA-Z\.]+$/,
                    message: 'Lastname can only consist of alphabetical'
                }
                }
            },
     
       email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
        
        phno: {
            validators: {
                notEmpty: {
                    message: 'Phone number is required and can\'t be empty'
                },
                stringLength: {
                    min: 13,
                    max: 13,
                    message: 'Mobile number must be 13 digits long'
                },
                 regexp: {
                    regexp: /^[0-9\-\+]+$/,
                    message: 'Phone can only consist of digits,plus and hiphen'
                }
               
            }
        },
        
            uname: {
                    
                    validators: {
                    notEmpty: {
                        message:'Username is required and can\'t be empty'
                    }
                }
                
            },
            
           pass: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    },
                    identical: {
                        field: 'cpassword',
                        message: 'The password and its confirm are not the same'
                    }
                }
            },
            cpass: {
                validators: {
                    notEmpty: {
                        message: 'The confirm password is required and can\'t be empty'
                    },
                    identical: {
                        field: 'pass',
                        message: 'The password and its confirm are not the same'
                    }
                }
            }


    }
});
  
  });
</script>

