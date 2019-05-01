<div class="card-pub card " >
                <div class="card-header pub" >
                    <div class="data-pub">
                     <div class="container-avatar">    
                           <img src=" {{ route('user.avatar', ['filename' => $image->user->image])}} " class="avatar">
                     </div> 
                     
                        <div class="data-user">
                            <a href="{{ route('profile',['id' => $image->user_id]) }} ">{{ $image->user->name .' |'}}
                             <span class="nick">   {{'@'.$image->user->nickname }}</span>
                            </a>
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
                            <span class="likes-count">{{count($image->likes)}}</span>                        
                        </div>
                            <span class="data-user desc">{{ $image->user->name.'|'}}</span>
                            <span class="date" >{{\FormatTime::LongTimeFilter($image->created_at)}}</span>
                            <p class="description spacig-letter">{{$image->description}}</p>
                        </div>
                        <a href="" class="btn btn-primary btn-info btn-comments">comentarios ({{ count($image->coments)}})</a>
                    </div>
                </div>
            </div>