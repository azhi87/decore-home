<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>

  <meta charset="UTF-8">
  <title>Print Page</title>

  <style>
@media print {

    .page-break { display: block; page-break-before: always; }
}
      #invoice-POS {
  box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
  padding: 2mm;
  margin: 0 auto;
  width: 80mm;
  background: #FFF;
}

/* http://meyerweb.com/eric/tools/css/reset/ 
   v2.0 | 20110126
   License: none (public domain)
*/

html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
    margin: 0;
    padding: ;
    border: 1;
    vertical-align: baseline;
}

body {
    line-height: 2;
}
ol, ul {
    list-style: none;
}
blockquote, q {
    quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
    content: '';
    content: none;
}
table {
    border-collapse: collapse;
    border-spacing: 0;
}
#invoice-POS ::selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS ::moz-selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS h1 {
  font-size: 1.5em;
  color: #222;
}
#invoice-POS h2 {
  font-size: .9em;
}
#invoice-POS h3 {
  font-size: 1.2em;
  font-weight: 300;
  line-height: 1.5em;
}


#invoice-POS p {
  font-size: 0.7em;
  color: #666;
  line-height: 1.2em;
}
#invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
  /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
}
#invoice-POS #top {
  min-height: 100px;
}
#invoice-POS #mid {
  min-height: 80px;
}
#invoice-POS #bot {
  min-height: 50px;
}
#invoice-POS #top .logo {
  height: 60px;
  width: 225px;
  background: url({{asset('/public/img/decorheader.jpg')}}) no-repeat;
  background-size: 225px 60px;
}
#invoice-POS .clientlogo {
  float: right;
  height: 60px;
  width: 225px;
  background: url{{asset('/public/img/decorheader.jpg')}}) no-repeat;
  background-size: 225px 60px;
  border-radius: 50px;
}
#invoice-POS .info {
  display: block;
  margin-right: 0;
}
#invoice-POS .title {
  float: right;
}
#invoice-POS .title p {
  text-align: right;
}
#invoice-POS table {
  width: 100%;
  border-collapse: collapse;
}
#invoice-POS .tabletitle {
  font-size: 1.2em;
  font-weight: 900;
  background: #EEE;
}
#invoice-POS .service {
  border-bottom: 1px solid #EEE !important;
}
#invoice-POS .item {
  width: 24mm;
}
#invoice-POS .itemtext {
  font-size: .9em;
}
#invoice-POS #legalcopy {
  margin-top: 5mm;
}

    </style>

  <script>
  window.console = window.console || function(t) {};
</script>



  <script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>


</head>

<body translate="no" >


  <div id="invoice-POS">

    <center id="top">
        <h1>   کۆمپانیای دیکۆر هۆم   </h1>
      <div class="info"> 
        <h1> وەسڵی پارەدانەوەی قیست   </h1>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->

    <div id="bot">

                    <div id="table" >
                        <table style="width:100%">

                            <tr class="tabletitle">
                                <td class="Rate"><h2>ژ.وەسڵ: &nbsp;{{$ins->sale->id}}</h2></td>
                                <td class="payment" colspan="2"><h2>بەروار: &nbsp;{{$ins->updated_at->format('d-m-yy')}}</h2> </td>
                            </tr>

                            <tr class="tabletitle">
                                <td class="Rate"><h2 >ناوی کڕیار: </h2></td>
                                <td class="payment" colspan="2"><h2>{{ $ins->customer->name ?? '' }} </h2></td>
                            </tr>    
                            
                            <tr class="tabletitle">
                                <td class="Rate"><h2>ناوی کارمەند: </h2></td>
                                <td class="payment"><h2>   {{$ins->user->name}} </h2></td>
                                <td class="payment"><h2> -&nbsp;&nbsp; {{$ins->sale->branch->name}} </h2></td>
                            </tr>

                            <tr class="tabletitle">
                                <td class="Rate"><h1>کۆی دراو</h1></td>
                                <td class="payment" colspan="2"><h1>  {{number_format($ins->calculatedPaid,2)}}  </h1></td>
                            </tr>

                            <tr class="tabletitle">
                                <td class="Rate"><h1> قیستی ماوە</h1>  </td>
                                <td class="payment" colspan="2"><h1> {{number_format($ins->sale->total-$ins->sale->actualPaid(),2)}} </h1></td>
                            </tr>

                            <tr class="tabletitle">
                                <td colspan="3" class="payment"><h6> {{$ins->description}}  </h6></td>
                            </tr>
                        </table>
                    </div><!--End Table-->

                    <div id="">
                        <p class="payment"><strong>سوپاس بۆ هەڵبژاردنی دیکۆر هۆم</strong>
                        </p>
                    </div>

                </div><!--End InvoiceBot-->
  </div><!--End Invoice-->
  


</body>
</html>
<script>
    function myFunction() {
        window.print();
    }
</script>
