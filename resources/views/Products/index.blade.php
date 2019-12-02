@extends('index')

@section('title', 'Productos')

@section('content')
    <a href="{{url('productos/create')}}">Añadir</a><br><br>
    <table border="1">
        <tr>
            <td colspan="2">Acciones</td>
            <td>ID</td>
            <td>Nombre</td>
            <td>Descripción</td>
            <td>Precio</td>
        </tr>
        @foreach ($products as $product)
            <tr><!--ACCIONES-->
                <td><a href="{{url('productos/'.$product->id.'/edit')}}">Editar</a></td>
                <td><a href="{{url('productos/'.$product->id)}}">Ver</a></td>
                <td><center>{{$product->id}}</center></td>
                <td><center>{{$product->name}}</center></td>
                <td><center>{{$product->description}}</center></td>
                <td><center>{{$product->price}}</center></td>
            </tr>
        @endforeach
    </table>
@endsection