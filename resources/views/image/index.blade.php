@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ( $images as $image )
                <div class="card mb-4">
                    <div class="card-header">
                        <figure class="container-fluid" style="display: inline">
                            <img src="{{ $image->user->get_avatar }}" class="img-fluid rounded-circle" 
                            style="max-width: 40px; max-height: 40px;">
                        </figure>
                            <a href="{{ route('user.show', $image->user->id) }}" class="container-fluid" style="padding-left: 0;">
                            <p class="card-subtitle" style="display: inline !important; font-size: 18px;">
                                {{ $image->user->nick }}
                            </p>
                        </a>
                        <div class="dropright" style="display: inline-block; float: right;">
                            <button id="dots" type="button" class="dropright-toggle border-0 bg-transparent" 
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="&:focus {border: none;}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg"> 
                                    <path fill-rule="evenodd" d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                </svg>
                            </button>

                            @if ( $image->user_id == Auth::user()->id )
                                <div class="dropdown-menu">
                                    <a href="{{ route('image.edit', $image) }}" class="dropdown-item">Edit</a>
                                    <form action="{{ route('image.destroy', $image) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="dropdown-item fachero" value="Delete">
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="card-body p-0">
                        <figure style="max-height: 700px; overflow: hidden;" class="d-flex justify-content-center align-items-center">
                            <img src="{{ $image->get_path }}" class="card-img-top align-middle">
                        </figure>
                        <div class="container mb-2">
                            <div class="like d-inline-block mr-1" style="cursor: pointer;">
                                <?php $has_like = false; ?>
                                @foreach ( $image->like as $like )
                                    @if ( Auth::user()->id == $like->user_id )
                                        <?php $has_like = true; ?>
                                    @endif
                                @endforeach
                                @if ( $has_like )

                                    <form action="{{ route('like.destroy', $image->like->where('image_id', '=', $image->id)->where('user_id', '=', Auth::user()->id)->first()) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="like-button">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-heart-fill" fill="currentColor" 
                                            xmlns="http://www.w3.org/2000/svg" style="font-size: 22px; color: #ed4956;">
                                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('like.store') }}" method="POST">
                                        @csrf
                                        <input type="text" name="image_id" value="{{ $image->id }}" hidden>
                                        <button type="submit" class="like-button">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-heart" fill="currentColor" 
                                            xmlns="http://www.w3.org/2000/svg" style="font-size: 22px;">
                                                <path fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                            <div class="comment-icon d-inline-block" onclick="document.getElementById('{{ $image->id }}').focus();"
                            style="cursor: pointer;">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat" fill="currentColor" 
                                xmlns="http://www.w3.org/2000/svg" style="font-size: 25px; line-height: 12px;">
                                    <path fill-rule="evenodd" d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="container mb-1">
                            <span>{{ count($image->like) }} likes</span>
                        </div>
                        <div class="container mb-1">
                            <p style="margin: 0;">
                                <a href="#" style="color: #000; font-weight: 600;">
                                    {{ $image->user->nick }}
                                </a>  
                                {{ $image->description }}
                            </p>
                        </div>
                        @if ( isset($image->comment) )
                            @if ( count($image->comment) > 2)
                                <span class="container">
                                    <a href="{{ route('image.show', $image) }}" style="color: #ccc;">View all {{ count($image->comment) }} comments</a>
                                </span>
                            @endif
                            <div class="container comments">
                                <?php $i = 0; ?>
                                @foreach ( $image->comment as $comment )
                                    <p class="mb-1"><strong>{{ $comment->user->nick }}</strong> {{ $comment->content }}</p>

                                    <?php if ( ++$i == 2 ) break; ?>
                                @endforeach
                            </div>
                        @endif
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item p-0"></li>
                            <li class="list-group-item p-0"></li>
                        </ul>
                        <div class="comment d-flex aling-items-center py-2" style="max-height: 60px;">
                            <div class="d-flex flex-nowrap" style="width: 100%;">
                                <form class="form container-fluid align-middle d-flex" style="min-height: 50px;" 
                                action="{{ route('comment.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group m-0" style="height: 45px; width: 90%; display: inline-block;">
                                        <textarea class="c-textarea border-0" placeholder="Add a comment..." 
                                    style="resize: none;" required name="content" id="{{ $image->id }}"></textarea>
                                    </div>
                                    <div class="form-group m-0" style="height: 45px; width: 10%;">
                                        <input type="submit" value="Post" class="c-button">
                                    </div>
                                    <input type="number" name="image_id" value="{{ $image->id }}" hidden>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-8">
            {{ $images->links() }}
        </div>
    </div>
</div>
@endsection