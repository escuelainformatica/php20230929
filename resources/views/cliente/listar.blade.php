@extends("bootstrap")
@section("contenido")
<x-tabla>
    <x-slot:encabezado>
        <x-tabla-encabezado :encabezados="['id','nombre']"/>
    </x-slot:encabezado>
    @foreach($clientes as $cliente)
    <tr>
        <td>{{$cliente->id}}</td>
        <td>{{$cliente->nombre}}</td>
    </tr>
    @endforeach()
</x-tabla>
@endsection()