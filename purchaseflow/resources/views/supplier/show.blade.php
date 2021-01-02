@extends('supplier.layout')

@section('content')

<h1>Supplier : "{{ $supplier->description }}"</h1>

<div>
    <div>
        <div>
            <p>
                
                <strong>Code:</strong> "{{ $supplier->code }}"<br>
                <strong>Description:</strong> "{{ $supplier->description }}"<br>
                <strong>Created:</strong> "{{ $supplier->created_at }}"<br>
                <strong>Updated:</strong> "{{ $supplier->updated_at }}"<br>

            </p>
        </div>
    </div>

</div>

<a class="btn btn-primary" role = "button"href="{{URL::previous() }}">Back</a>

@endsection