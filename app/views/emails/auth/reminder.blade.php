<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>Hi, {{ $name }}!</h1>

        <p> This email has been registered for an account at The Blogging Jay with the <h3>{{$username}}</h3> as tribute!</p>
        <p> Please click the link below to confirm if you volunteer as tribute </p>
        {{ URL::to('confirm', array(1)) }}
	</body>
</html>
