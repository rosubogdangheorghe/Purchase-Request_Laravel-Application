@extends('user.layout')

@section('content')

<div>
    <div>
            <h2>Users List</h2>
        </div>
    <div >
        <a href="{{ route('user.index') }}" class="btn btn-primary" role = "button">Back</a>
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

    <form action="{{ route('user.store') }}" method="POST" class="was-validated">

        @csrf
        
        <div class="form-group">
            <label for = "username">Username</label>
            <input type="text" name="username" class="form-control" placeholder="username" id="username" required>
            <div class="valid-feedback">Valid</div>
            <div class="invalid-feedback">Please fill out this field</div>

        </div>

        <div class="form-group">
            <label for = "firstname">First Name</label>
            <input type="text" name="firstname" class="form-control" placeholder="firstname" id="firstname" required>
            <div class="valid-feedback">Valid</div>
            <div class="invalid-feedback">Please fill out this field</div>
        </div>
        <div class="form-group">
            <label for = "lastname">Last Name</label>
            <input type="text" name="lastname" class="form-control" placeholder="lastname" id="lastname" required>
            <div class="valid-feedback">Valid</div>
            <div class="invalid-feedback">Please fill out this field</div>
        </div>
        <div class="form-group">
            <label for = "email">Email</label>
            <input type="email" name="email" class="form-control" placeholder="email" id="email" required>
            <div class="valid-feedback">Valid</div>
            <div class="invalid-feedback">Please fill out this field</div>
        </div>  
       

        <div class="form-group">
            <label for = "password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="password" id="password" required>
            <div class="valid-feedback">Valid</div>
            <div class="invalid-feedback">Please fill out this field</div>
        </div>  
        <!-- <div class="form-group">
            <label for = "passwordConf">Password</label>
            <input type="password" name="passwordConf" class="form-control" placeholder="passwordConfirmation" id="passwordConf" required>
            <div class="valid-feedback">Valid</div>
            <div class="invalid-feedback">Please fill out this field</div> -->
        <!-- </div>   -->
        <div class="form-group">
            <label for = "role">Role: </label>
            <select name="role" class="form-control" required>
                <option value="" selected disabled>Select Role</option>
        @foreach($roles as $role)
                <option value="{{$role}}">{{$role}}</option>
        @endforeach
            </select>
            <div class="valid-feedback">Valid</div>
            <div class="invalid-feedback">Please fill out this field</div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection


