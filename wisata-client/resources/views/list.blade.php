<h1>Daftar Wisata</h1>
<p><a href="{{ url('home') }}">Home</a></p>
<table border="1">
<tr>
<th>Id Wisata</th>
<th>Kota</th>
<th>Landmark</th>
<th>Tarif</th>
</tr>
@foreach($query as $row)
<tr>
<td>{{ $row['id_wisata'] }}</td>
<td>{{ $row['kota'] }}</td>
<td>{{ $row['landmark'] }}</td>
<td>{{ $row['tarif'] }}</td>

</tr>
@endforeach
</table>