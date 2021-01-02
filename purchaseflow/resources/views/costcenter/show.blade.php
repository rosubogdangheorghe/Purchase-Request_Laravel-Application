@extends('costcenter.layout')

@section('content')

<h1>Costcenter : "{{ $costcenter->description }}"</h1>

<div>
    <div>
        <div>
            <p>
                
                <strong>Code:</strong> "{{ $costcenter->code }}"<br>
                <strong>Description:</strong> "{{ $costcenter->description }}"<br>
                <strong>Created:</strong> "{{ $costcenter->created_at }}"<br>
                <strong>Updated:</strong> "{{ $costcenter->updated_at }}"<br>

            </p>
        </div>
    </div>

</div>

<a class="btn btn-primary" role = "button"href="{{URL::previous() }}">Back</a>

@endsection