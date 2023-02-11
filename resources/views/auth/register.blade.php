@extends('layouts.app')

@section('titulo')
    Registrate en DevStagram
@endsection

@section('contenido')
    <div class="md:flex  md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/registrar.jpg') }}" alt="imagen registro de usuarios">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nombre" class="border p-3 w-full rounded-lg @error('name') border-red-500  @enderror">
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Nombre de usuario" class="border p-3 w-full rounded-lg @error('name') border-red-500  @enderror">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">E-mail</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="correo@correo.com" class="border p-3 w-full rounded-lg @error('email') border-red-500  @enderror">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                    <input type="password" id="password" name="password" placeholder="Contraseña" class="border p-3 w-full rounded-lg @error('password') border-red-500  @enderror">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Confirmar password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmar contraseña" class="border p-3 w-full rounded-lg @error('password_confirmation') border-red-500  @enderror">
                </div>

                <input type="submit" value="Crear Cuenta" class="bg-sky-600 hover:bg-sky-800 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                
            </form>
        </div>
    </div>
@endsection