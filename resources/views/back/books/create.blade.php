@extends('back.layouts.master')
@section('title', 'Kitap Ekle')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <form action="{{ route('books.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <div class="card-title">@yield('title')</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="kitap">Kitap ismi</label>
                                <input type="text" name="title" class="form-control" id="kitap"
                                    placeholder="Kitap ismi girin">
                            </div>
                            <div class="form-group">
                                <label for="page_count">Sayfa Sayısı</label>
                                <input type="number" name="page_count" class="form-control" id="page_count" max="1000"
                                    placeholder="Sayfa sayısı girin">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Resim Yükleyin</label>
                                <div>
                                    <input type="file" name="image" class="form-control-file"
                                        id="exampleFormControlFile1" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content">İçerik</label>
                                <textarea class="form-control" id="content" name="content" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="yazar">Yazar ismi</label>
                                <input type="text" name="author" class="form-control" id="yazar"
                                    placeholder="Yazar ismi girin">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Kategori Seçimi</label>
                                <select class="form-select" name="category_id" id="exampleFormControlSelect1">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price">Fiyat</label>
                                <input type="number" name="price" class="form-control" id="price"
                                    placeholder="Fiyat girin">
                            </div>
                            <div class="form-group">
                                <label for="brief">Kısa bilgi</label>
                                <textarea class="form-control" id="brief" name="brief" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="language">Dil</label>
                                <input type="text" name="language" class="form-control" id="language"
                                    placeholder="Dil girin">
                            </div>
                            <div class="form-group">
                                <label for="release_date">Yayınlanma Tarihi</label>
                                <input type="number" name="release_date" class="form-control" id="release_date"
                                    placeholder="Yayınlanma Tarihi Giriniz" max="2024">
                            </div>
                            <div class="form-group">
                                <label for="stock">Stok sayısı</label>
                                <input type="number" name="stock" class="form-control" id="stock"
                                    placeholder="Stok sayısı girin" max="100" min="1">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-action">
                    <button type="submit" class="btn btn-success">Gönder</button>
                </div>
            </form>
        </div>
    </div>
@endsection
