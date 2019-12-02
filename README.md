# laravel-example

## Si vas a clonar el repositorio

Instala las dependencias con composer

    composer install

Genera la clave unica para la aplicación

    php artisan key:generate

## Si vas a empezar el proyecto desde 0

```
1. Inicializar proyecto Laravel

composer create-project --prefer-dist laravel/laravel aplicativo
https://laravel.com/docs/6.x/installation

2. Crear una base de datos "products"

3. Configurar ambiente .env

4. Crear modelo y migración "Producto"

php artisan make:model Product -m
https://laravel.com/docs/6.x/eloquent

5. Editar migración

https://laravel.com/docs/6.x/migrations

$table->string('name', 50);
$table->text('description');
$table->decimal('price', 5, 2);

6. Configurar longitud de caracteres

https://laravel.com/docs/6.x/migrations#creating-indexes

-> App/Providers/AppServiceProvider.php

use Illuminate\Support\Facades\Schema;

public function boot()
{
    Schema::defaultStringLength(191);
}

7. Eliminar migraciones innecesarias y correr migraciones

php artisan migrate

8. Editar modelo

https://laravel.com/docs/6.x/eloquent#mass-assignment

protected $fillable = [
	'name',
	'description',
	'price'
];
public $timestamps = false;

9. Crear controlador "ProductController"

php artisan make:controller ProductController --resource

https://laravel.com/docs/6.x/controllers#resource-controllers
https://laravel.com/docs/6.x/eloquent#retrieving-models

use App\Product;

public function index()
{
	$productsList = Product::get();
	return view('Products/index', [
		'products' => $productsList
	]);
}

public function create()
{
	return view('Products/add');
}

public function store(Request $request)
{
	Product::create($request->all());
	return redirect('/productos');
}

public function show($id)
{
	$product = Product::findOrFail($id);
	return view('Products/show', [
		'product' => $product
	]);
}

public function edit($id)
{
	$product = Product::findOrFail($id);
	return view('Products/edit', [
		'product' => $product
	]);
}

public function update(Request $request, $id)
{
	Product::findOrFail($id)->update($request->all());
	return redirect('/productos');
}

public function destroy($id)
{
	Product::findOrFail($id)->delete();
	return redirect('/productos');
}

10. Crear rutas

Route::resource('/productos', 'ProductController');

php artisan route:list

https://laravel.com/docs/6.x/routing#required-parameters
https://laravel.com/docs/6.x/controllers#restful-nested-resources

11. Crear Vistas

-> index.blade.php

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplicativo - @yield('title')</title>
</head>
<body>
    <h1>Ejemplo de Aplicativo Web</h1>
    @yield('content')
</body>
</html>

-> Products/index.blade.php

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

-> Products/add.blade.php

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

-> Products/show

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
´´´
-> Products/edit

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
