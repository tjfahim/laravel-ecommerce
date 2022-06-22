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
                            All Category
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('admin.addCategory')}}" class="btn btn-success pull-right">Add New</a>
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
                                <th>Categories Name</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category )
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->slug}}</td>
                                    <td>
                                        <a href="{{route('category.edit',['category_slug'=>$category->slug])}}" class=""><i class="fa fa-edit fa-2x"></i></a>
                                        <a href="" onclick="confirm('Are you sure,You want to delete this category?')||event.stopImmediatePropagation()" wire:click.prevent="deleteCategory({{$category->id}})">
                                        <i class="fa fa-times fa-2x text-danger"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$categories->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

</div>
