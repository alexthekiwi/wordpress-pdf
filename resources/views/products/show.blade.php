@extends('layouts.app')

@section('head')
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">

    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
@endsection

@section('content')
    <div class="bg-white container mx-auto border p-4 rounded border-black space-y-4">
        <h1 class="text-2xl font-bold">{{ $product->name }}</h1>

        <div>
            {!! $product->description !!}
        </div>

        @if (!empty($product->images))
            <img src="{{ $product->images[0]->src }}" alt="{{ $product->images[0]->alt }}" class="mt-6 w-full h-auto max-h-[250px] mx-auto object-contain" />
        @endif
    </div>
@endsection
