@extends('layouts.app')

@section('title', content: 'Products - Add New')

@section('content')

    <x-card>

        <x-slot name="header">
            <div class="row">
                <div class="col">
                </div>
                <div class="col">
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary float-end">
                        <i class="fas fa-plus"></i>
                        Back
                    </a>
                </div>
            </div>
        </x-slot>


        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-lable">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-lable">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-lable">Price</label>
                <input type="number" class="form-control" name="price" value="{{ old('price') }}">
                @error('price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="stock" class="form-lable">Stock</label>
                <input type="number" class="form-control" name="stock" value="{{ old('stock') }}">
                @error('stock')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="color" class="form-lable">Color</label>
                <select name="color" class="form-select">
                    <option value="" disabled selected>Select Color</option>
                    <option value="black" {{ old('color') == 'black' ? 'selected' : '' }}>Black</option>
                    <option value="white" {{ old('color') == 'white' ? 'selected' : '' }}>White</option>
                    <option value="red" {{ old('color') == 'red' ? 'selected' : '' }}>Red</option>
                </select>
                @error('color')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-lable">Image</label>
                <input type="file" class="form-control" name="image">
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>


    </x-card>


@endsection