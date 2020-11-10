@extends('layouts.app')

@section('content')
    <h1>Salut {{ auth()->user()->name }}</h1>
@endsection