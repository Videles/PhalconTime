a:11:{i:0;s:152:"<!DOCTYPE html>
<html lang="en" >
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>";s:5:"title";N;i:1;s:5794:"</title>
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

      <?= $this->tag->stylesheetLink('css/bootstrap.min.css') ?>
      <?= $this->tag->stylesheetLink('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css', false) ?>
      <?= $this->tag->stylesheetLink('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css', false) ?>
      <?= $this->tag->stylesheetLink('css/select2.min.css') ?>
      <?= $this->tag->stylesheetLink('css/dataTables.bootstrap.css') ?>
      <?= $this->tag->stylesheetLink('css/bootstrap-colorpicker.min.css') ?>
      <?= $this->tag->stylesheetLink('css/bootstrap3-wysihtml5.min.css') ?>
      <?= $this->tag->stylesheetLink('css/AdminLTE.css') ?>
      <?= $this->tag->stylesheetLink('css/skin-black-light.css') ?>

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
          <?= $this->tag->javascriptInclude('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js', false) ?>
          <?= $this->tag->javascriptInclude('https://oss.maxcdn.com/respond/1.4.2/respond.min.js', false) ?>
      <![endif]-->
    </head>
    <body class="hold-transition skin-black-light sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <a href="/" class="logo">
          <span class="logo-mini"></span>
          <span class="logo-lg">Phalcon<b>Time</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class=""><strong>User: </strong><?= $uid ?> - <?= $userName ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="<?= $this->url->getBaseUri() ?>img/uploads/<?= $userImage ?>" alt="User Image">
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="<?= $this->url->get('auth/logout/') ?>" class="btn btn-default btn-flat">Logout</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <!-- Tasks Menu -->
              <?php if ($role == 'administrator') { ?>
              <li class="dropdown tasks-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-gears"></i>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <ul class="menu footer">
                      <li><a href="<?= $this->url->get('user/index/') ?>"><i class="fa fa-cog"></i> <span>Users</span></a></li>
                      <li><a href="<?= $this->url->get('projectstatus/index/') ?>"><i class="fa fa-cog"></i> <span>Project Status</span></a></li>
                      <li><a href="<?= $this->url->get('pricetype/index/') ?>"><i class="fa fa-cog"></i> <span>Price Types</span></a></li>
                      <li><a href="<?= $this->url->get('timetype/index/') ?>"><i class="fa fa-cog"></i> <span>Time Types</span></a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <?php } ?>
            </ul>
          </div>
        </nav>
      </header>

      <aside class="main-sidebar">
        <section class="sidebar">

          

          <ul class="sidebar-menu">
            <li class="header">Mainmenu</li>
            
            <li class="treeview">
              <a href="<?= $this->url->getStatic() ?>"><i class="fa fa-tachometer"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-folder"></i> <span>User 1</span></a></li>
                <li><a href="#"><i class="fa fa-folder"></i> <span>User 2</span></a></li>
                <li><a href="#"><i class="fa fa-folder"></i> <span>Etc..</span></a></li>
              </ul>
            </li>
            <li><a href="<?= $this->url->get('client/index/') ?>"><i class="fa fa-user"></i> <span>Clients</span></a></li>
            <li><a href="<?= $this->url->get('clientcontact/index/') ?>"><i class="fa fa-users"></i> <span>Client Contacts</span></a></li>
            <li><a href="<?= $this->url->get('project/index/') ?>"><i class="fa fa-folder"></i> <span>Projects</span></a></li>
            <li><a href="<?= $this->url->get('timeregistration/index/') ?>"><i class="fa fa-clock-o"></i> <span>Quick registration</span></a></li>
          </ul>
        </section>
      </aside>

      <div class="content-wrapper">
        <section class="content-header">
          ";s:8:"pagehead";N;i:2;s:71:"
        </section>

        <section class="content">
            ";s:13:"flashMessages";a:3:{i:0;a:4:{s:4:"type";i:357;s:5:"value";s:40:"
                
                    ";s:4:"file";s:48:"C:\wamp64\www\phalcon-time/app/views/layout.volt";s:4:"line";i:134;}i:1;a:7:{s:4:"type";i:304;s:8:"variable";s:8:"messages";s:3:"key";s:4:"type";s:4:"expr";a:4:{s:4:"type";i:350;s:4:"name";a:5:{s:4:"type";i:46;s:4:"left";a:4:{s:4:"type";i:265;s:5:"value";s:5:"flash";s:4:"file";s:48:"C:\wamp64\www\phalcon-time/app/views/layout.volt";s:4:"line";i:134;}s:5:"right";a:4:{s:4:"type";i:265;s:5:"value";s:11:"getMessages";s:4:"file";s:48:"C:\wamp64\www\phalcon-time/app/views/layout.volt";s:4:"line";i:134;}s:4:"file";s:48:"C:\wamp64\www\phalcon-time/app/views/layout.volt";s:4:"line";i:134;}s:4:"file";s:48:"C:\wamp64\www\phalcon-time/app/views/layout.volt";s:4:"line";i:134;}s:16:"block_statements";a:3:{i:0;a:4:{s:4:"type";i:357;s:5:"value";s:26:"
                        ";s:4:"file";s:48:"C:\wamp64\www\phalcon-time/app/views/layout.volt";s:4:"line";i:135;}i:1;a:6:{s:4:"type";i:304;s:8:"variable";s:7:"message";s:4:"expr";a:4:{s:4:"type";i:265;s:5:"value";s:8:"messages";s:4:"file";s:48:"C:\wamp64\www\phalcon-time/app/views/layout.volt";s:4:"line";i:135;}s:16:"block_statements";a:5:{i:0;a:4:{s:4:"type";i:357;s:5:"value";s:54:"
                            <div class="alert alert-";s:4:"file";s:48:"C:\wamp64\www\phalcon-time/app/views/layout.volt";s:4:"line";i:136;}i:1;a:4:{s:4:"type";i:359;s:4:"expr";a:4:{s:4:"type";i:265;s:5:"value";s:4:"type";s:4:"file";s:48:"C:\wamp64\www\phalcon-time/app/views/layout.volt";s:4:"line";i:136;}s:4:"file";s:48:"C:\wamp64\www\phalcon-time/app/views/layout.volt";s:4:"line";i:138;}i:2;a:4:{s:4:"type";i:357;s:5:"value";s:161:"">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4>";s:4:"file";s:48:"C:\wamp64\www\phalcon-time/app/views/layout.volt";s:4:"line";i:138;}i:3;a:4:{s:4:"type";i:359;s:4:"expr";a:4:{s:4:"type";i:265;s:5:"value";s:7:"message";s:4:"file";s:48:"C:\wamp64\www\phalcon-time/app/views/layout.volt";s:4:"line";i:138;}s:4:"file";s:48:"C:\wamp64\www\phalcon-time/app/views/layout.volt";s:4:"line";i:140;}i:4;a:4:{s:4:"type";i:357;s:5:"value";s:67:"</h4>
                            </div>
                        ";s:4:"file";s:48:"C:\wamp64\www\phalcon-time/app/views/layout.volt";s:4:"line";i:140;}}s:4:"file";s:48:"C:\wamp64\www\phalcon-time/app/views/layout.volt";s:4:"line";i:141;}i:2;a:4:{s:4:"type";i:357;s:5:"value";s:22:"
                    ";s:4:"file";s:48:"C:\wamp64\www\phalcon-time/app/views/layout.volt";s:4:"line";i:141;}}s:4:"file";s:48:"C:\wamp64\www\phalcon-time/app/views/layout.volt";s:4:"line";i:143;}i:2;a:4:{s:4:"type";i:357;s:5:"value";s:32:"
                
            ";s:4:"file";s:48:"C:\wamp64\www\phalcon-time/app/views/layout.volt";s:4:"line";i:143;}}i:3;s:16:"

            ";s:7:"content";N;i:4;s:1304:"
        </section>
      </div>

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
            Developed by <a target="_blank" href="https://github.com/Videles" >Videles</a>. Build on <a target="_blank" href="https://phalconphp.com/" >Phalcon</a> - <a target="_blank" href="https://www.patreon.com/phalcon" >Support Phalcon</a>
        </div>
        <strong>Copyright &copy; 2016 - <?= date('Y') ?> <a href="#">Your Company</a>.</strong> All rights reserved
      </footer>

    </div><!-- ./wrapper -->

    <?= $this->tag->javascriptInclude('js/jquery-2.2.3.min.js') ?>
    <?= $this->tag->javascriptInclude('js/bootstrap.min.js') ?>
    <?= $this->tag->javascriptInclude('js/select2.full.min.js') ?>
    <?= $this->tag->javascriptInclude('js/bootstrap-colorpicker.min.js') ?>
    <?= $this->tag->javascriptInclude('js/bootstrap3-wysihtml5.all.min.js') ?>
    <?= $this->tag->javascriptInclude('js/jquery.dataTables.min.js') ?>
    <?= $this->tag->javascriptInclude('https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js', false) ?>
    <?= $this->tag->javascriptInclude('js/dataTables.bootstrap.min.js') ?>
    <?= $this->tag->javascriptInclude('js/app.min.js') ?>
    <?= $this->tag->javascriptInclude('js/main.js') ?>

    ";s:11:"javascripts";a:1:{i:0;a:4:{s:4:"type";i:357;s:5:"value";s:47:"
        <!-- Page dependend scripts -->
    ";s:4:"file";s:48:"C:\wamp64\www\phalcon-time/app/views/layout.volt";s:4:"line";i:171;}}i:5;s:26:"

    </body>
</html>
";}