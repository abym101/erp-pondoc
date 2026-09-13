@extends('layouts.app')
@section('content')
<h1>Customers</h1>
<div class='card'>
<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Phone</th>
</tr>
@foreach(\ as \)
<tr>
<td>{{ \->id }}</td>
<td>{{ \->name }}</td>
<td>{{ \->phone }}</td>
</tr>
@endforeach
</table>
</div>
@endsection
