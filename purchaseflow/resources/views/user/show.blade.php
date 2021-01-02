@extends('supplier.layout')

@section('content')

<h1>User : "{{ $user->username }}"</h1>

<div>
    <div>
        <div>
            <p>
                
                <strong>Username:</strong> "{{ $user->username }}"<br>
                <strong>Last Name:</strong> "{{ $user->lastname }}"<br>
                <strong>First Name:</strong> "{{ $user->firstname }}"<br>
                <strong>Email:</strong> "{{ $user->email }}"<br>
                <strong>Role:</strong> "{{ $user->role }}"<br>
                <strong>Created:</strong> "{{ $user->created_at }}"<br>
                <strong>Updated:</strong> "{{ $user->updated_at }}"<br>

            </p>
        </div>
    </div>

</div>

<a class="btn btn-primary" role = "button"href="{{URL::previous() }}">Back</a>

@endsection