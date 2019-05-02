@extends('layouts.app')

@section('content')
<div class="container">
      <div class="row justify-content-center">
      <div class="data-pub col-md-6 data-pub-profile">
          
              <div class="container-avatar container-avatar-profile">    
                  <img src=" {{ route('user.avatar', ['filename' => $user->image])}} " class="avatar">
              </div>
         
              <div class="data-user-profile">
                  <span class="nick nick-profile">   {{'@'.$user->nickname }}</span>        
                      {{ $user->name .' '.$user->surname}}
                           <span class="date date-profile" >{{'Se unio: '.\FormatTime::LongTimeFilter($user->created_at)}}</span>
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
