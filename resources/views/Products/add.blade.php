@extends('index')

@section('title', 'Añadir Producto')

@section('content')
    <form method="POST" action="/productos">
        @csrf
        <h2>Añadir Producto</h2>
        <label for="name">Nombre:</label><br>
        <input placeholder="Ingrese nombre" name="name" type="text"><br><br>
        <label for="description">Descripcion:</label><br>
        <textarea placeholder="Ingrese descripcion" name="description" rows="4"></textarea><br><br>
        <label for="price">Precio:</label><br>
        <input placeholder="Ingrese precio" name="price" type="text"><br><br>
        <button type="submit">Guardar</button>
        <a href="{{url('/productos')}}">Cancelar</a>
    </form>
@endsection