<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Loan 
      <small>Report</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Dashboard') ?>"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Loan Report</li>
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
            <h3 class="box-title">Loan History</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Loned At</th>
                <th>Loned By</th>
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
        <h4 class="modal-title">Loan Report</h4>
      </div>

        <div class="modal-body">
          <div id="messages"></div>

          <div class="form-group">
            <b><i>Item Name:-</i></b>  <label id="item_name"></label>
          </div>

          <div class="form-group">
            <b><i>Loaned By:-</i></b> <label id="loaned_by"></label>
          </div>

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

          <div class="form-group">
            <b><i>Loan Confirmed By:-</i></b> <label id="confirmed_by"></label>
          </div>

          <div class="form-group">
            <b><i>Loan Confirmed At:-</i></b> <label id="confirmed_at"></label>
          </div>

          <div class="form-group">
            <b><i>Returned At:-</i></b> <label id="returned_at"></label>
          </div>

          <div class="form-group">
            <b><i>Return Confirmed By:-</i></b> <label id="return_confirmed_by"></label>
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
    'ajax': 'Reports/fetchreportData',
    'order': []
  });
  });



     function reportFunc(id)
{ 
  $.ajax({
    url: 'Reports/fetchItemDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      document.getElementById("item_name").innerHTML = response.Item_name;
      document.getElementById("loaned_by").innerHTML = response.First_name +'  '+response.Last_name; 
      document.getElementById("requested_at").innerHTML = response.Date_requested;
      document.getElementById("requested_quantity").innerHTML = response.requested_quantity;


    }
  });

    $.ajax({
    url: 'Reports/fetchApprovalDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      document.getElementById("approved_by").innerHTML = response.First_name +'  '+response.Last_name; 
      document.getElementById("approved_at").innerHTML = response.Date_approved; 
      

    }
  });


      $.ajax({
    url: 'Reports/fetchConfirmationDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      document.getElementById("confirmed_by").innerHTML = response.First_name +'  '+response.Last_name; 
      document.getElementById("confirmed_at").innerHTML = response.Confirmed_date; 
      

    }
  });  


      $.ajax({
    url: 'Reports/fetchReturnDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      document.getElementById("return_confirmed_by").innerHTML = response.First_name +'  '+response.Last_name; 
      document.getElementById("returned_at").innerHTML = response.Date_returned; 
      

    }
  });   


}
</script>