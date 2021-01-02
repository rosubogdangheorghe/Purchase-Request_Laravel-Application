@extends('password.layout')
@section('content')
<div>

<div  class = 'row row-cols-2'>
<div class="title">
        <h2>User Change Passoword</h2>
    </div>

    <div class="addCostcenter">
    <a class="btn btn-primary" role = "button"href="{{route('password.index') }}">Back</a>
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

<form action="{{ url('password',[$user->id]) }}" method="POST" class="was-validated">
        <input type="hidden" name="_method" value="PUT">

        @csrf
        <div class="form-group">
            <label for = "username">UserName</label>
            <input type="text" value = "{{$user->username}}" name="username" class="form-control" placeholder="username" id="username" required>
            <div class="valid-feedback">Valid</div>
            <div class="invalid-feedback">Please fill out this field</div>

        </div>
        <div class="form-group">
            <label for = "lastname">Last Name</label>
            <input type="text" value = "{{$user->lastname}}" name="lastname" class="form-control" placeholder="lastname" id="lastname" required>
            <div class="valid-feedback">Valid</div>
            <div class="invalid-feedback">Please fill out this field</div>
        </div>
        <div class="form-group">
            <label for = "password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="password" id="password" required>
            <div class="valid-feedback">Valid</div>
            <div class="invalid-feedback">Please fill out this field</div>
        </div>  
          <div class="form-group">
            <label for = "passwordConf">Password</label>
            <input type="password" name="passwordConf" class="form-control" placeholder="passwordConfirmation" id="passwordConf" required>
            <div class="valid-feedback">Valid</div>
            <div class="invalid-feedback">Please fill out this field</div> -->
          </div>  
          <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection