{% extends "auth-layout.volt" %}

{% block title %} Login {% endblock %}

{% block flashMessages %} {{ super() }} {% endblock %}

{% block subtitle %} Set new password {% endblock %}

{% block content %}
    {{ form("auth/reset" ~ token) }}
        {{ form.render('csrf', ['value': security.getToken()]) }}

        {% for element in form %}
            <div class="form-group has-feedback">
                {% if loop.index == 2 %}
                    {{ element }}
                    <span style="pointer-events: visible !important;" class="glyphicon glyphicon-eye-open form-control-feedback"></span>
                {% else %}
                    {{ element }}
                {% endif %}
            </div>
        {% endfor %}
        <div class="row">
            <div class="col-xs-4 col-xs-offset-8">
              {{ submit_button("Reset", "class": "btn btn-primary btn-block btn-flat") }}
            </div><!-- /.col -->
        </div>
    {{ endForm() }}

    <a href="{{ url("auth/index") }}">Back to login page</a><br>
{% endblock %}

{% block javascripts %}
<script>
    // show hide password
    $('.glyphicon-eye-open').on("click", function() {

       var name = $('input[name="password"]').attr('type');

       if(name === 'password' || name === 'passwordRepeat' ) {
          $('input[name="password"]').attr('type', 'text');
          $('input[name="passwordRepeat"]').attr('type', 'text');
       }
       else {
         $('input[name="password"]').attr('type', 'password');
         $('input[name="passwordRepeat"]').attr('type', 'password');
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
