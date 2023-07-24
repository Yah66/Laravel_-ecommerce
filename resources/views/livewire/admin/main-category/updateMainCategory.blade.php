<div wire:ignore.self id="updateCategory" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="min-height: 400px;">
            <div class="modal-header py-5">
                <h5 class="modal-title">Update Category
                    <span class="d-block text-muted font-size-sm">Update Category</span>
                </h5>
                <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form wire:submit.prevent="update" enctype="multipart/form-data">
                <div class="card-body">
                    <input wire:model="nameArBeforeUpdate" type="text" class="form-control form-control-solid"
                        placeholder="{{ __('messages.enter_arabic_name') }}" lang="ar" />

                    <input wire:model="nameEnBeforeUpdate" type="text" class="form-control form-control-solid"
                        placeholder="{{ __('messages.enter_english_name') }}" lang="en" />
                    <div class="form-group">
                        <label>{{ __('messages.photo') }}</label>
                        <input wire:model="photo" type="file" class="form-control form-control-solid"
                            placeholder="{{ __('messages.enter_photo') }}" />
                        @error('photo')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror

                        {{-- @if ($photo)
                            Photo Preview:
                            <img src="{{ $photo->temporaryUrl() }}" alt="Photo Preview">
                        @endif --}}
                    </div>
                    <div class="form-group">
                        <label>{{ __('messages.activity') }}</label>
                        <div class="checkbox-inline">
                            <label class="checkbox checkbox-solid">
                                <input wire:model="active" type="checkbox" />
                                <span></span>
                                {{ __('messages.active') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" wire:click.prevent="update()" class="btn btn-primary mr-2"
                        data-dismiss="modal">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>
