@extends('layouts.home')

@section('title', 'Login | uURL')

@section('content')
    <div class="h-screen flex justify-center items-center">
        <div class="lg:w-[350px] w-full mx-5 bg-white shadow-md rounded-lg p-5">
            <a wire:navigate href="/">
                <h1 class="text-2xl font-bold text-red-400">
                    uURL
                </h1>
            </a>
            <p class="mt-5 font-bold text-lg">Login</p>
            <p class="mt-2  text-sm">To continue to <b>uURL</b></p>
            <form wire:submit='submit' class="mt-5" autocomplete="off">
                <div class="form-control w-full max-w-xs">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" wire:model='email' placeholder="Type your email"
                        class="input input-bordered w-full max-w-xs @error('email') input-error  @enderror" />
                    @error('email')
                        <span class="text-red-500 text-xs italic">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-control w-full max-w-xs">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" name="password" wire:model='password' placeholder="Choose password"
                        class="input input-bordered w-full max-w-xs @error('password') input-error  @enderror" />
                    @error('password')
                        <span class="text-red-500 text-xs italic">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-control w-full max-w-xs mt-3">
                    <button type="submit" class="btn bg-red-500 text-white hover:bg-red-700">
                        Login
                    </button>
                </div>
            </form>
            <p class="my-3 text-center text-sm">Don&apos;t have any account? Click
                <a wire:navigate class="text-red-400" href="/register">Here</a> to register
            </p>
        </div>
    </div>
@endsection
