@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <item-list :todo="{{$todo}}" :user_id="{{$user_id}}"></item-list>
            </div>
        </div>
    </div>
@endsection
