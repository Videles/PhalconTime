{% extends "layout.volt" %}

{% block title %} Project {% endblock %}
{% block pagehead %} Project - index {% endblock %}

{% block flashMessages %} {{ super() }} {% endblock %}

{% block content %}
<div class="box">
    <div class="box-header width-border">
        <a href="{{ url("project/new") }}" class="btn btn-primary pull-right primary-add"><i class="fa fa-plus"></i> <span>Create Project</span></a>
    </div>

    <div class="box-body">

        <div class="row">
            <div class="col-xs-12">

                <table id="projectTable" class="table table-bordered table-hover responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Delivered</th>
                            <th>Last Modified</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for project in projects %}
                        <tr>
                            <td width="80px" >{{ project.id }}</td>
                            <td>{{ project.client.name }}</td>
                            <td>{{ project.name }}</td>
                            <td width="100px" >{{ project.projectStatus.name }}</td>
                            <td width="80px" >{% if project.delivered %} Yes {% else %} No {%  endif %}</td>
                            <td width="150px" >{{ project.modified }}</td>
                            <td width="120px">
                                <a class="btn btn-default btn-sm" href="{{ url("timeregistration/new/" ~ project.id) }}" title="add time" ><i class="fa fa-plus"></i></a>
                                <a class="btn btn-default btn-sm" href="{{ url("project/edit/" ~ project.id) }}" title="update" ><i class="fa fa-pencil"></i></a>
                                {% if role == 'administrator' %}
                                    <a class="btn btn-default btn-sm" href="{{ url("project/confirm/" ~ project.id) }}" title="delete" ><i class="fa fa-trash"></i></a>
                                {% endif %}
                            </td>
                        </tr>
                        {% endfor %}
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Delivered</th>
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
        $("#projectTable").DataTable();
    });
</script>
{% endblock %}
