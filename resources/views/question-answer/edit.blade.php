@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">

            @include('question-answer.submenu')

            <hr>

            <form method="post" action="{{ url('question-answer/'.$id) }}">
                {{ method_field('PUT') }}
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ $question_answer['title'] }}">
                </div>

                <div class="form-group">
                    <label for="title">Question</label>
                    <textarea name="question" id="question">{{ $question_answer['question'] }}</textarea>
                </div>

                <div class="form-group">
                    <label for="title">Answer</label>
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

