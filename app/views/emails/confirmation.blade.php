<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		{{ HTML::style('materialize/css/materialize.min.css') }}
	</head>
	<body>
	    {{Form::open(array('url' => 'activate'))}}
		<h1>Hi, {{ $name }}!</h1>
        <input type="hidden" name="id" value={{ $id }}>
        <p> This email has been registered for an account at The Blogging Jay with the <h3>{{$username}}</h3> as tribute!</p>
        <p> Please click the link below to confirm if you volunteer as tribute </p>
        <input type="submit" class="btn waves-effect waves-light green" value="Click Me!"/>
        {{Form::close()}}
	</body>
</html>
