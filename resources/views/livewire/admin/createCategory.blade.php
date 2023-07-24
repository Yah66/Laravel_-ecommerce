 {{-- <div wire:ignore.self id="category_form" class="modal fade " role="dialog" aria-hidden="false" wire:model="showModal">
     <div class="card card-custom gutter-b example example-compact  "style="width: 50%;">
         <div class="card-header">
             <h3 class="card-title">Add Category</h3>
             <div class="card-toolbar">
                 <div class="example-tools justify-content-center">
                     <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                     <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                 </div>
             </div>
         </div>
         <!--begin::Form-->
         <div>
             {{-- @if (session()->has('success'))
                 <div class="alert alert-success">{{ session('success') }}</div>
             @endif --}}
 {{-- <form enctype="multipart/form-data">
                 <div class="card-body">
                     <div class="form-group">
                         <label>Name</label>
                         <input type="text" wire:model.defer="name" class="form-control form-control-solid"
                             placeholder="Enter name" />
                         @error('name')
                             <span class="error">{{ $message }}</span>
                         @enderror
                     </div>

                     <div class="form-group">
                         <label>Image</label>
                         <input type="file" wire:model.defer="image" class="form-control-file" />
                         @error('image')
                             <span class="error">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>Description</label>
                         <textarea wire:model.defer="description" class="form-control form-control-solid" rows="3"></textarea>
                         @error('description')
                             <span class="error">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>Meta Title</label>
                         <input type="text" wire:model.defer="meta_title" class="form-control form-control-solid"
                             placeholder="Enter meta title" />
                         @error('meta_title')
                             <span class="error">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>Meta Keywords</label>
                         <input type="text" wire:model.defer="meta_keywords" class="form-control form-control-solid"
                             placeholder="Enter meta keywords" />
                         @error('meta_keywords')
                             <span class="error">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>Meta Description</label>
                         <textarea wire:model.defer="meta_description" class="form-control form-control-solid" rows="3"></textarea>
                         @error('meta_description')
                             <span class="error">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>Status</label>
                         <div class="checkbox-inline">
                             <label class="checkbox checkbox-solid">
                                 <input type="checkbox" wire:model.defer="status" />
                                 <span></span>
                                 Active
                             </label>
                         </div>
                         @error('status')
                             <span class="error">{{ $message }}</span>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>Popular</label>
                         <div class="checkbox-inline">
                             <label class="checkbox checkbox-solid">
                                 <input type="checkbox" wire:model.defer="popular" />
                                 <span></span>
                                 Yes
                             </label>
                         </div>
                         @error('popular')
                             <span class="error">{{ $message }}</span>
                         @enderror
                     </div>
                 </div>
                 <div class="card-footer">
                     <button type="button" wire:click.prevent="store()" class="btn btn-primary mr-2"
                         data-dismiss="modal">Submit</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 </div>
             </form>

         </div>
         <!--end::Form-->
     </div>
 </div>

 @push('scripts')
     <script>
         $('#category_form').on('hidden.bs.modal', function() {
             Livewire.emit('hideModal');
         });
     </script>
 @endpush --}}

     <div wire:ignore.self id="category_update" class="modal fade" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-xl">
             <div class="modal-content" style="min-height: 400px;">
                 <div class="modal-header py-5">
                     <h5 class="modal-title">Category Form
                     </h5>
                     <button type="button" wire:click.prevent="cancle()" class="close" data-dismiss="modal" aria-label="Close">
                         <i aria-hidden="true" class="ki ki-close"></i>
                     </button>
                 </div>
                 <div>

                     <form enctype="multipart/form-data">
                         <div class="card-body">
                             <div class="form-group">
                                 <label>Name</label>
                                 <input type="text" wire:model.defer="name"
                                     class="form-control form-control-solid" placeholder="Enter name" />
                                 @error('name')
                                     <span class="error text-danger">{{ $message }}</span>
                                 @enderror
                             </div>

                             <div class="form-group">
                                 @if ($this->image)
                                     <img src="{{ 'storage/category/images/' . $this->image }}" width="100"
                                         height="100" alt="">
                                 @endif
                                 <label>Image</label>
                                 <input type="file" wire:model.defer="image" class="form-control-file" />
                                 @error('image')
                                     <span class="error text-danger">{{ $message }}</span>
                                 @enderror
                             </div>

                             <div class="form-group">
                                 <label>Description</label>
                                 <textarea wire:model.defer="description" class="form-control form-control-solid" rows="3"></textarea>
                                 @error('description')
                                     <span class="error text-danger">{{ $message }}</span>
                                 @enderror
                             </div>

                             <div class="form-group">
                                 <label>Meta Title</label>
                                 <input type="text" wire:model.defer="meta_title"
                                     class="form-control form-control-solid" placeholder="Enter meta title" />
                                 @error('meta_title')
                                     <span class="error text-danger">{{ $message }}</span>
                                 @enderror
                             </div>

                             <div class="form-group">
                                 <label>Meta Keywords</label>
                                 <input type="text" wire:model.defer="meta_keywords"
                                     class="form-control form-control-solid" placeholder="Enter meta keywords" />
                                 @error('meta_keywords')
                                     <span class="error text-danger">{{ $message }}</span>
                                 @enderror
                             </div>

                             <div class="form-group">
                                 <label>Meta Description</label>
                                 <textarea wire:model.defer="meta_description" class="form-control form-control-solid" rows="3"></textarea>
                                 @error('meta_description')
                                     <span class="error">{{ $message }}</span>
                                 @enderror
                             </div>

                             <div class="form-group">
                                 <label>Status</label>
                                 <div class="checkbox-inline">
                                     <label class="checkbox checkbox-solid">
                                         <input type="checkbox" wire:model.defer="status" />
                                         <span></span>
                                         Active
                                     </label>
                                 </div>
                                 @error('status')
                                     <span class="error">{{ $message }}</span>
                                 @enderror
                             </div>

                             <div class="form-group">
                                 <label>Popular</label>
                                 <div class="checkbox-inline">
                                     <label class="checkbox checkbox-solid">
                                         <input type="checkbox" wire:model.defer="popular" />
                                         <span></span>
                                         Yes
                                     </label>
                                 </div>
                                 @error('popular')
                                     <span class="error">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>

                         <div class="card-footer">
                             <button type="button" wire:click.prevent="update()" class="btn btn-primary mr-2"
                                 data-dismiss="modal">Update</button>
                             <button type="button" class="btn btn-secondary" wire:click="resetForm"
                                 data-dismiss="modal">Close</button>
                         </div>
                     </form>

                 </div>
             </div>
         </div>
     </div>









 <div wire:ignore.self id="category_form" class="modal fade" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-xl">
         <div class="modal-content" style="min-height: 400px;">
             <div class="modal-header py-5">
                 <h5 class="modal-title">Category Form
                     <span class="d-block text-muted font-size-sm">Add Category</span>
                 </h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <i aria-hidden="true" class="ki ki-close"></i>
                 </button>
             </div>
             <div>
                 {{-- @if (session()->has('success'))
                 <div class="alert alert-success">{{ session('success') }}</div>
             @endif --}}
                 <form enctype="multipart/form-data">
                     <div class="card-body">
                         <div class="form-group">
                             <label>Name</label>
                             <input type="text" wire:model.defer="name" class="form-control form-control-solid"
                                 placeholder="Enter name" />
                             @error('name')
                                 <span class="error text-danger">{{ $message }}</span>
                             @enderror
                         </div>

                         <div class="form-group">
                             <label>Image</label>
                             <input type="file" wire:model.defer="image" class="form-control-file" />
                             @error('image')
                                 <span class="error text-danger">{{ $message }}</span>
                             @enderror
                         </div>
                         <div class="form-group">
                             <label>Description</label>
                             <textarea wire:model.defer="description" class="form-control form-control-solid" rows="3"></textarea>
                             @error('description')
                                 <span class="error text-danger">{{ $message }}</span>
                             @enderror
                         </div>
                         <div class="form-group">
                             <label>Meta Title</label>
                             <input type="text" wire:model.defer="meta_title"
                                 class="form-control form-control-solid" placeholder="Enter meta title" />
                             @error('meta_title')
                                 <span class="error text-danger">{{ $message }}</span>
                             @enderror
                         </div>
                         <div class="form-group">
                             <label>Meta Keywords</label>
                             <input type="text" wire:model.defer="meta_keywords"
                                 class="form-control form-control-solid" placeholder="Enter meta keywords" />
                             @error('meta_keywords')
                                 <span class="error text-danger">{{ $message }}</span>
                             @enderror
                         </div>
                         <div class="form-group">
                             <label>Meta Description</label>
                             <textarea wire:model.defer="meta_description" class="form-control form-control-solid" rows="3"></textarea>
                             @error('meta_description')
                                 <span class="error text-danger">{{ $message }}</span>
                             @enderror
                         </div>
                         <div class="form-group">
                             <label>Status</label>
                             <div class="checkbox-inline">
                                 <label class="checkbox checkbox-solid">
                                     <input type="checkbox" wire:model.defer="status" />
                                     <span></span>
                                     Active
                                 </label>
                             </div>
                             @error('status')
                                 <span class="error text-danger">{{ $message }}</span>
                             @enderror
                         </div>
                         <div class="form-group">
                             <label>Popular</label>
                             <div class="checkbox-inline">
                                 <label class="checkbox checkbox-solid">
                                     <input type="checkbox" wire:model.defer="popular" />
                                     <span></span>
                                     Yes
                                 </label>
                             </div>
                             @error('popular')
                                 <span class="error text-danger">{{ $message }}</span>
                             @enderror
                         </div>
                     </div>
                     <div class="card-footer">
                         <button type="button" wire:click.prevent="store()" class="btn btn-primary mr-2"
                             data-dismiss="modal">Submit</button>
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     </div>
                 </form>

             </div>
         </div>
     </div>
 </div>
