@extends('purchaseheader.layout')

@section('content')


<div>

    <div  class = 'row row-cols-2'> 
    <div class="title">
            <h2>Purchase Requisition</h2>
        </div>
  
        <div class="addCostcenter">
            <a href="{{route('purchaseheader.index')}}" class="btn btn-primary" role = "button">Back to Purchase requisitions list</a>
            <a class="btn btn-primary" href="{{route('pdf.createPDF',$purchaseHeaderById[0]->id) }}">Export to PDF</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
        <tr>
            <th>Number</th>
            <th>Issue date</th>
            <th>Delivery date</th>
            <th>Cost center</th>
            <th>Supplier</th>
            <th>Currency</th>
            <th>User</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <tr>
            <td>{{$purchaseHeaderById[0]->id}}</td>
            <td>{{$purchaseHeaderById[0]->issueDate}}</td>
            <td>{{$purchaseHeaderById[0]->deliveryDate}}</td>
            <td>{{$purchaseHeaderById[0]->costcenter}}</td>
            <td>{{$purchaseHeaderById[0]->supplier}}</td>
            <td>{{$purchaseHeaderById[0]->currency}}</td>
            <td>{{$purchaseHeaderById[0]->user}}</td>
            <td>{{$purchaseHeaderById[0]->status}}</td>
           <td> <a href="{{ route('purchaseheader.edit',$purchaseHeaderById[0]->id) }}" class="btn btn-warning" role = "button">Edit PR Header</a></td>
           
        </tr>
        </table>
        <table class="table table-hover">
        
            <th>Line Number</th>
            <th>Description</th>
            <th>Unit Measure</th>
            <th>Quantity</th>
            <th>Unit price</th>
            <th>Value</th>
            <th>Accounting Division check</th>
            <th>Budget Line</th>
            <th>Actions</th>
            <?php $i = 0;?>
            @foreach($prLines as $prLine)
            <?php $i++;?>     
            <tr>
           
            <td><?php echo $i; ?></td>
            <td>{{ $prLine->description }}</td>
            <td>{{ $prLine->unitMeasure }}</td>
            <td>{{ $prLine->quantity }}</td>
            <td>{{ $prLine->unitPrice }}</td>
            <td>{{ $prLine->prvalue }}</td>
            <td>{{ $prLine->budgeted }}</td>
            <td>{{ $prLine->budgetLine }}</td>
            <td><a href="{{  route('purchasebody.editPrLine',[$prLine->id,$purchaseHeaderById[0]->id]) }}" class="btn btn-primary" role = "button">Edit</a></td>
            
            <td>
                <form action = "{{ route('purchasebody.destroy',$prLine->id) }}" method="POST">
                <!-- <a href="{{ route('purchasebody.destroy',$prLine->id) }}" class="btn btn-primary" role = "button">Delete</a></td> -->
                @csrf
                    @method('DELETE')
                    <button type="submit" class = "btn btn-danger">Delete</button>

                </form>
            </td>  
          
            </tr>
         
            @endforeach

        </table>

    
    </div>



</div>








@endsection