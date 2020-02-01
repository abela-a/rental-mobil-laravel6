<select name="kode_tipe" class="form-control @error('kode_tipe') is-invalid @enderror">
  <option selected disabled>Pilih Tipe</option>
  @foreach ($tipe as $t)
  <option value="{{ $t->kode_tipe }}">{{ $t->nama_tipe }}</option>
  @endforeach
</select>