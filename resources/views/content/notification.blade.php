@if ($message = Session::get('sukses'))
<div class="c-alert -active">
    <div class="c-alert__popup">
        {{ $message }}
    </div>
</div>
@endif

@if ($message = Session::get('gagal'))
<div class="c-alert -active">
    <div class="c-alert__popup">
        {{ $message }}
    </div>
</div>
@endif