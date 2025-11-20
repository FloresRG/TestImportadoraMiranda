@extends('adminlte::page')
@section('title', 'ventas')
@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-4">Venta de productos de {{ $sucur->nombre }}</h1>
        <div id="clock" class="text-right"></div>
    </div>
@stop
@section('content')
    <div id="lista-cursos" class="container">
        <div class="d-flex flex-wrap justify-content-end">
            <!-- Carrito -->
            <a class="btn btn-info ml-2 mb-2 d-flex align-items-center" href="#" id="mostrar-carrito" data-toggle="modal"
                data-target="#carritoModal">
                <i class="fas fa-shopping-cart mr-2"></i> Carrito Vendedor (<span id="carrito-contador">0</span>)
            </a>
        </div>
        <br>
        <br>
        <!-- Buscador -->
        <div class="mb-3">
            <input type="text" id="search" class="form-control" placeholder="Buscar producto..." />
        </div>
        <div class="row" id="product-list">
            <!-- Aquí se cargarán los productos dinámicamente con AJAX -->
        </div>
        <!-- Paginación -->
        <div id="pagination-links" class="pagination-gutter">
            <!-- Los links de paginación se cargarán aquí dinámicamente -->
        </div>
        {{-- Formulario de venta --}}
        <form id="venta-form" method="POST" action="{{ route('control.fin') }}" target="_blank">
            @csrf
            <input type="hidden" id="sucursal_id" value="{{ auth()->user()->sucursal_id }}">
            <input type="hidden" name="venta_token" value="{{ session('venta_token') }}">

            @include('control.partials.cart-modal')
        </form>

        @include('control.partials.qr-modal')
        @include('control.partials.quantity-modal')
        <ul id="pagination" class="pagination justify-content-center"></ul>
    </div> <!-- .container -->
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/pro.css') }}">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    @include('js.pro')
@stop
