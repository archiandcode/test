<form method="POST"
      action="{{ isset($listing) ? route('listings.update', $listing) : route('listings.store') }}"
      accept-charset="UTF-8"
      class="form-horizontal">

    @csrf
    @if(isset($listing))
        @method('PUT')
    @endif

    @if(!isset($listing))
        <div class="form-group mt-3">
            <label for="knife_id">Нож</label>
            <select name="knife_id" id="knife_id"
                    class="form-control select2 @error('knife_id') is-invalid @enderror">
                <option value="">— Выберите нож —</option>
                @foreach($knives as $typeId => $knifeGroup)
                    @foreach($knifeGroup as $knife)
                        <option value="{{ $knife->id }}"
                            {{ old('knife_id') == $knife->id ? 'selected' : '' }}>
                            {{ $knifeGroup->first()->knifeType->name . ' ' . $knife->name }}
                        </option>
                    @endforeach
                @endforeach
            </select>
            @error('knife_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    @endif

    <div class="form-group mt-3">
        <label for="price">Цена (₸)</label>
        <input type="number"
               name="price"
               id="price"
               step="0.01"
               class="form-control @error('price') is-invalid @enderror"
               value="{{ old('price', $listing->price ?? '') }}">
        @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary">
            {{ isset($listing) ? 'Обновить' : 'Создать' }}
        </button>
    </div>
</form>
