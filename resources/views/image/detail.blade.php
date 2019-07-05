@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
        @include('includes.message')
                   <div class="card-pub card  animated 1 fadeIn" >
                <div class="card-header pub" >
                    <div class="data-pub">                      
                        <div class="container-avatar">    
                              <img src=" {{ route('user.avatar', ['filename' => $image->user->image])}} " class="avatar">
                        </div>
                        <div class="data-user">   
                          <a href="{{route('profile',['id' => $image->user_id])}}">  {{ $image->user->name .' |'}}
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
                           <div class="likes">
                            <?php $user_like = false ?>
                            @foreach($image->likes as $like)
                            @if( Auth::user()->id == $like->user_id)
                            <?php $user_like = true ?>
                            @endif
                            @endforeach  
                            @if($user_like)  
                            <img src="{{ asset('img/heart-red.png') }}" data-id="{{$image->id }}" class="heart btn-like" >  
                            @else
                            <img src="{{ asset('img/heart-gray.png') }}"  data-id="{{$image->id }}" class="heart btn-dislike" > 
                            @endif    
                            <span class="likes-count"  id="{{ $image->id}}" >{{ $image->likes->count() }}</span>                        
                        </div>
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
                       <hr>
                           <div class="comment">
                       <div class="data-user">{{ $coment->user->nickname }}</div>
                            <span class="date" >{{\FormatTime::LongTimeFilter($coment->created_at)}}</span>
                            <p class="description spacig-letter">{{$coment->content}}</p>
                            @if(Auth::check() && Auth::user()->id == $coment->user_id   )
                            <a href=" {{ route('comment.delete', $coment->id )  }}"  class="btn btn-primary de"  > delete</a>
                     </div>
                            @endif
                       @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
