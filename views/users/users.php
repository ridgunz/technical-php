<!DOCTYPE html>
<html dir="ltr" lang="en">


<?php
session_start();
require_once '../../controller/users_controller.php';

$crud = new users();

$users = $crud->read();
$roles = $crud->roles();

?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex,nofollow">
  <title>Technical Test PHP</title>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="../../plugins/images/favicon.png">
  <!-- Custom CSS -->
  <link href="../../css/style.min.css" rel="stylesheet">

  <!-- Include Bootstrap CSS and JS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Include SweetAlert CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
</head>

<body>
  <!-- ============================================================== -->
  <!-- Preloader - style you can find in spinners.css -->
  <!-- ============================================================== -->
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
  <!-- ============================================================== -->
  <!-- Main wrapper - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
    data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin5">
      <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin6">
          <!-- ============================================================== -->
          <!-- Logo -->
          <!-- ============================================================== -->
          <a class="navbar-brand" href="index.php">
            <!-- Logo icon -->
            <b class="logo-icon">
              <!-- Dark Logo icon -->
              <img src="../../plugins/images/logo-icon.png" alt="homepage" />
            </b>
            <!--End Logo icon -->
            <!-- Logo text -->
            <span class="logo-text">
              <!-- dark Logo text -->
              <img src="../../plugins/images/logo-text.png" alt="homepage" />
            </span>
          </a>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- toggle and nav items -->
          <!-- ============================================================== -->
          <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none" href="javascript:void(0)"><i
              class="ti-menu ti-close"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">

          <!-- ============================================================== -->
          <!-- Right side toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav ms-auto d-flex align-items-center">

            <!-- ============================================================== -->
            <!-- Search -->
            <!-- ============================================================== -->
            <li class=" in">
              <form role="search" class="app-search d-none d-md-block me-3">
                <input type="text" placeholder="Search..." class="form-control mt-0">
                <a href="" class="active">
                  <i class="fa fa-search"></i>
                </a>
              </form>
            </li>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <li>
              <?php

              if (isset($_SESSION['email'])) {
                // User is logged in
                echo '<a class="profile-pic" href="../../function/auth/logout.php">Logout</a>';
              } else {
                // User is not logged in
                echo '<a class="profile-pic" href="../auth/login.php">Login</a>';
              }
              ?>
            </li>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
          </ul>
        </div>
      </nav>
    </header>
    <aside class="left-sidebar" data-sidebarbg="skin6">
      <!-- Sidebar scroll-->
      <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
          <ul id="sidebarnav">
            <!-- User Profile-->
            <li class="sidebar-item pt-2">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../../index.php" aria-expanded="false">
                <i class="far fa-clock" aria-hidden="true"></i>
                <span class="hide-menu">Landing Page</span>
              </a>
            </li>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../product/product_page.php"
                  aria-expanded="false">
                  <i class="fa fa-table" aria-hidden="true"></i>
                  <span class="hide-menu">Product</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../category/category.php"
                  aria-expanded="false">
                  <i class="fa fa-table" aria-hidden="true"></i>
                  <span class="hide-menu">Category</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="users.php" aria-expanded="false">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span class="hide-menu">Users</span>
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <div class="page-wrapper">
      <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Manage Users</h4>
          </div>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="white-box">
              <h3 class="box-title">Users</h3>
              <div class="table-responsive">
                <table class="table text-nowrap">
                  <thead>
                    <tr>
                      <th class="border-top-0">#</th>
                      <th class="border-top-0">Name</th>
                      <th class="border-top-0">Email</th>
                      <th class="border-top-0">Role</th>
                      <th class="border-top-0">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($users as $index => $user): ?>
                      <tr>
                        <td>
                          <?php echo $index + 1; ?>
                        </td>
                        <td>
                          <?php echo $user['name']; ?>
                        </td>
                        <td>
                          <?php echo $user['email']; ?>
                        </td>
                        <td>
                          <?php echo $user['role']; ?>
                        </td>
                        <td>
                          <button type="button" class="btn btn-warning" data-toggle="modal"
                            data-target="#editModal<?php echo $user['id']; ?>">
                            Edit
                          </button>

                      </tr>

                      <!-- Modal for Edit -->
                      <div class="modal fade" id="editModal<?php echo $user['id']; ?>" tabindex="-1" role="dialog"
                        aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editModalLabel">Edit Users</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <!-- Form for Edit Product -->
                              <form action="../../function/users/edit_users.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                <label for="editAdmin">Role:</label>
                                <select name="editRoles" class="form-control" required>
                                  <option value="admin" <?php echo ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin
                                  </option>
                                  <option value="member" <?php echo ($user['role'] == 'member') ? 'selected' : ''; ?>>Member
                                  </option>
                                </select>
                                <br>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ============================================================== -->
      <!-- End Container fluid  -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- footer -->
      <!-- ============================================================== -->
      <footer class="footer text-center"> 2023 © Technical Test PHP by Muhammad Ridwan
      </footer>
      <!-- ============================================================== -->
      <!-- End footer -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
  </div>
  <!-- ============================================================== -->
  <!-- End Wrapper -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
  <!-- All Jquery -->
  <!-- ============================================================== -->
  <script src="../../plugins/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap tether Core JavaScript -->
  <script src="../../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../js/app-style-switcher.js"></script>
  <script src="../../plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
  <!--Wave Effects -->
  <script src="../../js/waves.js"></script>
  <!--Menu sidebar -->
  <script src="../../js/sidebarmenu.js"></script>
  <!--Custom JavaScript -->
  <script src="../../js/custom.js"></script>
  <!--This page JavaScript -->
  <!-- <script src="js/pages/dashboards/dashboard1.js"></script> -->
</body>

</html>