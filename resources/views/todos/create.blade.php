@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form action="{{route('to-do-list.store')}}" method="post">
                    @csrf
                    @include('partials.to_do_form')
                </form>
            </div>
        </div>
    </div>
@endsection
