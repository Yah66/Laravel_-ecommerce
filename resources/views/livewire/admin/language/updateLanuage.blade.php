<div wire:ignore.self id="lang_update" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="min-height: 400px;">
            <div class="modal-header py-5">
                <h5 class="modal-title">Update Language
                    <span class="d-block text-muted font-size-sm">Update Language</span>
                </h5>
                <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form wire:submit.prevent="update" enctype="multipart/form-data">
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
                        <label>Abbreviation</label>
                        <input wire:model="abbr" type="text" class="form-control form-control-solid"
                            placeholder="Enter abbreviation" />
                        @error('abbr')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Locale</label>
                        <input wire:model="locale" type="text" class="form-control form-control-solid"
                            placeholder="Enter locale" />
                        @error('locale')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Active</label>
                        <div class="checkbox-inline">
                            <label class="checkbox checkbox-solid">
                                <input wire:model="active" type="checkbox" />
                                <span></span>
                                Active
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Direction</label>
                        <select wire:model="dir" class="form-control form-control-solid">
                            <option value="rtl">Right-to-Left (RTL)</option>
                            <option value="ltr">Left-to-Right (LTR)</option>
                        </select>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="button" wire:click.prevent="update()" class="btn btn-primary mr-2">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
