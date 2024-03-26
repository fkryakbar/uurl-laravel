@extends('layouts.home')

@section('title', 'Register | uURL')

@section('content')
    <div class="h-screen flex justify-center items-center">
        <div class="lg:w-[350px] w-full mx-5 bg-white shadow-md rounded-lg p-5">
            <a wire:navigate href="/">
                <h1 class="text-2xl font-bold text-red-400">
                    uURL
                </h1>
            </a>
            <p class="mt-5 font-bold text-lg">Register</p>
            <p class="mt-2  text-sm">before continue to <b>uURL</b></p>
            @if (session('success'))
                <div role="alert" class="alert alert-success mt-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            <a href="/auth/redirect">
                <div class="my-3 flex justify-center items-center gap-2 rounded-lg border-[1px] p-3 hover:bg-slate-100">
                    <img src="/google.png" alt="google icon" class="w-7">
                    <p class="text-sm">
                        Continue With Google
                    </p>
                </div>
            </a>
            <p class="text-center">OR</p>
            <form wire:submit='submit' autocomplete="off">
                <div class="form-control w-full max-w-xs">
                    <label class="label">
                        <span class="label-text">Name</span>
                    </label>
                    <input type="text" wire:model='name' name="name" placeholder="Type your name"
                        class="input input-bordered w-full max-w-xs @error('name') input-error  @enderror" />
                    @error('name')
                        <span class="text-red-500 text-xs italic">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-control w-full max-w-xs">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" wire:model='email' name="email" placeholder="Type your email"
                        class="input input-bordered w-full max-w-xs @error('email') input-error  @enderror"" />
                    @error('email')
                        <span class="text-red-500 text-xs italic">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-control w-full max-w-xs">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" wire:model='password' name="password" placeholder="Choose password"
                        class="input input-bordered w-full max-w-xs @error('password') input-error  @enderror"" />
                    @error('password')
                        <span class="text-red-500 text-xs italic">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-control w-full max-w-xs mt-3">
                    <button type="submit" class="btn bg-red-500 text-white hover:bg-red-700">
                        Register
                    </button>
                </div>
            </form>
            <p class="my-3 text-center text-sm">Already registered?
                <a wire:navigate class="text-red-400" href="/login">Here</a> to login
            </p>
        </div>
    </div>
@endsection
