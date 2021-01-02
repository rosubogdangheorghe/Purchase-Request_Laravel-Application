@extends('password.layout')

@section('content')


<div>

    <div  class = 'row row-cols-2'>
    <div class="title">
            <h2>User Change Passoword</h2>
        </div>
  
        <div class="addCostcenter">
        <a class="btn btn-primary" role = "button"href="{{URL::previous() }}">Back</a>
        </div>
    </div>


@if ($message = Session::get('success'))
    <div>
        {{$message}}
    </div>
@endif

@if(Session::has('message'))

    <p class = "alert {{Session::get('alert-class','alert-info')}}">{{Session::get('message')}}</p>
@endif

@if(sizeof($user)>0) 
<div class="table-responsive">
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>UserName</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    
    @foreach($user as $us)
        <tr>
            <td>{{$us->id}}</td>
            <td>{{$us->username}}</td>
            <td>{{$us->firstname}}</td>
            <td>{{$us->lastname}}</td>
            <td>{{$us->email}}</td>
            <td>
                <form action = "{{ route('password.edit',$us->id) }}" method="POST" >
                    <a href="{{ route('password.edit',$us->id) }}" class="btn btn-primary" role = "button">Change password</a>
                @csrf
               
                </form>

            </td>
        </tr>
    @endforeach
    </table>
</div>

@else 
    <div >
         <p>Start adding users to dataBase</p>
    </div>

</div>
@endif

@endsection