@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
        @include('includes.message')
        @foreach($images as $image)
            <div class="card-pub card " >
                <div class="card-header pub" >
                    <div class="data-pub">
                        <div class="container-avatar ">
                            <img src=" {{ route('user.avatar', ['filename' => $image->user->image])}} " class="avatar">
                        </div>
                        <div class="data-user">
                            {{ $image->user->name .' |'}}
                             <span class="nick">   {{'@'.$image->user->nickname }}</span>
                        
                        </div>
                    </div>
                </div>
                <div class="card-pub-body card-body ">
                    <div class="image-container">
                        <a href=" {{ route('image.detail' , ['id' =>$image->id]) }}">
                        <img src=" {{ route('image.file', ['filename' => $image->image_path]) }} "  >
                    </a>
                    </div>
                    <div class="pub-footer">     
                        <div>            
                        <img src="{{ asset('img/heart_gray.png') }}"  class="heart">   
                            <span class="data-user desc">{{ $image->user->name.'|'}}</span>
                            <span class="date" >{{\FormatTime::LongTimeFilter($image->created_at)}}</span>
                            <p class="description spacig-letter">{{$image->description}}</p>
                        </div>
                        <a href="" class="btn btn-primary btn-info btn-comments">comentarios ({{ count($image->coments)}})</a>
                    </div>
                </div>
            </div>
         @endforeach   
             <div class="row justify-content-center">
         {{$images->links()}}
             </div> 
        </div>
    </div>
</div>
@endsection
