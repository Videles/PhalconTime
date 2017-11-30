{% extends "layout.volt" %}

{% block title %} Clients {% endblock %}
{% block pagehead %} Clients - index {% endblock %}

{% block flashMessages %} {{ super() }} {% endblock %}

{% block content %}
<div class="box">
    <div class="box-header width-border">
        <a href="{{ url("client/new") }}" class="btn btn-primary pull-right primary-add"><i class="fa fa-plus"></i> <span>Create Client</span></a>
    </div>

    <div class="box-body">

        <div class="row">
            <div class="col-xs-12">

                <table id="clientTable" class="table table-bordered table-hover responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Zipcode</th>
                            <th>City</th>
                            <th>Phone</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Last Modified</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for client in clients %}
                        <tr>
                            <td width="80px" >{{ client.id }}</td>
                            <td>{{ client.name }}</td>
                            <td>{{ client.street }} {{ client.number }} {{ client.number_addition }} </td>
                            <td>{{ client.zipcode }}</td>
                            <td>{{ client.city }}</td>
                            <td>{{ client.phone }}</td>
                            <td>{{ client.mobile }}</td>
                            <td><a href="mailto:{{ client.email }}" >{{ client.email }}</a></td>
                            <td width="150px" >{{ client.modified }}</td>
                            <td width="120px">
                                <a class="btn btn-default btn-sm" href="{{ url("client/edit/" ~ client.id) }}" title="update" ><i class="fa fa-pencil"></i></a>
                                {% if role == 'administrator' %}
                                    <a class="btn btn-default btn-sm" href="{{ url("client/confirm/" ~ client.id) }}" title="delete" ><i class="fa fa-trash"></i></a>
                                {% endif %}
                            </td>
                        </tr>
                        {% endfor %}
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Zipcode</th>
                            <th>City</th>
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
        $("#clientTable").DataTable();
    });
</script>
{% endblock %}
