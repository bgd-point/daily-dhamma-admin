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

            <form method="post" action="{{ url('question-answer') }}">
                {!! csrf_field() !!}

                <div class="form-group">
                    <h3>Index</h3>
                    <input type="text" name="id" class="form-control" id="id" placeholder="Index">
                    <pre>
                        Isi index sesuaikan dengan pdf <br>
                        ex: PDF 3 no 24 isi dengan 10324 <hr>
                        XYYZZ <br>
                        X = 1 (adalah kode dari database tanya jawab) <br>
                        YY = NOMER YANG ADA DI JUDUL PDF <br>
                        ZZ = NOMER YANG ADA DI DALAM PDF
                    </pre>
                </div>

                <div class="form-group">
                    <h3>Title</h3>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ old('title') }}">
                </div>

                <hr>

                <div class="form-group">
                    <h3>Question</h3>
                    <textarea name="question" id="question">{{ old('question') }}</textarea>
                </div>

                <hr>

                <div class="form-group">
                    <h3>Answer</h3>
                    <textarea name="answer" id="answer">{{ old('answer') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('question', {
                toolbarGroups: [
                    { name: 'basicstyles', groups: [ 'basicstyles'] },
                    { name: 'links' },
                    { name: 'styles' },
                    { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
                    { name: 'others' }
                ],

                // Remove the redundant buttons from toolbar groups defined above.
                removeButtons: 'Anchor'
            });
            CKEDITOR.replace('answer', {
                toolbarGroups: [
                    { name: 'basicstyles', groups: [ 'basicstyles'] },
                    { name: 'links' },
                    { name: 'styles' },
                    { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
                    { name: 'others' }
                ],

                // Remove the redundant buttons from toolbar groups defined above.
                removeButtons: 'Anchor'
            });
        })
    </script>
@endsection

