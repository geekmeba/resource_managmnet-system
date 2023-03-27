<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      My Approved 
      <small>Requests</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Dashboard') ?>"><i class="fa fa-dashboard"></i>Home</a></li>
      <li><a href="#"><i class="fa fa-dashboard"></i>Loans</a></li>
      <li class="active">My Approved requests</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

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


        <div class="box">
          <div class="box-header">
            <h3 class="box-title">My Approved requests list</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Approved At</th>
                <th>Item Name</th>
                <th>Action</th>
              </tr>
              </thead>

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

<div class="modal fade" tabindex="-1" role="dialog" id="reportModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Approval Information</h4>
      </div>

        <div class="modal-body">
          <div id="messages"></div>


          <div class="form-group">
            <b><i>Requested At:-</i></b> <label id="requested_at"></label>
          </div>

          <div class="form-group">
            <b><i>Requested Quantity:-</i></b> <label id="requested_quantity"></label>
          </div>

          <div class="form-group">
            <b><i>Loan Approved By:-</i></b> <label id="approved_by"></label>
          </div>

          <div class="form-group">
            <b><i>Loan Approved At:-</i></b> <label id="approved_at"></label>
          </div>
          
        </div>


      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
   var manageTable;
  $(document).ready(function() { 
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable( {
    'ajax': 'fetchmyapprovedData',
    'order': []
  });
  });



     function reportFunc(id)
{ 
  $.ajax({
    url: 'fetchloanDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {
      document.getElementById("requested_at").innerHTML = response.Date_requested;
      document.getElementById("requested_quantity").innerHTML = response.requested_quantity;


    }
  });

  $.ajax({
    url: 'fetchapprovalDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {
      document.getElementById("approved_by").innerHTML = response.First_name +'  '+response.Last_name; 
      document.getElementById("approved_at").innerHTML = response.Date_approved; 
    }
  });

}
</script>