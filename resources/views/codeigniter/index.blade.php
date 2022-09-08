@extends('codeigniter.layouts.master')

@section('content')
<div class="container">
    <codeigniter-index :database="{{ json_encode($dbs) }}"></codeigniter-index>
</div>
@endsection