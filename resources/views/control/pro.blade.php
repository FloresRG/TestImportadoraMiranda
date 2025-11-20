@extends('adminlte::page')
@section('title', 'ventas')
@section('content_header')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-4">Venta de productos de {{ $sucur->nombre }}</h1>
    <div class="d-flex align-items-center">
        <div id="clock" class="text-right mr-3"></div>
        <div class="position-relative" x-data="{ carrito: $store.carrito }">
            <a class="btn btn-info d-flex align-items-center" href="#" id="mostrar-carrito" data-toggle="modal" data-target="#carritoModal">
                <i class="fas fa-shopping-cart mr-2"></i> Carrito (<span x-text="carrito.totalItems || 0"></span>)
            </a>
        </div>
    </div>
</div>
@stop
@section('content')
    <div class="container-fluid" x-data="productosApp({{ $id }})">
        @include('ventas.partials.search-box')

        <div id="productos-list" class="row" x-cloak>
            {{-- Inyectado vía AJAX --}}
        </div>

        <div class="d-flex justify-content-center mt-4" id="pagination-links"></div>
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
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/pro.css') }}">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.10/dist/cdn.min.js" defer></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    @include('js.pro-alpine')
@stop
