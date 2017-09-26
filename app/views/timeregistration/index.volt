{% extends "layout.volt" %}

{% block title %} Time Registration {% endblock %}
{% block pagehead %} Time Registration - index {% endblock %}

{% block flashMessages %} {{ super() }} {% endblock %}

{% block content %}
<div class="box">
    <div class="box-header width-border">
        <a href="{{ url("timeregistration/new") }}" class="btn btn-primary pull-right primary-add"><i class="fa fa-plus"></i> <span>Create time registration</span></a>
    </div>

    <div class="box-body">

        <div class="row">
            <div class="col-xs-12">

                <table id="timeregistrationTable" class="table table-bordered table-hover responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Project</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Total</th>
                            <th>Booked By</th>
                            <th>Last Modified</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for time in timeregistration %}
                            {% set date = split(' ', time.created_at) %}
                            <tr>
                                <td width="80px" >{{ time.id }}</td>
                                <td>{{ time.project.client.name }}</td>
                                <td>{{ time.project.name }}</td>
                                <td>{{ time.timeType.name }}</td>
                                <td>{{ date[0] }}</td>
                                <td>{{ time.start_time }}</td>
                                <td>{{ time.end_time }}</td>
                                <td>{{ time.total_time }}</td>
                                <td>{{ time.user.name }}</td>
                                <td width="150px" >{{ time.modified }}</td>
                                <td width="120px" >
                                    <a class="btn btn-default btn-sm" href="{{ url("timeregistration/edit/" ~ time.id) }}" title="update" ><i class="fa fa-pencil"></i></a>
                                    {% if role == 'administrator' %}
                                        <a class="btn btn-default btn-sm" href="{{ url("timeregistration/confirm/" ~ time.id) }}" title="delete" ><i class="fa fa-trash"></i></a>
                                    {% endif %}
                                </td>
                            </tr>
                        {% endfor %}
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Project</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Total</th>
                            <th>Booked By</th>
                            <th>Last Modified</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
               </table>

            </div>
        </div>

    </div>
</div>
{% endblock %}

{% block javascripts %}
<script type="text/javascript">
    $(function(){
        $("#timeregistrationTable").DataTable();
    });
</script>
{% endblock %}
