@extends('layouts.app')

@section('content')
    <h1 class="text-3xl text-green-500 mb-3">Nos dernières missions</h1>

    @foreach ($jobs as $job)
        <div class="px-3 py-5 mb-3 shadow-sm hover:shadow-md transition duration-500 ease-in-out border border-gray-300">
            <h2 class="text-xl font-bold text-green-800">
                {{ $job->title }}
            </h2>

            <p class="text-md text-gray-800">
                {{ $job->description }}
            </p>

            <div class="flex items-center">
                <span class="h-2 w-2 bg-green-300 rounded-full mr-2 mt-1"></span>

                <a href="#">
                    Consulter la mission
                </a>
            </div>

            <span class="text-sm text-gray-600">
                {{ number_format($job->price / 100, 2, ',', ' ') }} €
            </span>
        </div>
    @endforeach
@endsection