@extends('layouts.app')

@section('title')
Admin | Deskripsi Entry
@endsection

@section('content')
<h3>Input Deskripsi</h3>
<div class="form-login">
  <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="penitip">Nama Penitip</label>
    <input class="input" type="text" name="penitip" id="penitip" placeholder="Nama Penitip" value="{{ old('penitip') }}" required />
    @error('penitip')
    <p style="font-size: 10px; color: red">{{ $message }}</p>
    @enderror

    <label for="totalHarga">Total Harga</label>
    <input class="input" type="text" name="totalHarga" id="totalHarga" placeholder="Total Harga" value="{{ old('totalHarga') }}" required />
    @error('totalHarga')
    <p style="font-size: 10px; color: red">{{ $message }}</p>
    @enderror

    <label for="categories">Kategori</label>
    <input class="input" type="text" name="categories" id="categories" placeholder="Kategori" value="{{ old('categories') }}" required />
    @error('categories')
    <p style="font-size: 10px; color: red">{{ $message }}</p>
    @enderror

    <label for="keterangan">Keterangan</label>
    <input class="input" type="text" name="keterangan" id="keterangan" placeholder="Keterangan" value="{{ old('keterangan') }}" required />
    @error('keterangan')
    <p style="font-size: 10px; color: red">{{ $message }}</p>
    @enderror

    <label for="photo">Foto</label>
    <input type="file" name="gambar" id="photo" />
    @error('photo')
    <p style="font-size: 10px; color: red">{{ $message }}</p>
    @enderror

    <button type="submit" class="btn btn-simpan" name="simpan" style="margin-top: 50px">
      Simpan
    </button>
  </form>
</div>
@endsection
