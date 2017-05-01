@extends('layouts.app');

@section('content')

    {{-- Show the post --}}

    <h1>{{$post->title}}</h1>

    <p>{{$post->content}}</p>

    <p>{{$post->user->name}}</p>


    {{-- Form for add comments --}}

    <h4>Comentarios</h4>

    {!! Form::open(['route'=>[ 'comments.store',$post ], 'method'=>'POST']) !!}

        {!! Field::textarea('comment') !!}

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

