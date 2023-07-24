<div wire:ignore.self id="Product_form" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl{{ config('app.locale') == 'ar' ? ' rtl' : '' }}">
        <div class="modal-content" style="min-height: 400px;">
            <div class="modal-header py-5">
                <h5 class="modal-title{{ config('app.locale') == 'ar' ? ' text-right' : '' }}">
                    {{ __('messages.product') }}
                    <span class="d-block text-muted font-size-sm">{{ __('messages.add_product') }}</span>
                </h5>
                <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div>
                <form wire:submit.prevent="store" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ __('messages.name') }}</label>
                            <input wire:model="name" type="text" class="form-control form-control-solid"
                                placeholder="{{ __('messages.enter_name') }}" />
                            @error('name')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select wire:model="category_id" class="form-control">
                                <option value="">Select Category</option>
                                @if ($categories)
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ __('messages.price') }}</label>
                            <input wire:model="price" type="text" class="form-control form-control-solid"
                                placeholder="{{ __('messages.enter_price') }}" />
                            @error('price')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('messages.discount_price') }}</label>
                            <input wire:model="discount_price" type="text" class="form-control form-control-solid"
                                placeholder="{{ __('messages.enter_discount_price') }}" />
                            @error('discount_price')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('messages.qty') }}</label>
                            <input wire:model="qty" type="text" class="form-control form-control-solid"
                                placeholder="{{ __('messages.enter_qty') }}" />
                            @error('qty')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>{{ __('messages.description') }}</label>
                            <input wire:model="description" type="text" class="form-control form-control-solid"
                                placeholder="{{ __('messages.enter_description') }}" />
                            @error('description')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>{{ __('messages.image') }}</label>
                            <input wire:model="image" type="file" class="form-control form-control-solid"
                                placeholder="{{ __('messages.enter_image') }}" />
                            @error('image')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror

                            @if ($image)
                                Image Preview:
                                <img src="{{ $image->temporaryUrl() }}">
                            @endif
                        </div>

                        <div class="form-group">
                            <label>{{ __('messages.activity') }}</label>
                            <div class="checkbox-inline">
                                <label class="checkbox checkbox-solid">
                                    <input wire:model="status" type="checkbox" />
                                    <span></span>
                                    {{ __('messages.status') }}
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="button" wire:click.prevent="store()" class="btn btn-primary mr-2"
                            data-dismiss="modal">{{ __('messages.create') }}</button>
                        <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('messages.close') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
