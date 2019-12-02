@extends('index')

@section('title', 'Editar Producto')

@section('content')
    <form method="POST" action="/productos/{{$product->id}}">
        @csrf
        @method('PUT')
        <h2>Editar Producto</h2>
        <label for="name">Nombre:</label><br>
        <input placeholder="Ingrese nombre" name="name" type="text" value="{{$product->name}}"><br><br>
        <label for="description">Descripcion:</label><br>
        <textarea placeholder="Ingrese descripcion" name="description" rows="4">{{$product->description}}</textarea><br><br>
        <label for="price">Precio:</label><br>
        <input placeholder="Ingrese precio" name="price" type="text" value="{{$product->price}}"><br><br>
        <button type="submit">Guardar</button>
        <a href="{{url('/productos')}}">Cancelar</a>
    </form>
@endsection