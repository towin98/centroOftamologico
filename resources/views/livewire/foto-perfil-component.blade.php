<div>
    <div class="content-wrapper shadow-lg p-3 mb-5 bg-white rounded d-flex flex-column justify-content-between" style="height: 500px;">
        
       <div class="d-flex justify-content-center">
            <div class="form-group">
                <label for="photo">Subir foto
                    <span class="text-danger">*</span>
                </label>
                <input type="file" class="form-control pl-5" id="photo" wire:model="photo" required>
                
                <div wire:loading wire:target="photo" class="text-danger bg-warning w-100 h4">Cargando...</div>
                
                @error('photo')
                    <span>{{ $message }} </span>
                @enderror
            </div>
       </div>
        
       <div class="d-flex">
            @if ($photo)
                <img src="{{ $photo->temporaryUrl() }}" class=" rounded-circle mx-auto d-block"
                style="width: 19.6rem; height: 19.6rem;">
            @endif
       </div>

       
       <div class="d-flex justify-content-end ">
            <button wire:click="store" class="btn btn-primary mr-3">Guardar datos</button>
            <button wire:click="atras" class="btn btn-dark ">Atras</button>
       </div>
       
       
    </div>
</div>