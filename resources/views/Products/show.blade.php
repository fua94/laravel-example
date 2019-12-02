@extends('index')

@section('title', 'Mostrar Producto')

@section('content')
    <form method="POST" action="/productos/{{$product->id}}">
        @csrf
        @method('DELETE')
        <h2>Mostrar Producto</h2>
        <h3>Nombre:</h3>
        <h4>{{$product->name}}</h4>
        <h3>Descripcion:</h3>
        <h4>{{$product->description}}</h4>
        <h3>Precio:</h3>
        <h4>${{$product->price}}</h4>
        <button type="submit">Borrar</button>
        <a href="{{url('/productos')}}">Cancelar</a>
    </form>
@endsection