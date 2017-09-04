{% extends "layout.volt" %}

{% block title %} Time Registration {% endblock %}
{% block pagehead %} Time Registration - edit {% endblock %}

{% block flashMessages %} {{ super() }} {% endblock %}

{% block content %}
<div class="box box-success">
    <div class="box-header width-border">
        <h3 class="box-title">Form</h3>
    </div>

    <div class="box-body">
        <div class="row">
            <div class="col-xs-12">
                {{ form("timeregistration/save") }}
                    {% for element in form %}
                        <div class="form-group">
                            {{ element.label(["class": "col-sm-3 control-label"]) }}
                            <div class="col-sm-9">
                                {{ element }}
                            </div>
                        </div>
                    {% endfor %}

                    <div class="form-group">
                        <div class="col-sm-3">

                        </div>
                        <div class="col-sm-9">
                            {{ submit_button("Save", "class": "pull-right btn btn-success") }}
                        </div>
                    </div>
                {{ endForm() }}
            </div>
        </div>
    </div>
</div>
{% endblock %}
