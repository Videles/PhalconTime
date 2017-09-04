{% extends "layout.volt" %}

{% block title %} Price Type {% endblock %}
{% block pagehead %} Price Type - index {% endblock %}

{% block flashMessages %} {{ super() }} {% endblock %}

{% block content %}
<div class="box">
    <div class="box-header width-border">
        <a href="{{ url("pricetype/new") }}" class="btn btn-primary pull-right primary-add"><i class="fa fa-plus"></i> <span>Create price type</span></a>
    </div>

    <div class="box-body">

        <div class="row">
            <div class="col-xs-12">

                <table id="pricetypeTable" class="table table-bordered table-hover responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Last Modified</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for type in pricetype %}
                        <tr>
                            <td width="80px" >{{ type.id }}</td>
                            <td>{{ type.name }}</td>
                            <td width="150px" >{{ type.modified }}</td>
                            <td width="120px" >
                                <a class="btn btn-default btn-sm" href="{{ url("pricetype/edit/" ~ type.id) }}" title="update" ><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-default btn-sm" href="{{ url("pricetype/confirm/" ~ type.id) }}" title="delete" ><i class="fa fa-trash"></i></a>
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
        $("#pricetypeTable").DataTable();
    });
</script>
{% endblock %}
