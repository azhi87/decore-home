
<div class="row hidden-print text-center">
    <div class="text-center btn-group col-md-12 col-sm-12">
        <a class="header-btn hidden-xs" href="/sales/addSale">
        <button type="button" class="btn btn-warning btn-fill btn-lg">زیادکردنی فرۆشتن
        </button></a>
    
        <a class="header-btn" href="/sale/seeSales"><button type="button" class="btn btn-info btn-fill btn-lg">بینینی فرۆشتنەکان
       </button> </a>
        @if(Auth::user()->type!="mandwb" && Auth::user()->type!="driver")
        <a class="header-btn" href="/sale/search"><button type="button" class="btn btn-danger btn-fill btn-magnify  btn-lg">گەڕانی فرۆشتن</button></a>
         @endif
    </div>
</div>

