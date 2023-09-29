@extends("bootstrap")
@section("contenido")
<x-tabla>
    <x-slot:encabezado>
        <x-tabla-encabezado :encabezados="['id','fecha','cliente']"/>
    </x-slot:encabezado>
    @foreach($facturas as $factura)
    <tr>
        <td>{{$factura->id}}</td>
        <td>{{$factura->fecha}}</td>
        <td>{{$factura->cliente->nombre}}</td>
    </tr>
    @endforeach()
</x-tabla>
@endsection()