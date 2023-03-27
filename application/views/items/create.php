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
        <small>item</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('Items'); ?>"><i class="fa fa-cube"></i> Active Items</a></li>
        <li class="active">Create Item</li>
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
              <h3 >item Information</h3>
            </div>
            <!-- /.box-header -->
            <form id="createitemform" role="form" action="<?php base_url('Items/create') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group required">
                  <label for="iname" class="control-label" >Item Name</label>
                  <input type="text" class="form-control" id="iname" name="iname" placeholder="Item Name" autocomplete="off" required>
                </div>

                <div class="form-group required">
                  <label for="model" class="control-label">Item Model</label>
                  <input type="text" class="form-control" id="model" name="model" placeholder="Item model" autocomplete="off" required>
                </div>                

                <div class="form-group required">
                  <label for="quantity" class="control-label">Item Quantity</label>
                  <input type="number" class="form-control" id="quantity" name="quantity" placeholder="0" autocomplete="off" required>
                </div>

                <div class="form-group required">
                  <label for="type" class="control-label">Item Type</label>
                  <input type="text" class="form-control" id="type" name="type" placeholder="Item type" autocomplete="off" required>
                </div>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="<?php echo base_url('Items') ?>" class="btn btn-warning">Back</a>
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
    

     $('#createitemform').bootstrapValidator({
    message: 'This value is not valid',
    fields: {
      iname: {
                validators: {
                    notEmpty: {
                        message: 'Item name is required and can\'t be empty'
                    },
                    
                   regexp: {
                    regexp: /^[a-zA-Z\.]+$/,
                    message: 'Itemname can only consist of alphabetical'
                }
                }
            },
            model: {
                validators: {
                    notEmpty: {
                        message: 'Item model is required and can\'t be empty'
                    },
                    
                   regexp: {
                    regexp: /^[a-zA-Z\.]+$/,
                    message: 'Itemmodel can only consist of alphabetical'
                }
                }
            },

   type: {
                validators: {
                    notEmpty: {
                        message: 'Item type is required and can\'t be empty'
                    },
                    
                   regexp: {
                    regexp: /^[a-zA-Z\.]+$/,
                    message: 'Itemtype can only consist of alphabetical'
                }
                }
            }




    }
});
  
  });
</script>


 
