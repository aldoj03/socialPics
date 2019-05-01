@extends('layouts.app')

@section('content')
<div class="container">
      <div class="row justify-content-center">
      <div class="data-pub col-md-6 data-pub-porfile">
          
              <div class="container-avatar container-avatar-profile">    
                  <img src=" {{ route('user.avatar', ['filename' => $user->image])}} " class="avatar">
              </div>
         
              <div class="data-user-porfile">
                      {{ $user->name .' |'}}
                       <span class="nick">   {{'@'.$user->nickname }}</span>                          
              </div>
          
      </div>

        <div class="col-md-7">   
        @foreach($user->images as $image)
            @include('includes/pub',['image' => $image])
         @endforeach    
        </div>
    </div>
</div>
@endsection
