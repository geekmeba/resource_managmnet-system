<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li id="dashboardMainMenu">
          <a href="<?php echo base_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

          <?php if($this->session->userdata('role') == 'Store Manager' || $this->session->userdata('role') == 'Store Keeper' || $this->session->userdata('role') == 'Department Head'): ?>

            <li class="treeview" id="mainUserNav">
            <a href="#">
               <i class="fa fa-cube"></i>
              <span>Items</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-down pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">

            	
              <li id="manageUserNav"><a href="<?php echo base_url('Items')?>"><i class="fa fa-check"></i> Active Items</a></li>
         

              
                <li id="manageGroupNav"><a href="<?php echo base_url('Items/inactive') ?>"><i class="fa fa-times"></i> Inactive Items</a></li>
                

              
            </ul>
          </li>
        <?php endif; ?>
       
          <?php if($this->session->userdata('role') == 'Store Manager' || $this->session->userdata('role') == 'Department Head' ): ?>
  	
            <li id="storeNav">
              <a href="<?php echo base_url('Users/') ?>">
                <i class="fa fa-users"></i> <span>Users</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if($this->session->userdata('role') == 'Staff Member'): ?>
         
        <li class="treeview" id="mainUserNav">
            <a href="#">
               <i class="fa fa-folder-o"></i>
              <span>Loans</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-down pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">

              
              <li id="manageUserNav"><a href="<?php echo base_url('Loans')?>"><i class="fa fa-send"></i> Submit new request</a></li>
         
              <li id="manageGroupNav"><a href="<?php echo base_url('Loans/pending') ?>"><i class="fa fa-hourglass"></i>My pending requests</a></li>

              <li id="manageGroupNav"><a href="<?php echo base_url('Loans/myapproved') ?>"><i class="fa fa-check"></i>My approved requests</a></li>

               <li id="manageGroupNav"><a href="<?php echo base_url('Loans/myapproved') ?>"><i class="fa fa-times"></i>My rejected requests</a></li>

              <li id="manageGroupNav"><a href="<?php echo base_url('Loans/oweitems') ?>"><i class="fa fa-suitcase"></i>Items on hand</a></li>

              <li id="manageGroupNav"><a href="<?php echo base_url('Loans/myhistory') ?>"><i class="fa fa-user"></i>My loan history</a></li>
                

              
            </ul>
          </li>
        <?php endif; ?>


            <?php if($this->session->userdata('role') == 'Store Manager' || $this->session->userdata('role') == 'Department Head'): ?>
            <li id="mainOrdersNav">
              <a href="<?php echo base_url('Loans/approve') ?>">
              <i class="fa fa-check"></i><span>Approve Requests</span></a>
            </li>
          <?php endif; ?>

            <?php if($this->session->userdata('role') == 'Store Keeper'): ?>             
            <li id="mainOrdersNav">
              <a href="<?php echo base_url('Loans/approved') ?>">
              <i class="fa fa-check"></i><span>Approved Requests</span></a>
            </li>
          <?php endif; ?>
          


         
            <?php if($this->session->userdata('role') == 'Store Manager' || $this->session->userdata('role') == 'Department Head'): ?>
       
            <li id="reportNav">
              <a href="<?php echo base_url('Reports') ?>">
                <i class="glyphicon glyphicon-stats"></i> <span>Report</span>
              </a>
            </li>

          <?php endif; ?>


            <?php if($this->session->userdata('role') == 'Store Keeper'): ?>
             <li id="reportNav">
              <a href="<?php echo base_url('Loans/returnitem') ?>">
                <i class="fa fa-times"></i> <span>Return Item</span>
              </a>
            </li>
          <?php endif; ?>
                  

       
        <li><a href="<?php echo base_url('Users/profile') ?>"><i class="glyphicon glyphicon-user"></i> <span>My profile</span></a></li>
        


        <li><a href="<?php echo base_url('auth/logout') ?>"><i class="glyphicon glyphicon-log-out"></i> <span>Logout</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>