@extends('layouts.app', ['title' => 'Log Book'])

@section('breadcrumb')
    <div class="breadcrumb-wrapper">
        <h1>Log Book</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        <span class="mdi mdi-home"></span>
                    </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    Log Boox
                </li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="row">
    </div>
@endsection
