<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<p>Hello, {{$name}}! Welcome to JMG. Please <a href="{{URL::to('users/confirm/' . $confirmationCode)}}">click here</a> to confirm you account.</p>
<table>
	<tr>
		<td>Email: </td>
		<td>{{$email}}</td>
	</tr>
	<tr>
		<td>Password: </td>
		<td><span style="color: red;">{{$password}}</span></td>
	</tr>
</table>
</body>
</html>
