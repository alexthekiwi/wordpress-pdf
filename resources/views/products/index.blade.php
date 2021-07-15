@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="font-bold text-2xl mb-6">Products</h1>
        <div class="grid gap-6 md:grid-cols-4">
            @foreach ($products as $product)
                <article class="bg-white rounded-lg shadow flex flex-col items-start p-8">
                    <h2 class="text-lg font-bold">{{ $product->name }}</h2>

                    <div class="flex items-center space-x-2">
                        <a class="border p-2 text-sm bg-gray-50 mt-2" href="/products/{{ $product->id }}">Preview</a>
                        <a class="border p-2 text-sm bg-gray-50 mt-2" href="/products/{{ $product->id }}/pdf" target="_blank">Generate PDF</a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
@endsection
