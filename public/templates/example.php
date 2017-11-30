<h1>See See https://twig.symfony.com/doc/2.x/templates.html</h1>
<ul id="navigation">
{% for item in navigation %}
    <li><a href="{{ item.href }}">{{ item.caption }}</a></li>
{% endfor %}
</ul>
