@extends('accounting.layout')

@section('content')

<div>
    <div>
        <h2>Purchase requisition form - lines input </h2>
    </div>
    <div>
        <a href="{{ route('accounting.show',$purchasebody->id) }}" class="btn btn-primary" role="button">Back</a>
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
@if ($message = Session::get('success'))
    <div>
        {{$message}}
    </div>
@endif

@if(Session::has('message'))

    <p class = "alert {{Session::get('alert-class','alert-info')}}">{{Session::get('message')}}</p>
@endif


<div class="table-responsive">
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Issue date</th>
            <th>Delivery date</th>
            <th>Cost center</th>
            <th>Supplier</th>
            <th>User</th>
            <th>Status</th>
        </tr>
    
   
        <tr>
            <td>{{$purchaseHeaderById[0]->id}}</td>
            <td>{{$purchaseHeaderById[0]->issueDate}}</td>
            <td>{{$purchaseHeaderById[0]->deliveryDate}}</td>
            <td>{{$purchaseHeaderById[0]->costcenter}}</td>
            <td>{{$purchaseHeaderById[0]->supplier}}</td>
            <td>{{$purchaseHeaderById[0]->user}}</td>
            <td>{{$purchaseHeaderById[0]->status}}</td>
 
        </tr>
    </table>
</div>
    <hr>


    <form action="{{ url('accounting',$purchasebody->id) }}" method="POST" class="was-validated">
    <input type="hidden" name="_method" value="PUT">
    @csrf
        <div class="form-group">
            <label for = purchaseheaders_id>PR Number</label>
            <input type = "number" name = "purchaseheaders_id" value = "{{ $purchaseHeaderById[0]->id }}" id ="purchaseheaders_id" readonly="readonly" >
            <label for = prLine_id>PR Line Number</label>
            <input type = "number" name =  "prLine_id" value = "{{ $purchasebody->id }}" id ="prLine_id" readonly="readonly" >

        </div>    
   
    <div>
        <div class="form-group">
            <label for="description" class="mb-2 mr-sm-2">Description:</label>
            <input type="text" name="description" value = "{{ $purchasebody->description}}" class="form-control col mb-2 mr-sm-2" readonly="readonly" placeholder="description" id="description" required>
        </div>    
        <div class="form-group">
            <label for="unitMeasure" class="mb-2 mr-sm-2">Unit measure:</label>
            <input type="text" name= "unitMeasure" value = "{{$purchasebody->unitMeasure}}" class="form-control col mb-2 mr-sm-2 col-sm" readonly="readonly" required>
        
        </div> 
        <div class="form-group">
            <label for="quantity" class="mb-2 mr-sm-2">Quantity:</label>
            <input type="number" name="quantity" value="{{ $purchasebody->quantity }}" class="form-control col mb-2 mr-sm-2 "  readonly="readonly" placeholder="0.00" id="quantity" min="0" step="0.01" required>
        </div>
        <br>
        <div class="form-group">
            <label for="unitPrice" class="mb-2 mr-sm-2">Unit Price:</label>
            <input type="number" name="unitPrice" value="{{ $purchasebody->unitPrice }}" class="form-control col mb-2 mr-sm-2"  readonly="readonly" placeholder="0.00" id="unitPrice" min="0" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="prvalue" class="mb-2 mr-sm-2">Value:</label>
            <input type="number"  name="prvalue" value = "{{ $purchasebody->prvalue }}" class="form-control col mb-2 mr-sm-2"  readonly="readonly" placeholder="0.00" min="0" step="0.01" id="prvalue" required>
        </div>
       
   
        <div class="valid-feedback">Valid</div>
        <div class="invalid-feedback">Please fill out this field</div>
        </div>

        <div>
         <p>Accounting division check:</p>
      
            <div class="form-group">
                <select name="budgeted" class="form-control col-sm mb-2 mr-sm-2 w-25" required>
                    <option value="" selected>Budgeted Y/N</option>
                     @foreach($budgeted as $budget)
                    <option value="{{$budget}}">{{$budget}}</option>
                      @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="budgetLine" class="mb-2 mr-sm-2">Budget Line:</label>
                <input type="text" name="budgetLine" class="form-control col-sm mb-2 mr-sm-2 w-25" placeholder="budgetLine" id="budgetLine" required>
            </div>
        </div>
        <button type="submit" class="btn btn-sm bth-block btn-info col mb-2 mr-sm-2">Save</button>
    </form>  



@endsection