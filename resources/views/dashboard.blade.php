@extends('layouts.app')

@section('titulo')

    Pferil de {{ $user -> username }}
@endsection

@section('contenido')

    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col md:flex-row items-center">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ asset('img/usuario.svg') }}" alt="Imagen usuario">
            </div>
            
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center py-3 md:items-start md:py-10">
                <p class="text-gray-700 text-2xl">{{ $user -> username }}</p>

                <p class="text-gray-700 text-sm mb-3 mt-5 font-bold">
                    0 <span class="font-normal"> Seguidores</span>
                </p>

                <p class="text-gray-700 text-sm mb-3 font-bold">
                    0 <span class="font-normal"> Siguiendo</span>
                </p>

                <p class="text-gray-700 text-sm mb-3 font-bold">
                    0 <span class="font-normal"> Posts</span>
                </p>
            </div>
        </div>
    </div>

@endsection