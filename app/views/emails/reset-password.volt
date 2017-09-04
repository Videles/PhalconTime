<html>
    <body>
    	<p>We received a request to reset your password.</p>
        <p>Use the following link to reset your password: <a href="{{ url }}{{ url("auth/reset/" ~ token) }}" >{{ url }}{{ url("auth/reset/" ~ token) }}</a></p>
    </body>
</html>
