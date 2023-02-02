<div class="c-bottomSheet" id="bottomSheet-{{ $count }}">
    <div class="c-bottomSheet__sheet">
        <div class="c-bottomSheet__dragArea" id="bottomSheetDrag-{{ $count }}">
            <div class="c-bottomSheet__bar"></div>
        </div>
        <div class="c-bottomSheet__heading"><b>Atur Stok</b></div>
        <div class="c-bottomSheet__content">
            <form method="post" action="/stocks/update/{{ $stock->id }}">
                @csrf
                <div class="c-bottomSheet__count"><b>{{ $stock->stock }}</b></div>
                <div class="c-bottomSheet__product">
                    Total Stok
                    <br /><br />
                    <b>{{ $stock->name }}</b>
                    <br />
                    @php
                        $get_size = ltrim($stock->size_id, '0');
                        $size = \DB::table('m_size')->where('id', $get_size)->first();
                    @endphp
                    SKU: {{ $stock->sku }} • Size: {{ $size->name }}
                </div>
                <div class="c-bottomSheet__centerline"></div>
                <div class="row c-bottomSheet__perbarui">Perbarui Stok</div>
                <div class="row mb-3">
                    <div class="col-1 c-bottomSheet__radio"><input class="form-check-input" type="radio" name="calstok" id="j1-{{ $count }}" value="Disesuaikan" onclick="radioHandler(this)"></div>
                    <div class="col-9 c-bottomSheet__textradio">Disesuaikan</div>
                </div> 
                <div class="row mb-3">
                    <div class="col-1 c-bottomSheet__radio"><input class="form-check-input" type="radio" name="calstok" id="j2-{{ $count }}" value="Ditambah" onclick="radioHandler(this)"></div>
                    <div class="col-9 c-bottomSheet__textradio">Ditambah</div>
                </div> 
                <div class="row mb-3">
                    <div class="col-1 c-bottomSheet__radio"><input class="form-check-input" type="radio" name="calstok" id="j3-{{ $count }}" value="Dikurang" onclick="radioHandler(this)"></div>
                    <div class="col-9 c-bottomSheet__textradio">Dikurang</div>
                </div>   
                <div class="row mb-3 c-bottomSheet__textjumlah" id="textsum">Jumlah Stok Disesuaikan</div>
                <div class="row mb-3 c-bottomSheet__inputstock">
                    <input type="number" min="0" name="inputstock" class="form-control" required/>
                </div>        
                <div class="row mb-2 c-bottomSheet__buttonsection">
                    <a href="{{request()->url()}}" class="btn btn-light c-bottomSheet__btncancel">Batal</a>
                    <button type="submit" class="btn btn-primary c-bottomSheet__btnsubmit" id="submitBtn-{{ $count }}" disabled>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function (){
    $('input[name=calstok]:radio').change(function () {
        switch ($('input[name=calstok]:checked').val()){
            case "Ditambah":
                $('[id$=textsum]').text('Jumlah Stok Ditambah');
                break;
            case "Dikurang":
                $('[id$=textsum]').text('Jumlah Stok Dikurang');
                break;
            default:
                $('[id$=textsum]').text('Jumlah Stok Disesuaikan');
        }
    });
});
</script>

