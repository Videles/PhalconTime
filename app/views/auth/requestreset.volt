{% extends "auth-layout.volt" %}

{% block title %} Login {% endblock %}

{% block flashMessages %} {{ super() }} {% endblock %}

{% block subtitle %} Request a new password {% endblock %}

{% block content %}
    {{ form("auth/createtoken") }}
        {{ form.render('csrf', ['value': security.getToken()]) }}

        {% for element in form %}
            <div class="form-group has-feedback">
                {% if loop.index == 1 %}
                    {{ element }}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
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
  // close alert
  window.setTimeout(function() {
        $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
</script>
{% endblock %}
