@extends('layouts.app')

@section('title', ' - Neighbourhoods')

@section('content')
    <h1>Neighbourhoods</h1>
    <neighbourhood-manager :initial-neighbourhoods="{{ $neighbourhoods }}"></neighbourhood-manager>
@endsection
