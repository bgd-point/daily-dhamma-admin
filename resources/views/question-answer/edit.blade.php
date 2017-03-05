@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">

            @include('question-answer.submenu')

            <hr>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ url('question-answer/'.$id) }}">
                {{ method_field('PUT') }}
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="title">Index</label>
                    {{ $id }}
                </div>

                <div class="form-group">
                    <h3>Title</h3>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ $question_answer['title'] }}">
                </div>

                <hr>

                <div class="form-group">
                    <h3>Question</h3>
                    <textarea name="question" id="question">{{ $question_answer['question'] }}</textarea>
                </div>

                <hr>

                <div class="form-group">
                    <h3>Answer</h3>
                    <textarea name="answer" id="answer">{{ $question_answer['answer'] }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="float:left">Update</button>

            </form>
            <form method="post" action="{{ url('/question-answer/'. $id) }}">
                {{ method_field('DELETE') }}
                {!! csrf_field() !!}

                &nbsp; <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('question');
            CKEDITOR.replace('answer');
        })
    </script>
@endsection

