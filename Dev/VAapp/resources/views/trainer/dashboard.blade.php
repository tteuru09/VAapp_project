<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard for Trainers') }}
        </h2>
    </x-slot>
    @if (session('canoes') != null)
        {{ dd(session('canoes')) }}
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-green-600 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Welcome to trainer's page!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
