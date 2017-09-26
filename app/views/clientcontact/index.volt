{% extends "layout.volt" %}

{% block title %} Client Contacts {% endblock %}
{% block pagehead %} Client Contacts - index {% endblock %}

{% block flashMessages %} {{ super() }} {% endblock %}

{% block content %}
<div class="box">
    <div class="box-header width-border">
        <a href="{{ url("clientcontact/new") }}" class="btn btn-primary pull-right primary-add"><i class="fa fa-plus"></i> <span>Create Client Contact</span></a>
    </div>

    <div class="box-body">

        <div class="row">
            <div class="col-xs-12">

                <table id="clientContactTable" class="table table-bordered table-hover responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Client</th>
                            <th>Phone</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Last Modified</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for contact in clientContacts %}
                        <tr>
                            <td width="80px" >{{ contact.id }}</td>
                            <td>{{ contact.firstname }} {{ contact.addition }} {{ contact.lastname }}</td>
                            <td>{{ contact.Client.name }}</td>
                            <td>{{ contact.phone }}</td>
                            <td>{{ contact.mobile }}</td>
                            <td>{{ contact.email }}</td>
                            <td width="150px" >{{ contact.modified }}</td>
                            <td width="120px" >
                                <a class="btn btn-default btn-sm" href="{{ url("clientcontact/edit/" ~ contact.id) }}" title="update" ><i class="fa fa-pencil"></i></a>
                                {% if role == 'administrator' %}
                                    <a class="btn btn-default btn-sm" href="{{ url("clientcontact/confirm/" ~ contact.id) }}" title="delete" ><i class="fa fa-trash"></i></a>
                                {% endif %}
                            </td>
                        </tr>
                        {% endfor %}
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Client</th>
                            <th>Phone</th>
                            <th>Mobile</th>
                            <th>Email</th>
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
        $("#clientContactTable").DataTable();
    });
</script>
{% endblock %}
