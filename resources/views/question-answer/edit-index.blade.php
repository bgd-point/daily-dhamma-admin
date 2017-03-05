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

            <form method="post" action="{{ url('question-answer/'.$id.'/update-index') }}">
                {!! csrf_field() !!}

                <div class="form-group">
                    <h3>Index</h3>
                    <input type="text" class="form-control" id="id" name="id" value="{{ $id }}">
                    <input type="hidden" class="form-control" id="old-id" name="old-id" value="{{ $id }}">
                    <br>
                    <button type="submit" class="btn btn-primary" style="float:left">Update Index</button>
                    <br><br>
                </div>

                <hr>

                <div class="form-group">
                    <h3>Title</h3>
                    {{ $question_answer['title'] }}
                </div>

                <hr>

                <div class="form-group">
                    <h3>Question</h3>
                    {!! $question_answer['question'] !!}
                </div>

                <hr>

                <div class="form-group">
                    <h3>Answer</h3>
                    {!! $question_answer['answer'] !!}
                </div>



            </form>
        </div>
    </div>
@endsection

