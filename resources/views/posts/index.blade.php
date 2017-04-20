@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>Posts</h1>

        <div class="row">

            <div class="col-xs-12 col-sm-9 col-lg-10" style="border:1px solid green">

                <div class="row">
                    <ul>

                        @foreach ($posts as $post)

                            <li>
                                <a href="{{ $post->url  }}">
                                    {{ $post->title }}
                                </a>
                            </li>

                        @endforeach

                    </ul>

                </div><!--row-->

            </div><!--col-xs-12-->

        </div><!--row-->

    </div><!--container-->

@stop
