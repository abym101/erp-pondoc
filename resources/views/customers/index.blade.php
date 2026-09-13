<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Pelanggan</title>
<style>
body{font-family:Arial;margin:20px;}
table{width:100%;border-collapse:collapse;}
th,td{border:1px solid #ddd;padding:8px;}
input{padding:8px;margin:4px;}
button{padding:8px 15px;}
</style>
</head>
<body>
<h1>Master Pelanggan</h1>
<form method="POST" action="/erp/customers">
@csrf
<input name="name" placeholder="Nama Pelanggan" required>
<input name="phone" placeholder="No HP">
<input name="address" placeholder="Alamat">
<button type="submit">
Simpan
</button>
</form>
<br>
<table>
<tr>
<th>ID</th>
<th>Nama</th>
<th>HP</th>
<th>Alamat</th>
</tr>
@foreach($customers as $c)
<tr>
<td>{{ $c->id }}</td>
<td>{{ $c->name }}</td>
<td>{{ $c->phone }}</td>
<td>{{ $c->address }}</td>
</tr>
@endforeach
</table>
</body>
</html>
