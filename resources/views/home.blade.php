@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
        @include('includes.message')
        @foreach($images as $image)
            <div class="card-pub card " >
                <div class="card-header pub" >
                    <div class="data-pub">
                        <div class="container-avatar ">
                            <img src=" {{ route('user.avatar', ['filename' => $image->user->image])}} " class="avatar">
                        </div>
                        <div class="data-user">
                              {{  '@'.$image->user->nickname }}
                        </div>
                    </div>
                </div>
                <div class="card-pub-body card-body ">
                    <div class="image-container">
                        <img src=" {{ route('image.file', ['filename' => $image->image_path]) }} "  >
                    </div>
                    <div class="pub-footer">
                        <div class="description-pub">
                            <div class="data-user">{{ $image->user->name }}</div>
                        </div>
                    </div>
                </div>
            </div>
         @endforeach   
        </div>
    </div>
</div>
@endsection
