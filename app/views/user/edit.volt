{% extends "layout.volt" %}

{% block title %} User {% endblock %}
{% block pagehead %} User - edit {% endblock %}

{% block flashMessages %} {{ super() }} {% endblock %}

{% block content %}
<div class="box box-success">
    <div class="box-header width-border">
        <h3 class="box-title">Form</h3>
    </div>

    <div class="box-body">
        <div class="row">
            <div class="col-xs-12">
                {{ form("user/save", 'enctype': "multipart/form-data") }}
                    {% for element in form %}
                        <div class="form-group">
                            {{ element.label(["class": "col-sm-3 control-label"]) }}
                            <div class="col-sm-9">
                                {{ element }}
                            </div>
                        </div>
                        {% if element.getName() == 'image' %}
                        <div class="col-sm-3">

                        </div>
                        <div class="col-sm-9">
                            <div style="width: 250px; margin-bottom: 20px; position: relative;">
                                {% if element.getValue('image') %}
                                <img src="{{ url.getBaseUri() }}img/uploads/{{ element.getValue('image') }}" alt="" />
                                <a href="{{ url("user/deleteimage/" ~ id ) }}" style="position: absolute; top: 6px; left: 10px;"><i class="fa fa-remove"></i></a>
                                {% endif %}
                            </div>
                        </div>
                        {% endif %}
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
