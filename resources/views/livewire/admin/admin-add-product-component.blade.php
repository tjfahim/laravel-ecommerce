<div>
    <div class="container" style="padding:30px 0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Add new product
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.product')}}" class="btn btn-success pull-right">All products</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                        @endif
                        <form class="form-horizontal" enctype="multiple/form-data" wire:submit.prevent="addProduct">
                            @csrf
                            <div class="form-group">
                                <label class="col-md-4 control-label">
                                    Product name
                                </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-md" placeholder="Product Name" wire:model='name' wire:keyup="generateSlug">
                                    @error('name') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4 control-label">Product Slug</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Product Slug" class="form-control input-md" wire:model='slug'>
                                    @error('slug') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4 control-label">Short Description</label>
                                <div class="col-md-4" wire:ignore>
                                    <textarea name="" type="text" class="form-control input-md" placeholder="Short Description" id="short_description" cols="30" rows="10" wire:model='short_description'></textarea>
                                    @error('short_description') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4 control-label">Description</label>
                                <div class="col-md-4" wire:ignore>
                                    <textarea name="" type="text" class="form-control input-md" placeholder="Description" id="description" cols="30" rows="10" wire:model='description'></textarea>
                                </div>
                                @error('description') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4 control-label">Regular Price</label>
                                <div class="col-md-4">
                                    <input type="text" id="" placeholder="Regular Price" class="form-control input-md" wire:model='regular_price'>
                                    @error('regular_price') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4 control-label">Sale Price</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Sale Price" class="form-control input-md" wire:model='sele_price'>
                                    @error('sele_price') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4 control-label">SKU</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="SKU" class="form-control input-md" wire:model='SKU'>
                                    @error('SKU') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4 control-label">Stock</label>
                                <div class="col-md-4">
                                    <select name="" id="" wire:model='stock_status'>
                                        <option value="instock">InStock</option>
                                        <option value="outofstock">Out of Stoct</option>
                                    </select>
                                    @error('stock_status') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4 control-label">Featured</label>
                                <div class="col-md-4">
                                    <select name="" id="" wire:model='featured'>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4 control-label">Quantity</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Questity" class="col-md-4 control-label" value="" wire:model='quantity'>
                                    @error('quantity') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4 control-label">Product Image</label>
                                <div class="col-md-4">
                                    <input type="file" class="input-file" wire:model='image'>
                                    @if ($image)
                                        <img src="{{$image->temporaryUrl()}}" width="120" alt="">
                                    @endif
                                    @error('image') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4 control-label">Product Gallery</label>
                                <div class="col-md-4">
                                    <input type="file" class="input-file" wire:model='images' multiple>
                                    @if ($images)
                                        @foreach ($images as $image)
                                            <img src="{{$image->temporaryUrl()}}" width="120" alt="">
                                        @endforeach
                                    @endif
                                    @error('images') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="" class="col-md-4 control-label">Category</label>
                                <div class="col-md-4">
                                    <select name="" id="" wire:model='category_id'>
                                        <option value="">
                                            Select Category
                                        </option>
                                        @foreach ( $categories as $category )
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                        @error('category_id') <p class="text-danger">{{$message}}</p> @enderror
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" >
                                <label for="" class="col-md-4 control-label">Submit</label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary" wire:model='name'>Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function(){

            tinymce.init({
                selector:'#description',
                setup:function(editor){
                    editor.on('Change',function(e){
                        tinyMCE.triggerSave();
                        var d_data=$('#description').val();
                        @this.set('description',d_data);
                    });
                }
            });
            tinymce.init({
                selector:'#short_description',
                setup:function(editor){
                    editor.on('Change',function(e){
                        tinyMCE.triggerSave();
                        var sd_data=$('#short_description').val();
                        @this.set('short_description',sd_data);
                    });
                }
            });
        });
    </script>

@endpush
