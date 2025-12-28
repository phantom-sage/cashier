@extends('layouts.app-modern')

@section('content')
    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <livewire:products.product-edit :id="$id" />
        </div>
    </div>
@endsection