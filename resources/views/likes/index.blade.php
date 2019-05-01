@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <h1>Mis imagenes favoritas</h1>
            <hr>
            @foreach($likes as $like)
            @include('includes/pub', ['image' => $like->image ])
            @endforeach
            <div class="row justify-content-center">
         {{$likes->links()}}
             </div> 
        </div>
    </div>
</div>
@endsection
