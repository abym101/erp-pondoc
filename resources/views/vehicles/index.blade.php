<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Kendaraan</title>
<style>
body{font-family:Arial;margin:20px;}
table{width:100%;border-collapse:collapse;}
th,td{border:1px solid #ddd;padding:8px;}
input,select{padding:8px;margin:4px;}
button{padding:8px 15px;}
</style>
</head>
<body>
<h1>Master Kendaraan</h1>
<form method="POST" action="/erp/vehicles">
@csrf
<select name="customer_id" required>
@foreach($customers as $c)
<option value="{{ $c->id }}">
{{ $c->name }}
</option>
@endforeach
</select>
<input
name="plate_number"
placeholder="Nomor Polisi"
required>
<input
name="brand"
placeholder="Merk">
<input
name="model"
placeholder="Model">
<button type="submit">
Simpan
</button>
</form>
<br>
<table>
<tr>
<th>ID</th>
<th>Pelanggan</th>
<th>Nopol</th>
<th>Merk</th>
<th>Model</th>
</tr>
@foreach($vehicles as $v)
<tr>
<td>{{ $v->id }}</td>
<td>
{{ $v->customer->name ?? '-' }}
</td>
<td>
{{ $v->plate_number }}
</td>
<td>
{{ $v->brand }}
</td>
<td>
{{ $v->model }}
</td>
</tr>
@endforeach
</table>
</body>
</html>
