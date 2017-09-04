{% extends "layout.volt" %}

{% block title %} Project Status {% endblock %}
{% block pagehead %} Project Status - index {% endblock %}

{% block flashMessages %} {{ super() }} {% endblock %}

{% block content %}
<div class="box">
    <div class="box-header width-border">
        <a href="{{ url("projectstatus/new") }}" class="btn btn-primary pull-right primary-add"><i class="fa fa-plus"></i> <span>Create project status</span></a>
    </div>

    <div class="box-body">

        <div class="row">
            <div class="col-xs-12">

                <table id="projectstatusTable" class="table table-bordered table-hover responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Last Modified</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for status in projectstatus %}
                        <tr>
                            <td width="80px" >{{ status.id }}</td>
                            <td>{{ status.name }}</td>
                            <td width="150px" >{{ status.modified }}</td>
                            <td width="120px" >
                                <a class="btn btn-default btn-sm" href="{{ url("projectstatus/edit/" ~ status.id) }}" title="update" ><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-default btn-sm" href="{{ url("projectstatus/confirm/" ~ status.id) }}" title="delete" ><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        {% endfor %}
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
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
        $("#projectstatusTable").DataTable();
    });
</script>
{% endblock %}
