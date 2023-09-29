# ejercicio 29 septiembre

Cree un proyecto nuevo para listar el siguiente modelo

* Viaje
    * Id (llave primaria)
    * Origen (texto)
    * Destino (texto)
    * Pasajero (texto)

Para ello cree lo siguiente

- [ ] Proyeecto
- [ ] Modelo
- [ ] Migracion
- [ ] Factory
- [ ] Seeder
- [ ] Controller
- [ ] Componentes sus clases (tabla y encabezado)
- [ ] Componentes sus vistas (tabla y encabezado)
- [ ] Vista
- [ ] Web (enrutamiento)


# proyecto 29 septiembre

Los modelos que se van a utilizar van a ser los siguiente

* Cliente
   * Id (llave primaria)
   * Nombre (texto)

* Factura
   * Id (llave primaria, autonumerico, entero sin signo)
   * Fecha (texto)
   * IdCliente (entero)
   * cliente() (muchos es a uno)


## crear un proyecto

* En la linea de comando, ejecutar:

```shell
composer create-project laravel/laravel example-app
```

## configurar el .env

```php
DB_CONNECTION=sqlite
```
Y en la database, creare un archivo llamado database.sqlite

## creacion de modelos
En el terminal ejecutar
```shell
php artisan make:model Cliente
php artisan make:model Factura
```
## creacion de migracion
En el terminal ejecutar
```shell
php artisan make:migration migracion1
```

## creacion factory
En el terminal ejecutar
```shell
php artisan make:factory ClienteFactory
php artisan make:factory FacturaFactory
```

## creacion de controladores
En el terminal ejecutar
```shell
php artisan make:controller ClienteController
php artisan make:controller FacturaController

```

## creacion de vistas
En el terminal ejecutar
```shell
php artisan make:view bootstrap
php artisan make:view cliente.listar
php artisan make:view factura.listar
```

## creacion de un componente
En el terminal ejecutar
```shell
php artisan make:component Tabla
php artisan make:component TablaEncabezado
```

## creacion de la clase de servicio
En la carpeta app, crear una carpeta con el nombre que quiera.
* En este caso lo voy a llamar Repo
Dentro de la carpeta repo, crear dos clases con el namespace que corresponda a la carpeta, y la clase debe llamarse igual que el archivo.
   * ClienteRepo
   * FacturaRepo

Ejemplo:
```php
namespace App\Repo;

class ClienteRepo {

}
```

## Editar el modelo
Ir a la clase de modelo y editarla

```php
class Cliente extends Model
{
    use HasFactory;

    public $table="clientes";
    public $fillable=['nombre'];
    public $timestamps =false;
}
```

```php
class Factura extends Model
{
    use HasFactory;
    public $table="facturas";
    public $fillable=['fecha,idcliente'];

    public function cliente() {
        return $this->belongsTo(Cliente::class,'idcliente','id');
     }
    public $timestamps =false;
}
```

## editar y ejecutar la migracion
Editar la migracion database/migrations y modificar la funcion up().
Puede usar la migracion de usuario como ejemplo.

```php
Schema::create('clientes', function (Blueprint $table) {
    $table->id();
    $table->string('nombre');
});
Schema::create('facturas', function (Blueprint $table) {
    $table->id();
    $table->string('fecha');
    $table->unsignedBigInteger('idcliente');
    $table->foreign('idcliente')->references('id')->on('clientes');
});
```

* y en la linea de comando ejecutar:
```shell
php artisan migrate:install
php artisan migrate:fresh 
```

## editar y ejecutar el factory y seeder

```php
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'=>fake()->name()
        ];
    }
}
```

```php
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Factura>
 */
class FacturaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha'=>fake()->text(10),
            'idcliente'=>fake()->numberBetween(1,100)
        ];
    }
}
```

* y edite el seeder (o puede crear un nuevo seeder)

```php
    public function run(): void
    {
        Cliente::factory(100)->create();
        Factura::factory(100)->create();
    }
```

* Y luego, en la linea de comando, ejecute el seed

```
 php artisan db:seed
```

## editar las clases de servicio
Agregue las funciones que necesitemos en las clases de servicio

* ClienteRepo:
```php
    public function listar()
    {
        return Cliente::all();
    }
```
* FacturaRepo:
```php
    public function listar()
    {
        return Factura::with('cliente')->get();
    }
```

## probar lo que esta hecho
Abrir el tinker en el terminal (control+c para salir)

```shell
php artisan tinker
> $obj=new \App\Repo\ClienteRepo();
> $obj->Listar();
> $obj=new \App\Repo\FacturaRepo();
> $obj->Listar();
```

## editar el enrutamiento
Editar el archivo routes/web.php

```php
Route::controller(ClienteController::class)->prefix('cliente')->group(function() {
    Route::get("/",'listar');
});
Route::controller(FacturaController::class)->prefix('factura')->group(function() {
    Route::get("/",'listar');
});    
```

## editar los controladores
Editar los controladores en la carpeta app/http/controllerç

* ClienteController
```php
    public function listar()
    {
        return view('cliente.listar');
    }
```
* FacturaController
```php
    public function listar()
    {
        return view('factura.listar');
    }
```

## probar las vistas
Deberian aparecer paginas vacias.
En el terminal
```php
php artisan serve
```
Y luego abrir la pagina
> http://127.0.0.1:8000/cliente/
> http://127.0.0.1:8000/factura/

## crear mockup de las vistas
Mockups son vista con datos de ejemplo
Editar las vistas en la carpetas /resourcves/views

* editar bootstrap.blade.php y agregue un "content"

```html
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    @section('contenido')
    @show

    <script src="https://cdn.jsdelivr.net/npm/jquery@@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
  </body>
</html>
```
* Y edite los otras vistas listar.blade.php como sigue:

```html
@extends("bootstrap")
@section("contenido")
aqui va la tabla
@endsection()
```

## editar el componente
En la carpeta app/view/componentes, editar

* tablaencabezado
```php
    public function __construct(public array $encabezados)
    {
    }
    public function render(): View|Closure|string
    {
        return view('components.tabla-encabezado',['encabezados'=>$this->encabezados]);
    }
```
* tabla
```php
    public function __construct()
    {
    }
    public function render(): View|Closure|string
    {
        return view('components.tabla');
    }
```

En la carpeta resources/views/componentes, edite los componentes:

* tabla-encabezado.blade.php:

```html
<tr>
@foreach($encabezados as $encabezado)
    <th>{{$encabezado}}</th>
@endforeach
</tr>
```
* tabla.blade.php
```html
<table class="table">
    <thead>
    {{$encabezado}}
    </thead>
    <tbody>
    {{$slot}}
    <tbody>
</table>
```

## editar los controladores
* ClienteController:
```php
    public function __construct(public ClienteRepo $clienteRepo) {
    }
    public function listar()
    {
        $clientes=$this->clienteRepo->listar();
        return view('cliente.listar',['clientes'=>$clientes]);
    }
```
* FacturaController:
```php
    public function __construct(public FacturaRepo $facturaRepo) {
    }
    public function listar()
    {
        $facturas=$this->facturaRepo->listar();
        return view('factura.listar',['facturas'=>$facturas]);
    }
```


## volver a editar las listas
edite la vistas (lista) de clientes y facturas como sigue:

* cliente/listar.blade.php
```html
@extends("bootstrap")
@section("contenido")
<x-tabla>
    <x-slot:encabezado>
        <x-tabla-encabezado :encabezados="['id','nombre']"/>
    </x-slot:encabezado>
    <tr>
        <td>a</td>
        <td>b</td>
        <td>c</td>
    </tr>
</x-tabla>
@endsection()
```
* factura/listar.blade.php
```html
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
```

