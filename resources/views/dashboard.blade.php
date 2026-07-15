@extends('layouts.main')

@section('title')
Eduxamp | Dashboard
@endsection

@section('css_custom')
@endsection

@section('content')
<div class="flex-grow-1 p-4">
  <h1>{{ $greeting }} {{ auth()->user()->name }}</h1>
</div>
@endsection

@section('js_custom')
@endsection