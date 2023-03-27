

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Item
        <small>Information</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-cube"></i>Active Items</a></li>
        <li class="active">Item Information</li>
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
                  <td><?php echo $item_info['Item_name']; ?></td>
                </tr>
                <tr>
                  <th>Item Model</th>
                  <td><?php echo $item_info['Model']; ?></td>
                </tr>
                <tr>
                  <th>Item Type</th>
                  <td><?php echo $item_info['Type']; ?></td>
                </tr>
                <tr>
                  <th>Avaliable Quantity</th>
                  <td><?php echo $item_info['Quantity']; ?></td>
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

 
