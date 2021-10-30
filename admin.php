<?php

use Illuminate\Support\Facades\Route;

//componentes importados desde la carpeta Admin

//productos
use App\Http\Controllers\Admin\ProductController;
use App\Http\Livewire\Admin\ShowProducts;
use App\Http\Livewire\Admin\CreateProduct;
use App\Http\Livewire\Admin\EditProduct;

//categoria
use App\Http\Livewire\Admin\ShowCategory;
use App\Http\Controllers\Admin\CategoryController;

//ordenes
use App\Http\Controllers\Admin\OrderController;

//marcas
use App\Http\Livewire\Admin\BrandComponent;

//envio
use App\Http\Livewire\Admin\DepartmentComponent;
use App\Http\Livewire\Admin\ShowDepartment;

use App\Http\Livewire\Admin\CityComponent;

use App\Http\Livewire\Admin\UserComponent;

//ruta principal
Route::get('/', ShowProducts::class)->name('admin.index');

Route::get('products/create', CreateProduct::class)->name('admin.products.create');

//ruta en donde editamos informacion sobre el producto
Route::get('products/{product}/edit', EditProduct::class)->name('admin.products.edit');

//ruta para las imagenes
            //esperamos la url del producto para relacionarlo
Route::post('products/{product}/files', [ProductController::class, 'files'])->name('admin.products.files');

//ruta para administrar las ordenes
Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');

//ruta donde se muestran las ordenes
Route::get('orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');

//muestra las categorias
Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');

//ruta para crear categorias
Route::get('categories/{category}', ShowCategory::class )->name('admin.categories.show');

//ruta para marcas
//             url        compnente                    nombre
Route::get('brands', BrandComponent::class)->name('admin.brands.index');

//ruta para administrar departamentos o provincias
Route::get('departments', DepartmentComponent::class)->name('admin.department.index');

//ruta para las provincias
Route::get('deparments/{department}', ShowDepartment::class)->name('admin.departments.show');

//ruta para las ciudades
Route::get('cities/{city}', CityComponent::class)->name('admin.cities.show');

//ruta encargada de administrar los usuarios
Route::get('users', UserComponent::class )->name('admin.users.index');