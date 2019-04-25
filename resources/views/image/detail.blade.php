@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
        @include('includes.message')
       
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
                        <img src=" {{ route('image.file', ['filename' => $image->image_path]) }} "  >
                    </div>
                    <div class="pub-footer">     
                           <div>            
                        <img src="{{ asset('img/heart_gray.png') }}"  class="heart">   
                            <div class="data-user">{{ $image->user->name }}</div>
                            <span class="date" >{{\FormatTime::LongTimeFilter($image->created_at)}}</span>
                            <p class="description spacig-letter">{{$image->description}}</p>
                        </div>
                       <h5>comentarios ({{count($image->coments)}})</h5>
                       <form action=" {{ route('comment.save') }} " class="form-comment " method="POST">
                       @csrf

                       <input type="hidden" name="image_id" value="{{ $image->id }}" >
                       <hr>
                       <p>
                       <textarea name="content" class="form-control spacig-letter {{$errors->has('content') ? 'is-invalid' : ''}}" ></textarea>
                       </p>
                       <input type="submit" value="comentar" class="btn btn-success">
                       </form>
                   
                       @foreach($image->coments->reverse() as $coment)
                       <div class="data-user">{{ $coment->user->nickname }}</div>
                            <span class="date" >{{\FormatTime::LongTimeFilter($coment->created_at)}}</span>
                            <p class="description spacig-letter">{{$coment->content}}</p>
                       @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
