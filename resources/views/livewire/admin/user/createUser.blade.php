<div wire:ignore.self id="user_form" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="min-height: 400px;">
            <div class="modal-header py-5">
                <h5 class="modal-title">User Form
                    <span class="d-block text-muted font-size-sm">Add User</span>
                </h5>
                <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div>
                <form wire:submit.prevent="submit" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input wire:model="name" type="text" class="form-control form-control-solid"
                                placeholder="Enter name" />
                            @error('name')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input wire:model="username" type="text" class="form-control form-control-solid"
                                placeholder="Enter Username" />
                            @error('username')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input wire:model="email" type="text" class="form-control form-control-solid"
                                placeholder="Enter email" />
                            @error('email')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input wire:model="phone" type="text" class="form-control form-control-solid"
                                placeholder="Enter phone" />
                            @error('phone')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <select wire:model="role_id" class="form-control form-control-solid">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">Role {{ $role->name }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label>Country</label>
                            <select wire:model="country_id" class="form-control form-control-solid">
                                <option value="">select country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">Country {{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>City</label>
                            <select wire:model="city_id" class="form-control form-control-solid">
                                <option value="">Select city</option>
                                @forelse($cities as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('city_id')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>









                        <div class="form-group">
                            <label>Password</label>
                            <input wire:model="password" type="password" class="form-control form-control-solid"
                                placeholder="Enter password" />
                            @error('password')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>Confirmation Password</label>
                            <input wire:model="password_confirmation" type="password"
                                class="form-control form-control-solid" placeholder="Enter Username" />
                            @error('password_confirmation')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>{{ __('messages.image') }}</label>
                            <input wire:model="profile_photo_path" type="file"
                                class="form-control form-control-solid"
                                placeholder="{{ __('messages.enter_image') }}" />
                            @error('profile_photo_path')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror

                            @if ($profile_photo_path)
                                Image Preview:
                                <img src="{{ $profile_photo_path->temporaryUrl() }}">
                            @endif
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" wire:click.prevent="store()" data-dismiss="modal" class="btn btn-primary mr-2">Create</button>
                        <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
