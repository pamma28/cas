 <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url('upload/images/'.$this->session->userdata('photo'));?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$this->session->userdata('name');?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="#"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-wrench"></i> <span>Servis</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=base_url('Customer/Service');?>">Ajukan Servis</a></li>
            <li><a href="#">Daftar Servis</a></li>
          </ul>
        </li>
        <li><a href="#"><i class="fa fa-shopping-cart"></i> <span>Pembelian</span></a></li>
        <li><a href="#"><i class="fa fa-user"></i> <span>Setting Akun</span></a></li>
      </ul>