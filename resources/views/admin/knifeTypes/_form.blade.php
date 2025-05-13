<form method="POST"
      action="{{ isset($knifeType) ? route('knife-types.update', $knifeType) : route('knife-types.store') }}"
      accept-charset="UTF-8"
      class="form-horizontal">

    @csrf
    @if(isset($knifeType))
        @method('PUT')
    @endif

    <div class="form-group mt-3">
        <label for="name">Название типа ножа</label>
        <input type="text"
               name="name"
               id="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $knifeType->name ?? '') }}">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary">
            {{ isset($knifeType) ? 'Обновить' : 'Создать' }}
        </button>
    </div>
</form>
