 @if(Auth::user()->type!='supervisor')
 <div class="sidebar hidden-print" data-background-color="brown" data-active-color="danger">
       
            <div class="logo">
            </div>
            <div class="sidebar-wrapper hidden-print">
                
                <ul class="nav">
                    <li class="active">
                        <a href="/">
                         <i class="ti-panel"></i>
                            <p>سەرەکی</p>
                        </a>
                    </li>
                    @if( Auth::user()->type=='admin' || Auth::user()->type=='accountant')
                    <li>
                        <a data-toggle="collapse" href="#formsExamples">
                            <i class="fa fa-shopping-cart"></i>
                            <p class="h4">
                                فرۆشتن
                               <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="formsExamples">
                            <ul class="nav">
                                <li>
                                    <a href="/sales/addSale">
                                        <span class="sidebar-mini">١</span>
                                        <span class="sidebar-normal">زیادکردنی فرۆشتن</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/sale/seeSales">
                                        <span class="sidebar-mini">٢</span>
                                        <span class="sidebar-normal">بینینی فرۆشتنەکان</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/sale/search">
                                        <span class="sidebar-mini">٣</span>
                                        <span class="sidebar-normal">گەڕانی فرۆشتنەکان</span>
                                    </a>
                                </li>
                           
                                <li>
                                    <a href="/installments">
                                        <span class="sidebar-mini">٤</span>
                                        <span class="sidebar-normal">بەشی قیست</span>
                                    </a>
                                </li>
                                
                                 <li>
                                    <a href="/xwastns">
                                        <span class="sidebar-mini">٢</span>
                                        <span class="sidebar-normal">خواستن</span>
                                    </a>
                                </li>

                                     <li>
                                    <a href="/customers">
                                        <span class="sidebar-mini">٥</span>
                                        <span class="sidebar-normal">لیستی کڕیارەکان</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif
                    @if(Auth::user()->type=="admin")
                    <li>
                        <a data-toggle="collapse" href="#componentsExamples">
                            <i class="fa fa-truck"></i>
                            <p>کڕین
                               <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="componentsExamples">
                            <ul class="nav">
                                <li>
                                    <a href="/purchase/see">
                                        <span class="sidebar-mini">١</span>
                                        <span class="sidebar-normal">بینینی کڕینەکان</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/purchases/add">
                                        <span class="sidebar-mini">٢</span>
                                        <span class="sidebar-normal">زیادکردنی کڕین</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/purchase/search">
                                        <span class="sidebar-mini">٣</span>
                                        <span class="sidebar-normal">گەڕانی کڕینەکان</span>
                                    </a>
                                </li>
                                 <li>
                                    <a href="/suppliers">
                                        <span class="sidebar-mini">٤</span>
                                        <span class="sidebar-normal">زیادکردنی کۆمپانیا</span>
                                    </a>
                                </li>
                               
                            </ul>
                        </div>
                    </li>

                    
                    @endif
                    
                    
                    
                    
                    @if(Auth::user()->type=='accountant' || Auth::user()->type=='admin')

                    <li>
                        <a href="/reports">
                        <i class="fa fa-bar-chart"></i>                            
                        <p>بەشی ڕاپۆرت</p>
                        </a>
                    </li>
                    
                    
                   <li>
                        <a href="/expenses">
                            <i class="fa fa-bank"></i>
                            <p>بەشی مەصروفات</p>
                        </a>
                    </li>

                    @endif

                    @if(Auth::user()->type=='maxzan' || Auth::user()->type=='admin' )
                    <li>
                        <a data-toggle="collapse" href="#extras">
                            <i class="fa fa-plus"></i>
                            <p class="h4">
                                زیاتر
                               <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="extras">
                            <ul class="nav">
                                <li>
                                    <a href="/items/add">
                                        <span class="sidebar-mini">١</span>
                                        <span class="sidebar-normal">ناساندنی کاڵا</span>
                                    </a>
                                </li>
                                
                                
                                @if(Auth::user()->type=='admin')
                                <li>
                                    <a href="/paybacks">
                                        <span class="sidebar-mini">٣</span>
                                        <span class="sidebar-normal">گەڕانەوەی پارە</span>
                                    </a>
                                </li>
                                
                                      <li>
                                    <a href="/transfers">
                                        <span class="sidebar-mini">٤</span>
                                        <span class="sidebar-normal">حساباتی کۆمپانیاکان</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/users">
                                    <span class="sidebar-mini">٥</span>
                                    <p>بەشی بەکارهێنەرەکان</p>
                                    </a>
                                </li>
                                @endif
                        
                                
                            </ul>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
</div>
   @endif
        <div class="main-panel">
            <nav class="navbar navbar-default" style="background-color: #f3bb45;">
                <div class="container-fluid">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-fill btn-icon"><i class="ti-more-alt"></i></button>
                    </div>
                    <div class="navbar-header text-center" style="margin-left:35%;margin-top:-5px;">
                        <button type="button" class="navbar-toggle">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar bar1"></span>
                            <span class="icon-bar bar2"></span>
                            <span class="icon-bar bar3"></span>
                        </button>
                        <a class="navbar-brand text-center" href="/">
                           <span class="h4"> Decor Home Mobilya </span>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="/logout" class="btn-rotate">
                                    <i class="fa fa-2x fa-power-off h6" title="دەرچوون" aria-hidden="true"></i>
                                    <p class="hidden-md hidden-lg">
                                        Settings
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
         
