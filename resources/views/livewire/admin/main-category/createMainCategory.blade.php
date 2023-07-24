<div wire:ignore.self id="Category_form" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl{{ config('app.locale') == 'ar' ? ' rtl' : '' }}">
        <div class="modal-content" style="min-height: 400px;">
            <div class="modal-header py-5">
                <h5 class="modal-title{{ config('app.locale') == 'ar' ? ' text-right' : '' }}">
                    {{ __('messages.main_category') }}
                    <span class="d-block text-muted font-size-sm">{{ __('messages.add_category') }}</span>
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
                            <label
                                class="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">{{ __('messages.name_arabic') }}</label>
                            <input wire:model="name.ar" type="text" class="form-control form-control-solid"
                                placeholder="{{ __('messages.enter_arabic_name') }}" lang="ar" />
                            @error('name.ar')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label
                                class="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">{{ __('messages.name_english') }}</label>
                            <input wire:model="name.en" type="text" class="form-control form-control-solid"
                                placeholder="{{ __('messages.enter_english_name') }}" lang="en" />
                            @error('name.en')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label
                                class="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">{{ __('messages.photo') }}</label>
                            <input wire:model="photo" type="file" class="form-control form-control-solid"
                                placeholder="{{ __('messages.enter_photo') }}" />
                            @error('photo')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror

                            @if ($photo)
                                Photo Preview:
                                <img src="{{ $photo->temporaryUrl() }}" >
                            @endif
                        </div>

                        <div class="form-group">
                            <label
                                class="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">{{ __('messages.activity') }}</label>
                            <div class="checkbox-inline">
                                <label class="checkbox checkbox-solid">
                                    <input wire:model="status" type="checkbox" />
                                    <span></span>
                                    {{ __('messages.active') }}
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="button" wire:click.prevent="store()"
                            class="btn btn-primary mr-2" data-dismiss="modal">{{ __('messages.create') }}</button>
                        <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('messages.close') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
