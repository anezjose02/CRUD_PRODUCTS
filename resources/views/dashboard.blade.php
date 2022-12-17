<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           WELCOME {{Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if (Auth::user()->role == 'ADMIN')
                    @include('admin_panel')
                @endif
                @if (Auth::user()->role == 'USER')
                    @include('user_panel')
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
