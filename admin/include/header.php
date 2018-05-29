<?php error_reporting(0);?>
<?php 
 
session_start();  

     include 'inc/connect.php';
        include 'inc/function_ordie.php';
    if(!isset($_SESSION['uid']))
    {
        header('Location:login.php');
        
    }
    else {
        include 'phanquyen/phanquyen.php';
        $query_user="SELECT * FROM db_user WHERE id={$_SESSION['uid']}";
        $result_user= mysqli_query($dbc, $query_user);
        kt_query($result_user, $query_user);
        $tk_info= mysqli_fetch_assoc($result_user);  
          
        $query_checkrole="SELECT * FROM db_user WHERE id={$_SESSION['uid']}";
        $result_checkrole= mysqli_query($dbc, $query_checkrole);
        $checkrole_row= mysqli_fetch_assoc($result_checkrole);
        $current_url=$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];  
        $current_url_tach= explode("/",$current_url);
        $current_url_tach2=$current_url_tach[3].'/'.$current_url_tach[4];
 
        
    $tm= count($current_url_tach);
        $dem_mt=1;
       
                if(isset($_GET['id']) || isset($_GET['s']))
                {
                    $current_url_tach2_id= explode("?",$current_url_tach2);
                    
                }
                $mangthaythe=array();
                $tachcheckrole= explode(",", $checkrole_row['role']);
                $dem_thay=1;
                foreach($tachcheckrole as $tachcheckrole_it)
                {
                    if($dem_thay>1)
                    {
                        $tachcheckrole2= explode("-", $tachcheckrole_it);
                        $mangthaythe[]=array(
                           'link1'=>$tachcheckrole2[1],
                           'link2'=>$tachcheckrole2[2],
                           'link3'=>$tachcheckrole2[3],
                           'link4'=>$tachcheckrole2[4],
                            'link5'=>$tachcheckrole2[5],
                            'link6'=>$tachcheckrole2[6],
                            'link7'=>$tachcheckrole2[7],
                   );
                   $okc=0;
                   foreach ($mangthaythe as $itemthay)
                   {
                       if(isset($_GET['id']))
                       {
                           if($current_url_tach2_id[0] == $itemthay['link3'] || $current_url_tach2_id[0] == $itemthay['link4'] || $current_url_tach2_id[0] == $itemthay['link5'] || $current_url_tach2_id[0] == $itemthay['link6'] || $current_url_tach2_id[0] == $itemthay['link7'])
                           {
                               $okc=1;
                               break;
                           }
                           
                       }
                       elseif(isset ($_GET['s']))
                       {
                           if($current_url_tach2_id[0]== $itemthay['link2'])
                           {
                               $okc=1;
                               break;
                           }
                       }
                       else
                       {
                           if($current_url_tach2== $itemthay['link1'] || $current_url_tach2== $itemthay['link2'])
                           {
                               $okc=1;
                               break;;
                           }
                       }
                    }
                    }
                    $dem_thay++;
                    
                }
                        
    }
        
     

 
   
    
    ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Shopper</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>--</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Quản Trị Shopper</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
         
              <li class="dropdown user user-menu">
              
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo $tk_info['anh'];?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $tk_info['hoten'];?></span>
            </a>
            <ul class="dropdown-menu">
            <!-- User image -->
              
              
                     <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-black" style="background: url('../dist/img/photo1.png') center center;">
              <h3 class="widget-user-username"><?php echo $tk_info['hoten'];?></h3>
              <h5 class="widget-user-desc">Quản Trị Viên</h5>
            </div>
            <div class="widget-user-image">
                <img class="img-circle" src="<?php echo $tk_info['anh'];?>" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                   <div class="description-block">
                       <h5 class="description-header">
                           Xin chào :    <?php echo $tk_info['hoten'];?>
                       </h5>
              
                 <span class="description-text">
                 
                  <small>Sinh Nhật  : <?php 
                   $tk_info['ngaysinh'];
                   $ngay_dangin=explode("-", $tk_info['ngaysinh']);
                   $ngay_dangout=$ngay_dangin[2].'-'.$ngay_dangin[1].'-'.$ngay_dangin[0];
                   echo $ngay_dangout;
                  ?> !! </small>
                 </span>
                   </div>
              </div>
              <!-- /.row -->
            </div>
         
                     </div>
            
              <!-- Menu Body -->
           
              <!-- Menu Footer-->
             
               <li class="user-footer">
                <div class="pull-left">
                    <a href="../admin/my_account.php" class="btn btn-default btn-flat">Thông Tin</a>
                </div>
                   <div class="pull-left">
                       <a href="../admin/doi_pass_tv.php" class="btn btn-default btn-flat">Đổi Pass</a>
                </div>
                <div class="pull-right">
                    <a href="sign_out.php" class="btn btn-default btn-flat">Đăng Xuất</a>
                </div>
              </li>
                     
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
           <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>