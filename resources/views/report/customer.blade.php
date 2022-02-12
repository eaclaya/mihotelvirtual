<table>
	<thead>
		<tr>
			<td>Fecha de ingreso</td>
			<td>Nombre</td>
			<td>Direccion</td>
			<td>Genero</td>
			<td>Profesion</td>
			<td>Fecha de nacimiento</td>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $customer)
		<tr>
			<td>{{$customer->created_at}}</td>
			<td>{{$customer->name}}</td>
			<td>{{$customer->address}}</td>
			<td>{{$customer->gender == 'Male' ? 'Hombre' : 'Mujer' }}</td>
			<td>{{$customer->job}}</td>
			<td>{{$customer->birthdate}}</td>
		</tr>
		@endforeach
	</tbody>
</table>