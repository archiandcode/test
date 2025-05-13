<form method="POST"
      action="{{ isset($knife) ? route('knives.update', $knife) : route('knives.store') }}"
      accept-charset="UTF-8"
      class="form-horizontal"
      enctype="multipart/form-data">

    @csrf
    @if(isset($knife))
        @method('PUT')
    @endif

    <div class="form-group mt-3">
        <label for="name">Название ножа</label>
        <input type="text"
               name="name"
               id="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $knife->name ?? '') }}">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mt-3">
        <label for="knife_type_id">Тип ножа</label>
        <select name="knife_type_id"
                id="knife_type_id"
                class="form-control @error('knife_type_id') is-invalid @enderror">
            <option value="">Выберите тип</option>
            @foreach($types as $type)
                <option value="{{ $type->id }}"
                    {{ (old('knife_type_id', $knife->knife_type_id ?? '') == $type->id) ? 'selected' : '' }}>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>
        @error('knife_type_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mt-3">
        <label for="image">Изображение</label>
        <input type="file"
               name="image"
               id="image"
               class="form-control-file @error('image') is-invalid @enderror">
        @error('image')
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror

        @if(isset($knife) && $knife->image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $knife->image) }}"
                     alt="Текущее изображение"
                     style="max-height: 120px;">
            </div>
        @endif
    </div>

    <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary">
            {{ isset($knife) ? 'Обновить' : 'Создать' }}
        </button>
    </div>
</form>
