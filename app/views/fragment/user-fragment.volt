{% for user in users %}
    <li><a href="{{ url("index/index/" ~ user.id) }}"><i class="fa fa-folder"></i> <span>{{ user.name }}</span></a></li>
{% endfor %}
