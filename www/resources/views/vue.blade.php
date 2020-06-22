@extends ('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')

    <{{ $component }}
    @foreach ((array) @$params as $field => $value)
        {{ $field }}="{{ $value }}"
    @endforeach
    >{{ @$content }}</{{ $component }}>

@endsection
