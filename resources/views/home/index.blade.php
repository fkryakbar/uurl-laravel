@extends('layouts.home')

@section('title', 'URL Shortener | uURL')

@section('content')
    <h1 class="lg:text-7xl text-6xl font-bold">
        u<span class="text-red-400 mt-3">URL</span>
    </h1>
    <p class="font-semibold lg:text-lg text-sm text-slate-600 text-center max-w-[500px]">Create short links. Share them
        anywhere. All inside the uURL Connections Platform.</p>
    <div class="flex justify-center gap-3 mt-5">
        <a wire:navigate class="btn bg-red-400 hover:bg-red-700 text-white" href="/login">Get Started</a>
        <a wire:navigate class="btn text-slate-600 bg-white border-[1px]" href="/about">About</a>
    </div>
@endsection
