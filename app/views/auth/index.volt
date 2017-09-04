{% extends "auth-layout.volt" %}

{% block title %} Login {% endblock %}

{% block flashMessages %} {{ super() }} {% endblock %}

{% block subtitle %} Login to start a session {% endblock %}

{% block content %}
    {{ form("auth/login") }}
        {{ form.render('csrf', ['value': security.getToken()]) }}

        {% for element in form %}
            <div class="form-group has-feedback">
                {% if loop.index == 1 %}
                    {{ element }}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                {% elseif loop.index == 2 %}
                    {{ element }}
                    <span style="pointer-events: visible !important;" class="glyphicon glyphicon-eye-open form-control-feedback"></span>
                {% endif %}
            </div>
        {% endfor %}
        <div class="row">
            <div class="col-xs-8">
              {#<div class="checkbox icheck">
                <label>
                  <input type="checkbox" name="remember" > Remember
                </label>
              </div>#}
            </div><!-- /.col -->
            <div class="col-xs-4">
              {{ submit_button("Login", "class": "btn btn-primary btn-block btn-flat") }}
            </div><!-- /.col -->
        </div>
    {{ endForm() }}

    <a href="{{ url("auth/requestreset") }}">I forgot my password</a><br>
{% endblock %}

{% block javascripts %}
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });

  // show hide password
  $('.glyphicon-eye-open').on("click", function() {

     var name = $('input[name="password"]').attr('type');

     if(name === 'password') {
        $('input[name="password"]').attr('type', 'text');
     }
     else {
       $('input[name="password"]').attr('type', 'password');
     }

  });

  // close alert
  window.setTimeout(function() {
        $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
</script>
{% endblock %}
