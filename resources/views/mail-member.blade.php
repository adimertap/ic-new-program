<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Register Member</title>
	</head>
	<body>
		<table border="0">
			<tr>
				<td>Dear {{ ucwords(strtolower($nama)) }}</td>
			</tr>
			<tr>
				<td>Pendaftaran sebagai member berhasil</td>
			</tr>
			<tr>
				<td><br>Untuk login ke aplikasi silahkan klik link <a href="http://dummy.iceducation.co.id/login">http://dummy.iceducation.co.id/login</a> gunakan username: {{$username}} dan password: {{$password}}</td>
			</tr>
		</table>
	</body>
</html>