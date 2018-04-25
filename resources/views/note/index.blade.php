@extends('layouts.main')

@section('content')
    <div>
        <ul>
            @foreach($shareList['data'] as $share)
                <li>{{ $share['title'] }}</li>
            @endforeach
        </ul>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/note.js') }}"></script>
@endsection