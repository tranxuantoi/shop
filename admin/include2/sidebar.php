 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
            <img src="../<?php echo $tk_info['anh'];?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $tk_info['taikhoan'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li class="active treeview">
            <a href="../index.php">
                <i class="fa fa-dashboard">
                    
                </i> <span>Dashboard</span>
           
          </a>
         
        </li>
       
      </ul>
        <?php 
        $query_pq="SELECT * FROM db_user WHERE id={$_SESSION['uid']}";
        $result_pq= mysqli_query($dbc, $query_pq);
        $query_row= mysqli_fetch_assoc($result_pq);
        $dem_pg=1;
         foreach ($mang as $mang_sidebar)
            {
                $tach_role= explode(",",$query_row['role']);
                foreach ($tach_role as $tach_role1)
                {
                    $tach_role2=explode("-",$tach_role1);
                    foreach ($tach_role2 as $tach_role3)
                    {
                        if($mang_sidebar['tieude']== $tach_role3)
                        {
                            ?>
      
                            <ul class="sidebar-menu" data-widget="tree">

                           <li class="active treeview">
                             <a href="#">
                               <i class="fa fa-fw fa-user"></i> <span><?php echo $mang_sidebar['tieude'];?></span>
                               <span class="pull-right-container">
                                 <i class="fa fa-angle-left pull-right"></i>
                               </span>
                             </a>
                             <ul class="treeview-menu">
                                 <li class="active"><a href="../<?php echo $mang_sidebar['link_add'];?>"><i class="fa fa-circle-o"></i>Thêm Mới </a></li>
                                 <li><a href="../<?php echo $mang_sidebar['link_list'];?>"><i class="fa fa-circle-o"></i>Danh Sách </a></li>
                             </ul>
                           </li>
                         </ul>
                        <?php
                        }
                    }
                }
                ?>
           
              <?php
              $dem_pg++;
            }
        ?>
     
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>