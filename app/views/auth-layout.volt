<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>{% block title %}{% endblock %}</title>
    <meta type="robots" content="no-index, no-follow" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    {{ stylesheet_link("css/bootstrap.min.css") }}
    {{ stylesheet_link("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css", false) }}
    {{ stylesheet_link("css/AdminLTE.css") }}
    {{ stylesheet_link("css/blue.css") }}
    {{ stylesheet_link("css/skin-black-light.css") }}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        {{ javascript_include("https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js", false) }}
        {{ javascript_include("https://oss.maxcdn.com/respond/1.4.2/respond.min.js", false) }}
    <![endif]-->

  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-box-body">
        <p class="login-box-msg">{% block subtitle %} {% endblock %}</p>

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

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    {{ javascript_include("js/jquery-2.2.3.min.js") }}
    {{ javascript_include("js/bootstrap.min.js") }}
    {{ javascript_include("js/icheck.min.js") }}
    {{ javascript_include("js/main.js") }}

    {% block javascripts %}
        <!-- Page dependend scripts -->
    {% endblock %}

  </body>
</html>
