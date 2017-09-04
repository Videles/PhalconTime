<!DOCTYPE html>
<html lang="en" >
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>{% block title %}{% endblock %}</title>
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

      {{ stylesheet_link("css/bootstrap.min.css") }}
      {{ stylesheet_link("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css", false) }}
      {{ stylesheet_link("https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css", false) }}
      {{ stylesheet_link("css/select2.min.css") }}
      {{ stylesheet_link("css/dataTables.bootstrap.css") }}
      {{ stylesheet_link("css/bootstrap-colorpicker.min.css") }}
      {{ stylesheet_link("css/bootstrap3-wysihtml5.min.css") }}
      {{ stylesheet_link("css/AdminLTE.css") }}
      {{ stylesheet_link("css/skin-black-light.css") }}

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
          {{ javascript_include("https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js", false) }}
          {{ javascript_include("https://oss.maxcdn.com/respond/1.4.2/respond.min.js", false) }}
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
                  <span class=""><strong>User: </strong>{{ uid }} - {{ userName }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="{{ url.getBaseUri() }}img/uploads/{{ userImage }}" alt="User Image">
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="{{ url("auth/logout/") }}" class="btn btn-default btn-flat">Logout</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <!-- Tasks Menu -->
              <li class="dropdown tasks-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-gears"></i>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <ul class="menu footer">
                      <li><a href="{{ url("user/index/") }}"><i class="fa fa-cog"></i> <span>Users</span></a></li>
                      <li><a href="{{ url("projectstatus/index/") }}"><i class="fa fa-cog"></i> <span>Project Status</span></a></li>
                      <li><a href="{{ url("pricetype/index/") }}"><i class="fa fa-cog"></i> <span>Price Types</span></a></li>
                      <li><a href="{{ url("timetype/index/") }}"><i class="fa fa-cog"></i> <span>Time Types</span></a></li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <aside class="main-sidebar">
        <section class="sidebar">

          {#<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
                  <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                  </span>
            </div>
          </form>#}

          <ul class="sidebar-menu">
            <li class="header">Mainmenu</li>
            <li><a href="{{ url("client/index/") }}"><i class="fa fa-user"></i> <span>Clients</span></a></li>
            <li><a href="{{ url("clientcontact/index/") }}"><i class="fa fa-users"></i> <span>Client Contacts</span></a></li>
            <li><a href="{{ url("project/index/") }}"><i class="fa fa-square"></i> <span>Projects</span></a></li>
            <li><a href="{{ url("timeregistration/index/") }}"><i class="fa fa-square"></i> <span>Quick registration</span></a></li>
            {#<li class="active"><a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li><a href="#"><i class="fa fa-folder"></i> <span>Uploads</span></a></li>
            <li><a href="#"><i class="fa fa-folder"></i> <span>Dossiers</span></a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-folder"></i> <span>Verkoop</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-folder"></i> <span>Pagina 1</span></a></li>
                <li><a href="#"><i class="fa fa-folder"></i> <span>Pagina 2</span></a></li>
                <li><a href="#"><i class="fa fa-folder"></i> <span>Etc..</span></a></li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-book"></i> <span>Documentatie</span></a></li>#}
          </ul>
        </section>
      </aside>

      <div class="content-wrapper">
        <section class="content-header">
          {% block pagehead %}{% endblock %}
        </section>

        <section class="content">
            {% block flashMessages %}
                {#{% if flash.output()|length > 0 %}#}
                    {% for type, messages in flash.getMessages() %}
                        {% for message in messages %}
                            <div class="alert alert-{{ type }}">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4>{{ message }}</h4>
                            </div>
                        {% endfor %}
                    {% endfor %}
                {#{% endif %}#}
            {% endblock %}

            {% block content %}{% endblock %}
        </section>
      </div>

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
            Developed by <a target="_blank" href="https://github.com/Videles" >Videles</a>. Build on <a target="_blank" href="https://phalconphp.com/" >Phalcon</a> - <a target="_blank" href="https://www.patreon.com/phalcon" >Support Phalcon</a>
        </div>
        <strong>Copyright &copy; 2016 - {{ date("Y") }} <a href="#">Your Company</a>.</strong> All rights reserved
      </footer>

    </div><!-- ./wrapper -->

    {{ javascript_include("js/jquery-2.2.3.min.js") }}
    {{ javascript_include("js/bootstrap.min.js") }}
    {{ javascript_include("js/select2.full.min.js") }}
    {{ javascript_include("js/bootstrap-colorpicker.min.js") }}
    {{ javascript_include("js/bootstrap3-wysihtml5.all.min.js") }}
    {{ javascript_include("js/jquery.dataTables.min.js") }}
    {{ javascript_include("https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js", false) }}
    {{ javascript_include("js/dataTables.bootstrap.min.js") }}
    {{ javascript_include("js/app.min.js") }}
    {{ javascript_include("js/main.js") }}

    {% block javascripts %}
        <!-- Page dependend scripts -->
    {% endblock %}

    </body>
</html>
