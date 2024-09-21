@if ($book->stock == 0)
    <span class="badge badge-danger">Stokta kitap kalmamış.</span>
@elseif($book->stock <= 3)
    <span class="badge badge-warning">Stokta ki son kitaplar!</span>
@else
    <span class="badge badge-success">Mevcut</span>
@endif
