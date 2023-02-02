<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Kasual Stock</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="icon" type="image/png" href="{{ url('faviconkasual.png') }}"/>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ url('assets/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/scss/index.css') }}">

        <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>


    </head>
    <body class="content-body">
            <section class="l-section-3 c-stock">
                <div class="c-stock__logout"></div>
                <div class="c-stock__top">
                    <img class="c-stock__logo" loading="lazy" src="https://kasual.id/wp-content/uploads/2019/10/logo-baru.png"
                        alt="Kasual Logo">
                    <a href="/logout"><i class="fa fa-sign-out  mr-2"></i>Logout</a>
                </div>
                <div class="c-stock__searchline">
                    <form>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <button class="btn btn-sm _btn-primary bg-white border c-stock__fasearch" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                            </div>
                            <input type="text" class="form-control form-control-sm border c-stock__search" name="search" value="{{ request()->search ?? ''  }}" placeholder="Cari Nama Produk">
                        </div>
                    </form>
                </div>

                <div class="c-stock__content">
                    <div class="c-stock__title">
                        <p>Daftar Rincian Persediaan Produk Kasual</p>
                    </div>

                    @php
                        $count = 1;
                    @endphp

                    @foreach($stocks as $stock)
                        <a class="c-stock__list" value="{{$count}}" id="managelink{{$count}}" href="#">
                            <div class="c-stock__detailprod">
                                <div class="c-stock__itemsum">
                                    <p>
                                        <b>{{ $stock->stock }}</b>
                                        <br />
                                        Total Stok
                                    </p>
                                </div>
                            </div>

                            <div class="c-stock__itemdetail">
                                <div class="c-stock__productlnk">
                                    <p>
                                        <b>{{ $stock->name }}</b><br />
                                        SKU: {{ $stock->sku }}<br />
                                        Size: 
                                        @php
                                            $get_size = ltrim($stock->size_id, '0');
                                            $size = \DB::table('m_size')->where('id', $get_size)->first();
                                        @endphp
                                        {{ $size->name }}<br />
                                    </p>
                                </div>
                            </div>
                        </a>
                        @include('content.bottom-sheet')
                        @php
                            $count++;
                        @endphp
                    @endforeach                    
                </div>
            </section>
            @include('content.notification')

        @section('custom_js')
        <script>
            $(document).ready(function() {
                for(var i = 1; i <{{$count}}; i++){
                    $('#managelink' + i).click(function(e){
                        $('#bottomSheet-' + $(this).attr("value")).addClass('-active');
                    });
                }
						
				$('.c-bottomSheet').on('mousedown',function(e){
                    var target = $(e.target);
                    var getid = target.attr("id");
                    var getvar = getid.split("-");
                    if(e.target == $('#bottomSheet-' + getvar[1]).get(0) || e.target == $('#bottomSheetDrag-' + getvar[1]).get(0)){
                        $('#bottomSheet-' + getvar[1]).removeClass('-active');
                    }
                });

                radioHandler = (e)=>{
                    var tb = $(e);
                    var idbtn = tb.attr("id");
                    var getbtn = idbtn.split("-");
                    if($(e).prop("checked")){
                        $("#submitBtn-" + getbtn[1]).removeAttr('disabled');
                    }
                }
            });  

            $('.c-alert').on('mousedown',function(e){
                if(e.target == $('.c-alert').get(0)){
                    $('.c-alert').removeClass('-active');
                }
            });
            
        </script>
    </body>
</html>