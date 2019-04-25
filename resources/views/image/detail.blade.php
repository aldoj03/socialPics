@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @include('includes.message')
       
            <div class="card-pub card " >
                <div class="card-header pub" >
                    <div class="data-pub">
                        <div class="container-avatar ">
                            <img src=" {{ route('user.avatar', ['filename' => $image->user->image])}} " class="avatar">
                        </div>
                        <div class="data-user">
                        <a href=" {{ route('image.detail' , ['id' =>$image->id]) }}">
                            {{ $image->user->name .' |'}}
                             <span class="nick">   {{'@'.$image->user->nickname }}</span>
                        </a>
                        </div>
                    </div>
                </div>
                <div class="card-pub-body card-body ">
                    <div class="image-container">
                        <img src=" {{ route('image.file', ['filename' => $image->image_path]) }} "  >
                    </div>
                    <div class="pub-footer">     
                           <div>            
                        <img src="{{ asset('img/heart_gray.png') }}"  class="heart">   
                            <div class="data-user">{{ $image->user->name }}</div>
                            <p class="description">{{$image->description}}</p>
                        </div>
                        <a href="" class="btn btn-primary btn-info btn-comments">comentarios ({{ count($image->coments)}})</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
