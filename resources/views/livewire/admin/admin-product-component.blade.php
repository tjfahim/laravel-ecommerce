<div>
    <style>



    </style>

<div class="container" style="padding:30px 0;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            All Product
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('adminproduct.add')}}" class="btn btn-success pull-right">Add New Product</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    <table class="table table-striped">
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                        @endif
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Sale Price</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product )
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td><img src="{{asset("assets/images/products")}}/{{$product->image}}" alt="" width='60'></td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->stock_status}}</td>
                                    <td>{{$product->regular_price}}</td>
                                    <td>{{$product->sele_price}}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td>{{$product->created_at}}</td>
                                    <td>
                                        <a href="{{route('adminproduct.edit',['product_slug'=>$product->slug])}}" class="fa fa-edit fa-2x text-info"></a>
                                        <a href="#" onclick="confirm('Are you sure,You want to delete this product?')||event.stopImmediatePropagation()" wire:click.prevent="deleteProduct({{$product->id}})"><i class="fa fa-times fa-2x text-danger"></i></a>
                                    </td>
                                    <td>
                                        {{-- <a href="{{route('category.edit',['category_slug'=>$category->slug])}}" class=""><i class="fa fa-edit fa-2x"></i></a>
                                        <a href="" wire:click.prevent="deleteCategory({{$category->id}})">
                                        <i class="fa fa-times fa-2x"></i></a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

</div>
