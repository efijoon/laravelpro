<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>پنل مدیریت | داشبورد اول</title>
  <link rel="stylesheet" href="/admin-assets/plugins/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/admin-assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="/admin-assets/plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="/admin-assets/plugins/morris/morris.css">
  <link rel="stylesheet" href="/admin-assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="/admin-assets/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="/admin-assets/plugins/daterangepicker/daterangepicker-bs3.css">
  <link rel="stylesheet" href="/admin-assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="/admin-assets/dist/css/bootstrap-rtl.min.css">
  <link rel="stylesheet" href="/admin-assets/dist/css/custom-style.css">

  @yield('style')
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">خانه</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">تماس</a>
      </li>
    </ul>

    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="جستجو" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <ul class="navbar-nav mr-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-comments-o"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="/admin-assets/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 ml-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  حسام موسوی
                  <span class="float-left text-sm text-danger"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">با من تماس بگیر لطفا...</p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 ساعت قبل</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="/admin-assets/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle ml-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  پیمان احمدی
                  <span class="float-left text-sm text-muted"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">من پیامتو دریافت کردم</p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 ساعت قبل</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="/admin-assets/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle ml-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  سارا وکیلی
                  <span class="float-left text-sm text-warning"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">پروژه اتون عالی بود مرسی واقعا</p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i>4 ساعت قبل</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">مشاهده همه پیام‌ها</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell-o"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
          <span class="dropdown-item dropdown-header">15 نوتیفیکیشن</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-envelope ml-2"></i> 4 پیام جدید
            <span class="float-left text-muted text-sm">3 دقیقه</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-users ml-2"></i> 8 درخواست دوستی
            <span class="float-left text-muted text-sm">12 ساعت</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-file ml-2"></i> 3 گزارش جدید
            <span class="float-left text-muted text-sm">2 روز</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">مشاهده همه نوتیفیکیشن</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fa fa-th-large"></i></a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
      <img src="/admin-assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>

    <div class="sidebar" style="direction: ltr">
      <div style="direction: rtl">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src=""
                 class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">حسام موسوی</a>
          </div>
        </div>

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
            <li class="nav-item">
              <a href="/admin/dashboard" class="nav-link">
                <i class="nav-icon fa fa-dashboard"></i>
                <p>
                  داشبورد
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p>
                  کاربران
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/admin/users" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>لیست کاربران</p>
                  </a>
                  <a href="/admin/users/create" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>ایجاد کاربر جدید</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-product-hunt"></i>
                <p>
                  محصولات
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/admin/products" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>لیست محصولات</p>
                  </a>

                  <a href="/admin/products/create" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>ایجاد محصول جدید</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-comment"></i>
                <p>
                  نظرات
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/admin/comments" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>لیست نظرات</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-list"></i>
                <p>
                  دسته بندی ها
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/admin/categories" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>لیست دسته بندی ها</p>
                  </a>
                </li>
              </ul>
            </li>

            @canany(['view-permissions', 'view-roles'])
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-shield"></i>
                  <p>
                    سطوح دسترسی
                    <i class="right fa fa-angle-left"></i>
                  </p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    @can('view-permissions')
                      <a href="/admin/permissions" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>لیست اجازه های دسترسی</p>
                      </a>
                    @endcan

                    @can('view-roles')
                      <a href="/admin/roles" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>لیست سطوح دسترسی</p>
                      </a>
                    @endcan
                  </li>
                </ul>
              </li>
            @endcanany
          </ul>
        </nav>
      </div>
    </div>
  </aside>

  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        @yield('content')
      </div>
    </section>
  </div>

  <footer class="main-footer">
    <strong>CopyLeft &copy; 2018 <a href="http://github.com/hesammousavi/">حسام موسوی</a>.</strong>
  </footer>

  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
</div>

<script src="/admin-assets/plugins/jquery/jquery.min.js"></script>
{{--    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>--}}
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="/admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>--}}
<script src="/admin-assets/plugins/morris/morris.min.js"></script>
<script src="/admin-assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="/admin-assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/admin-assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="/admin-assets/plugins/knob/jquery.knob.js"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>--}}
<script src="/admin-assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="/admin-assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="/admin-assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="/admin-assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="/admin-assets/plugins/fastclick/fastclick.js"></script>
<script src="/admin-assets/dist/js/adminlte.js"></script>
<script src="/admin-assets/dist/js/pages/dashboard.js"></script>
<script src="/admin-assets/dist/js/demo.js"></script>
@yield('script')
@include('sweetalert::alert')
</body>
</html>
