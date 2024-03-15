@extends('layouts.home')

@section('title', 'About | uURL')

@section('content')
    <div class='flex flex-col justify-center items-center h-screen p-2 gap-5'>
        <div class="rounded-xl drop-shadow-lg bg-white w-[80%] lg:w-[350px] p-6">
            <a wire:navigate href="/">
                <h1 class="lg:text-4xl text-6xl font-bold">
                    u<span class="text-red-400 mt-3">URL</span>
                </h1>
            </a>
            <div class="mt-5">
                <h1 class="font-bold text-xl">
                    About
                </h1>
                <p class="text-gray-500 text-sm mt-2">Something about <b>uURL</b></p>
                <p class="mt-4 text-sm text-gray-500">
                    I developed this stuff just for personal use. I can use this stuff as link Shortener
                </p>
                <p class="mt-1 text-sm text-gray-500 font-semibold">
                    -fkryakbar
                </p>
            </div>
        </div>
    </div>
@endsection
