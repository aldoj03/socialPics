<div class="card-pub card  	animated 1 fadeInUp " >
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
                      
                        <img src=" {{ route('image.file', ['filename' => $image->image_path]) }} "  >
                    </a>
                    </div>
                    <div class="pub-footer">
                        <div>
                        <div class="likes">
                            <?php $user_like = false;?>
                            @foreach($image->likes as $like)
                            @if( Auth::user()->id == $like->user_id)
                            <?php $user_like = true;?>
                            @endif
                            @endforeach
                            @if($user_like)
                            <img src="{{ asset('img/heart-red.png') }}" data-id="{{$image->id }}" class="heart btn-like" >
                            @else
                            <img src="{{ asset('img/heart-gray.png') }}"  data-id="{{$image->id }}" class="heart btn-dislike" >
                            @endif
                            <span class="likes-count" id="{{ $image->id}}">{{count($image->likes)}}</span>
                        </div>
                            <span class="data-user desc">{{ $image->user->name.' '}}</span>
                            
                            <span class="date" >{{\FormatTime::LongTimeFilter($image->created_at)}}</span>
                            <p class="description spacig-letter">{{$image->description}}</p>
                        </div>

                        <a href="{{ route('image.detail',['id' => $image->id]) }}" class="btn btn-primary btn-info btn-comments">comentarios ({{ count($image->coments)}})</a>
                        @if( mb_stristr(Request::path(),'profile') && Auth::user()->id == $image->user_id)
                        <a href=" {{ route('image.edit', ['id' => $image->id ]) }} " class="btn btn-primary btn-warning btn-comments">Editar publicacion</a>

                        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-danger btn-comments" data-toggle="modal" data-target="#exampleModalCenter">
  Eliminar publicacion
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar publicacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Estas seguro que deseas eliminar esta publicacion ? Los datos no se podran recuperar
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-primary btn-danger ">Eliminar publicacion</a></button>
      </div>
    </div>
  </div>
</div>
                        @endif
                    </div>
                </div>
            </div>