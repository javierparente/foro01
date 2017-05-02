@extends('layouts.app')

@section('content')

    {{-- Show the post --}}
    <h1>{{$post->title}}</h1>

    {!! $post->safe_html_content !!}

    {{--Only show this form if the user is subscribed to this post--}}
    @if(auth()->check() && !auth()->user()->isSubscribedTo($post))
        <p>{{$post->user->name}}</p>

        {{--Form for subscribe to the post--}}
        {!! Form::open(['route'=>['post.subscribe', $post], 'method'=>'POST']) !!}}

            <button type="submit">Suscribirse al post</button>

        {!! Form::close() !!}
    @endif

    {{-- Form for add comments --}}
    <h4>Comentarios</h4>

    {!! Form::open(['route'=>[ 'comments.store',$post ], 'method'=>'POST']) !!}

        {!! Field::textarea('comment', null, ['size'=>'*x5']) !!}

        <button type="submit"> Publicar comentario </button>

    {!! Form::close() !!}


    {{-- List of Comments --}}
    @foreach($post->latestComments as $comment)

        <article class="{{$comment->answer ? 'answer':''}}">

            {{ $comment->comment }}

            {{-- We check if the connected user can accept this comment --}}
            @if(Gate::allows('accept', $comment) )

                {!! Form::open(['route'=>['comments.accept', $comment], 'method'=>'POST']) !!}}

                    <button type="submit">Aceptar respuesta</button>

                {!! Form::close() !!}

            @endif

        </article>

    @endforeach

@endsection

