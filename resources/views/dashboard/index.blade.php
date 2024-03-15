@extends('layouts.dashboard')

@section('title', 'Your URLs')

@section('content')
    <div class="lg:w-[70%] mx-3 lg:mx-auto lg:mt-[100px] mt-5 space-y-4">
        <div class="shadow bg-white rounded-lg p-5">
            <a href="/" wire:navigate>
                <h1 class="lg:text-5xl text-6xl font-bold">
                    u<span class="text-red-400 mt-3">URL</span>
                </h1>
            </a>
            <div class="flex justify-between items-center">
                <p class="text-slate-500 font-semibold">Welcome, {{ Auth::user()->name }}</p>
                <div class="flex gap-2">
                    <a href="/logout" class="btn btn-sm bg-red-500 text-white hover:bg-red-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div x-data="uurl" class="grid lg:grid-cols-2 grid-cols-1 gap-4">
            <div class="shadow bg-white rounded-lg p-5 h-fit">
                <h3 class="font-bold text-lg">Short a link!</h3>
                <form wire:submit='submit' autocomplete="off">
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Paste a long link</span>
                        </div>
                        <input type="text" wire:model='long_link' placeholder="Type here"
                            class="input input-bordered w-full @error('long_link') input-error  @enderror" />
                        @error('long_link')
                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                        @enderror
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Enter a back half</span>
                        </div>
                        <div class="join">
                            <div class="join-item bg-slate-200 p-2 font-semibold flex items-center text-slate-500">
                                uurl.my.id/
                            </div>
                            <input type="text" wire:model='back_half' placeholder="Example: favorite-link"
                                class="input input-bordered w-full join-item  @error('back_half') input-error  @enderror"
                                name="back_half">
                        </div>
                        @error('back_half')
                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                        @enderror
                    </label>
                    <div class="mt-5">
                        <button class="btn text-white w-full bg-red-500 hover:bg-red-700">Get the
                            link</button>
                    </div>
                </form>
            </div>
            <div class="shadow bg-white rounded-lg p-5 mb-5">
                <div class="flex gap-3 flex-wrap">
                    @forelse ($urls as $url)
                        <div wire:key='{{ $url->id }}' class="card bg-base-100 border-[1px] w-full">
                            <div class="card-body gap-1">
                                <div class="flex justify-between">
                                    <a href="{{ $url->secure_long_link() }}" class="text-xl font-bold hover:underline">
                                        {{ $url->title() }}
                                    </a>
                                    <div class="flex items-center gap-2">
                                        <button class="btn btn-sm bg-red-500 text-white hover:bg-red-700"
                                            x-on:click="delete_link('{{ $url->back_half }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                class="w-4 h-4">
                                                <path fill-rule="evenodd"
                                                    d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <button x-on:click='copy_link("https://uurl.my.id/{{ $url->back_half }}")'
                                            class="btn btn-sm bg-green-500 hover:bg-green-700 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                class="w-4 h-4">
                                                <path fill-rule="evenodd"
                                                    d="M17.663 3.118c.225.015.45.032.673.05C19.876 3.298 21 4.604 21 6.109v9.642a3 3 0 0 1-3 3V16.5c0-5.922-4.576-10.775-10.384-11.217.324-1.132 1.3-2.01 2.548-2.114.224-.019.448-.036.673-.051A3 3 0 0 1 13.5 1.5H15a3 3 0 0 1 2.663 1.618ZM12 4.5A1.5 1.5 0 0 1 13.5 3H15a1.5 1.5 0 0 1 1.5 1.5H12Z"
                                                    clip-rule="evenodd" />
                                                <path
                                                    d="M3 8.625c0-1.036.84-1.875 1.875-1.875h.375A3.75 3.75 0 0 1 9 10.5v1.875c0 1.036.84 1.875 1.875 1.875h1.875A3.75 3.75 0 0 1 16.5 18v2.625c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625v-12Z" />
                                                <path
                                                    d="M10.5 10.5a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963 5.23 5.23 0 0 0-3.434-1.279h-1.875a.375.375 0 0 1-.375-.375V10.5Z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <a href="https://uurl.my.id/{{ $url->back_half }}"
                                    class="text-blue-500 hover:underline font-semibold"
                                    target="_blank">uurl.my.id/{{ $url->back_half }}</a>
                                <a href="{{ $url->secure_long_link() }}"
                                    class="text-xs line-clamp-1	 hover:underline font-semibold"
                                    target="_blank">{{ $url->secure_long_link() }}</a>
                                <div class="flex gap-4 items-center text-xs mt-5">
                                    <div class="flex gap-1 items-center text-green-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4">
                                            <path
                                                d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75ZM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 0 1-1.875-1.875V8.625ZM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 0 1 3 19.875v-6.75Z" />
                                        </svg>
                                        {{ $url->clicks }} Clicks
                                    </div>
                                    <div class="flex gap-1 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4">
                                            <path fill-rule="evenodd"
                                                d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z"
                                                clip-rule="evenodd" />
                                        </svg>

                                        {{ $url->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="mx-auto lg:w-[50%] w-[70%]">
                            <img src="/Empty-rafiki.svg" alt="Empty">
                            <p class="text-center text-xs text-slate-500">Short a link to make one</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @script
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            $wire.on('alert', (event) => {
                Toast.fire({
                    icon: event.icon,
                    title: event.title
                });

            });

            Alpine.data('uurl', () => {
                return {
                    delete_link(backHalf) {
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "Record will be deleted permanently",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Delete!'
                        }).then(async (result) => {
                            if (result.isConfirmed) {
                                await $wire.delete_link(backHalf);
                            }
                        })
                    },
                    copy_link(link) {
                        navigator.clipboard.writeText(link)
                            .then(function() {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Copied to clipboard'
                                });
                            })
                            .catch(function(err) {
                                console.error("Error copying text to clipboard: ", err);
                            });
                    },
                }
            })
        </script>
    @endscript
@endsection
