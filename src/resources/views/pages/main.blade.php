@extends('layouts.default')

@section('content')
    <div class="flex flex-col items-center p-7 rounded-2xl">
        <div>
            <img class="size-48 shadow-xl rounded-lg" alt="Cover" src="/img/cover.png" />
        </div>
        <div class="flex flex-col items-center mt-4 space-y-2">
            <span class="text-xl font-bold">Class Warfare</span>
            <span class="text-lg">The Anti-Patterns</span>
            <div class="flex items-center space-x-2">
                <span>No. 4</span>
                <span>·</span>
                <span>2025</span>
            </div>
        </div>
    </div>
@endsection
