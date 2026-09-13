@extends('layouts.app')
@section('content')
<h1>Vehicles</h1>
<div class='card'>
<table>
<tr>
<th>Plate</th>
<th>Brand</th>
<th>Model</th>
</tr>
@foreach(\ as \)
<tr>
<td>{{ \->plate_number ?? \->plate_no }}</td>
<td>{{ \->brand }}</td>
<td>{{ \->model }}</td>
</tr>
@endforeach
</table>
</div>
@endsection
