@extends('costcenter.layout')

@section('content')

<div >
    <div>
        <h2>Cost Center List</h2>
    </div>
    <div>
        <a class="btn btn-primary" href="{{ route('costcenter.index') }}">Back</a>
    </div>

</div>

@if($errors->any())
    <div>
       <p> <strong>Ops!</strong>There is some problems with your input</p>
       <ul>
           @foreach($errors->all() as $error)
           <li>{{$error}}</li>
           @endforeach
       </ul>
    </div>
@endif

    <form action="{{ route('costcenter.store') }}" method="POST" class="was-validated">

        @csrf
        
        <div class="form-group">
            <label for = "code">Code</label>
            <input type="text" name="code" class="form-control" placeholder="code" id="code" required>
            <div class="valid-feedback">Valid</div>
            <div class="invalid-feedback">Please fill out this field</div>

        </div>

        <div class="form-group">
            <label for = "description">Costcenter Description</label>
            <input type="text" name="description" class="form-control" placeholder="description" id="description" required>
            <div class="valid-feedback">Valid</div>
            <div class="invalid-feedback">Please fill out this field</div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection