@extends('layouts.app')

@section('title', 'Products - Show')

@section('content')


    <x-card>

        <x-slot name="header">

            <a href="{{ route('products.index') }}" class="btn btn-primary float-end">
                <i class="fas fa-plus"></i>
                Back
            </a>

        </x-slot>

        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('storage/' . ($product->image ?? 'products/no-image.png')) }}"
                     alt="product img"
                     class="img-fluid rounded">
            </div>
            <div class="col-md-8">
                <h2>{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>
                <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                <p><strong>Stock:</strong> {{ $product->stock }}</p>
                <p><strong>Color:</strong> {{ $product->color }}</p>
            </div>
        </div>


    </x-card>


@endsection