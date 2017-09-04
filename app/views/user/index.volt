{% extends "layout.volt" %}

{% block title %} User {% endblock %}
{% block pagehead %} User - index {% endblock %}

{% block flashMessages %} {{ super() }} {% endblock %}

{% block content %}
<div class="box">
    <div class="box-header width-border">
        <a href="{{ url("user/new") }}" class="btn btn-primary pull-right primary-add"><i class="fa fa-plus"></i> <span>Create user</span></a>
    </div>

    <div class="box-body">

        <div class="row">
            <div class="col-xs-12">

                <table id="userTable" class="table table-bordered table-hover responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Active</th>
                            <th>Last Modified</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for user in users %}
                        <tr>
                            <td width="80px" >{{ user.id }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{% if user.active %} Yes {% else %} No {% endif %}</td>
                            <td width="150px" >{{ user.modified }}</td>
                            <td width="120px" >
                                <a class="btn btn-default btn-sm" href="{{ url("user/edit/" ~ user.id) }}" title="update" ><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-default btn-sm" href="{{ url("user/confirm/" ~ user.id) }}" title="delete" ><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        {% endfor %}
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Active</th>
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
        $("#userTable").DataTable();
    });
</script>
{% endblock %}
