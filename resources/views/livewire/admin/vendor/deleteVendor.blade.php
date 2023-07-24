<div wire:ignore.self class="modal fade" id="deleteVendor" tabindex="-1" role="dialog"
    aria-labelledby="deleteVendorTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteVendorTitle">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                are you sure you need to delete this Vendor ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" wire:click="delete()"
                    data-dismiss="modal">delete</button>

            </div>
        </div>
    </div>
</div>
