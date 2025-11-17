@extends('layouts.login')

@section('content')
<div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login Admin Desa</h2>
    @if ($errors->any())
    <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4 text-sm">
        {{ $errors->first() }}
    </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4 text-sm">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.attempt') }}">
        @csrf
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" name="email" id="email" required autofocus
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#2C7961]">
        </div>
        <div class="mb-6">
            <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
            <input type="password" name="password" id="password" required
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#2C7961]">
        </div>
        <button type="submit"
            class="w-full bg-[#2C7961] hover:bg-[#256952] text-white font-semibold py-2 rounded transition">
            Masuk
        </button>
    </form>
</div>
@endsection
