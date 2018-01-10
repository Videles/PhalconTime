{% extends "layout.volt" %}

{% block title %} Time Registration {% endblock %}
{% block pagehead %} Time Registration - new {% endblock %}

{% block flashMessages %} {{ super() }} {% endblock %}

{% block content %}
<div class="box box-success">
    <div class="box-header width-border">
        <h3 class="box-title">Form</h3>
    </div>

    <div class="box-body">
        <div class="row">
            <div class="col-xs-12">
                {{ form("timeregistration/create") }}
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

    {% if registeredTime %}
    <div class="box-body">
        <div class="row">
            <div class="col-xs-12">
                <table id="timeregistrationTable" class="table table-bordered table-hover responsive">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Total</th>
                            <th>Type</th>
                            <th>Booked by</th>
                            <th>Description</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for registration in registeredTime  %}
                            {% set date = split(' ', registration.createdAt) %}
                            {% set totalTimeBooked += registration.totalTime  %}
                            <tr>
                                <td>{{ date[0] }}</td>
                                <td>{{ registration.startTime }}</td>
                                <td>{{ registration.endTime }}</td>
                                <td>{{ registration.totalTime }}</td>
                                <td>{{ registration.timeType.name }}</td>
                                <td>{{ registration.user.name }}</td>
                                <td>{{ registration.description }}</td>
                                <td width="120">
                                    <a class="btn btn-default btn-sm" href="{{ url("timeregistration/edit/" ~ registration.id) }}" title="update" ><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-default btn-sm" href="{{ url("timeregistration/confirm/" ~ registration.id) }}" title="delete" ><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        {% endfor %}
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Date</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Total</th>
                            <th>Type</th>
                            <th>Booked by</th>
                            <th>Description</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
               </table>
            </div>
            <div class="col-xs-12">
                <p><strong>Total hours booked: {{ round(totalTimeBooked, 2) }} hour{% if totalTimeBooked >= 2 %}s{% endif %}</strong></p>
            </div>
        </div>
    </div>
    {% endif %}
</div>
{% endblock %}
