{% extends "layout.volt" %}

{% block title %} Time Registration {% endblock %}
{% block pagehead %} Time Registration - confirm delete {% endblock %}

{% block flashMessages %} {{ super() }} {% endblock %}

{% block content %}
<div class="box box-success">
    <div class="box-header width-border">
        <h3 class="box-title">Are you sure you want to delete this time registration?</h3>
    </div>

    <div class="box-body">
        <div class="row">
            <div class="col-xs-12">
                <a href="{{ url("timeregistration/index/") }}" class="btn btn-default" >Cancel</a>
                <a class="btn btn-danger pull-right" href="{{ url("timeregistration/delete/" ~ id ) }}" title="delete" ><i class="fa fa-trash"></i> Delete</a>
            </div>
        </div>
    </div>
</div>
{% endblock %}
