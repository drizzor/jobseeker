@extends('layouts.app')

@section('content')
    <h1 class="text-3xl text-green-500 mb-3">
        {{ $job->title }}
    </h1>

    <div class="px-3 py-5 mb-3 shadow-sm hover:shadow-md transition duration-500 ease-in-out border border-gray-300">
        <p class="text-md text-gray-800">
            {{ $job->description }}
        </p>

        <span class="text-sm text-gray-600">
            {{ number_format($job->price / 100, 2, ',', ' ') }} €
        </span>
    </div>

    <section x-data="{open: false}" class="mt-5">
        <a href="#" class="text-green-500 outline-none hover:text-green-700"
            @click="open = !open"
            x-html="open ? 'Masquer le champ <i class=&quot;fas fa-chevron-up pl-1&quot;></i>' : 'Soumettre ma candidature <i class=&quot;fas fa-chevron-down pl-1&quot;></i>'">
        </a>

        <form method="POST" action="{{ route('proposals.store', $job) }}" x-show="open" x-cloak>
            @csrf

            <textarea class="w-full max-w-lg p-3 font-thin bg-gray-200 mt-3" rows="10" name="content"></textarea>

            <button type="submit" class="block bg-green-700 text-white px-3 py-2 mt-3 hover:bg-green-500">
                 Postuler
                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 inline-block">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                  </svg>
            </button>
        </form>
    </section>
@endsection

