<div>
   <div class="container py5">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Settings
                </div>
                <div class="panel-body">
                    @if (Session::has('message'))
                        <p class="alert alert-success">{{Session::get('message')}}</p>
                    @endif
                    <form action="" class="form-horizontal" wire:submit.prevent='saveSettings'>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Email</label>
                            <input type="email" placeholder="Email" class="col-md-4 form-control" wire:model='email'>
                            @error('email')
                            <div class='text-danger'>{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Phone</label>
                            <input type="text" placeholder="Phone" class="col-md-4 form-control input-md" wire:model='phone'>
                            @error('phone')
                            <div class='text-danger'>{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Phone2</label>
                            <input type="text" placeholder="Phone2" class="form-control input-md" wire:model='phone2'>
                            @error('phone2')
                            <div class='text-danger'>{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Address</label>
                            <input type="text" placeholder="Address" class="form-control input-md" wire:model='address'>
                            @error('address')
                            <div class='text-danger'>{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Map</label>
                            <input type="text" placeholder="Map" class="form-control input-md" wire:model='map'>
                            @error('map')
                            <div class='text-danger'>{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Twitter</label>
                            <input type="text" placeholder="Twitter" class="form-control input-md" wire:model='twitter'>
                            @error('twitter')
                            <div class='text-danger'>{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Facebook</label>
                            <input type="text" placeholder="facebook" class="form-control input-md" wire:model='facebook'>
                            @error('facebook')
                            <div class='text-danger'>{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Pinterest</label>
                            <input type="text" placeholder="Pinterest" class="form-control input-md" wire:model='pinterest'>
                            @error('pinterest')
                            <div class='text-danger'>{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Instagram</label>
                            <input type="text" placeholder="Instagram" class="form-control input-md" wire:model='instagram'>
                            @error('instagram')
                            <div class='text-danger'>{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Linkedin</label>
                            <input type="text" placeholder="Linkedin" class="form-control input-md" wire:model='linkedin'>
                            @error('linkedin')
                            <div class='text-danger'>{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label"></label>
                            <button type="submit" class="btn btn-primary">Save`</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   </div>
</div>
