@extends('layouts.app')

@section('title', ' - Neighbourhood Editor')

@section('content')
    <neighbourhood-editor :neighbourhoods="{{ $neighbourhoods }}"></neighbourhood-editor>
@endsection
