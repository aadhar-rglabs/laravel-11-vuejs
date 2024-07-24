<x-app-layout>
    {{-- 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> 
    --}}

    <div class="container-fluid px-4">
        <x-header>
            <strong>{{ __('Dashboard') }}</strong>
        </x-header>
    </div>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- <example-component /> --}}
                    <router-view />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
