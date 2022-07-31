<div>
    <div class="container" style="padding:30px 0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        All Orders
                    </div>
                    <div class="panel-body">
                        @if (Session::has('order_message'))
                            <div class="alert alert-success" role="alert">{{Session::get('order_message')}}</div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>OrderID</td>
                                    <td>Subtotal</td>
                                    <td>Discount</td>
                                    <td>Tax</td>
                                    <td>Total</td>
                                    <td>First Name</td>
                                    <td>Last Name</td>
                                    <td>Mobile</td>
                                    <td>Email</td>
                                    <td>Zipcode</td>
                                    <td>Status</td>
                                    <td>Order date</td>
                                    <td colspan="2" class="text-center ">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>${{$order->subtotal}}</td>
                                        <td>${{$order->discount}}</td>
                                        <td>${{$order->tax}}</td>
                                        <td>${{$order->total}}</td>
                                        <td>{{$order->firstname}}</td>
                                        <td>{{$order->lastname}}</td>
                                        <td>{{$order->mobile}}</td>
                                        <td>{{$order->email}}</td>
                                        <td>{{$order->zipcode}}</td>
                                        <td>{{$order->status}}</td>
                                        <td>{{$order->created_at}}</td>
                                        <td><a href="{{route('admin.orderDetails',['order_id'=>$order->id])}}" class="btn btn-info btn-sm">Details</a></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-toggle='dropdown' id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Status<span class="caret"></span></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" >
                                                    <a href="#" wire:click.prevent="updateOrderStatus({{$order->id}},'delivered')" class="btn btn-light btn-sm">Delivered</a>
                                                    <a href="#" wire:click.prevent="updateOrderStatus({{$order->id}},'Canceled')" class="btn btn-light btn-sm">Canceled</a>
                                                </div>

                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$orders->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
