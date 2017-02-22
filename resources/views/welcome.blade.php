@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            Welcome to Daily Dhamma, please login to access admin area
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endsection
