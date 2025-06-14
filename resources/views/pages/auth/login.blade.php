@extends('layouts.app')

@section('title', 'Login')

@section('content')

    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="row w-100">
            <div class="col-12 col-md-6 mx-auto">
                <x-card>
                    <x-slot name="header">
                        <h3 class="text-center text-primary mb-0">Login</h3>
                    </x-slot>

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                            @error('password')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary rounded-3">Login</button>
                        </div>
                    </form>
                </x-card>
            </div>
        </div>
    </div>

@endsection

