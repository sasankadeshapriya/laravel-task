@extends('layouts.app')

@section('title', 'Trash')

@section('content')

    <x-card>

        <x-slot name="header">
            <div class="row">
                <div class="col">
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary float-start">
                        Back
                    </a>
                </div>
                <div class="col">

                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success my-2" >
                    {{ session('success') }}
                </div>
            @endif
        </x-slot>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Color</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>

                    @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            <img src="{{ asset('storage/' . ($product->image ?? 'products/no-image.png')) }}"
                                alt="product img"
                                width="36"
                                height="36"
                                class="rounded-circle object-fit-cover">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->color }}</td>
                        <td>
                            <form action="{{ route('products.restore', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger mb-1">Restore</button>
                            </form>
                            <form action="{{ route('products.forceDelete', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger mb-1">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if ($products->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center">
                                <p> No Records </p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

          {{ $products->links() }}

    </x-card>

@endsection