@extends('layouts.app')

@section('title', ' - Home')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-xlg-8">
            <iv class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <h1 class="text-white">Neighbourhoods</h1>
                </div>
                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg container-fluid">
                    <div class="row">
                        @foreach ($neighbourhoods as $neighbourhood)
                            <div class="col col-12 col-md-6 col-lg-3">
                                <div class="p-4">
                                    <img src="/images/{{  $neighbourhood->image }}" alt="{{  $neighbourhood->name }}" class="img-fluid">
                                    <div class="ml-12 py-2">
                                        <h1>{{  $neighbourhood->name }}</h1>
                                        <h3>{{  $neighbourhood->subtitle }}</h3>
                                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                        {{  $neighbourhood->description }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
