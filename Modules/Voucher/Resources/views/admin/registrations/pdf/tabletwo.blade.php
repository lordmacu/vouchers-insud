<style>
   table {
   border-collapse: collapse;
   border-spacing: 0;
   }
   td {
   padding:0px;
   }
   table {
   border-collapse: collapse;
   }
   table td, table th {
   border: 1px solid black;
   }
   table tr:first-child th {
   border-top: 0;
   }
   table tr:last-child td {
   border-bottom: 0;
   }
   table tr td:first-child,
   table tr th:first-child {
   border-left: 0;
   }
   table tr td:last-child,
   table tr th:last-child {
   border-right: 0;
   }
   .sinborder{
   border: 0px
   }
   .sin_padding{
   padding: 0px
   }
   .top_border{
   border-top: 1px solid #000000;
   border-bottom:0px;
   border-left:0px;
   border-right: :0px;
   }

   .border_top_bottom{
   border-bottom: 0px;
   border-top:0px;
   border-left:1px solid #000000;
   border-right: 1px solid #000000;
   }

   td{
   padding: 5px
   }
   .center_text{
   	text-align: center;
   }
   .logo_background{

 		background-repeat: no-repeat;
 
		background-image: url({{url('logo.jpg')}});
		
   }
   .logo_background span{
   		font-size: 25px;
   		font-weight: bold;
   }
   .sin_border_bottom{
   		border-bottom: 0px;
   		border-top:1px solid #000000;
   		border-left:1px solid #000000;
   		border-right: 1px solid #000000;
   }
  .sin_border_top{
  	border:0px; 	
   		border-top: 0px;
   		border-bottom:1px solid #000000;
   		border-left:1px solid #000000;
   		border-right: 1px solid #000000;
   }
   body{
   	font-size: 13px
   }

   .result_rows td{
   		height: 30px
   }
</style>
<p class="center_text" style="font-weight: bold;font-size: 17px">CAPITAL INTELECTUAL S.A.</p>
<table id="tablaimprimir"  class="sin_border_bottom" border="1" style=" width: 100%">
    
  
   <tr>
     <td >TITULO DEL PROYECTO: {{$encabezado["proyecto"]}}</td>
      <td class="sin_padding" width="160px">
         <table style=" width: 100%">
            <tr class="sinborder">
               <td>FECHA</td>
               <td>{{$encabezado["fecha"]}}</td>
            </tr>
         </table>
      </td>
   </tr>
   <tr>
       
      <td  >
        RENDIDO POR  {{$encabezado["nombre_usuario"]}}
      </td>
      <td class="sin_padding" width="200px">
         <table  style=" width: 100%;"  >
            <tr class="sinborder" >
               <td  >AREA</td>
               <td  >{{$encabezado["area"]}}</td>
            </tr>
            <tr class="top_border ">
               <td>RUBRO:</td>
               <td style="text-align: center;">{{$rubro}}</td>
            </tr>
         </table>
      </td>
   </tr>
   <tr>
       
   </tr>
   
</table>

<p class="center_text" style="font-weight: bold;">RENDICIÓN DE FONDOS POR RUBRO</p>

<table style=" width: 100%; margin-top: 10px"  >
	<tr >
		<td class="center_text"  width="100px"  style="font-weight: bold;"> 
		 NRO RUBRO
		</td>
		<td class="center_text"   style="font-weight: bold;">
		 PROVEEDOR + TIPO FACTURA + Nª FACTURA + ITEM
		</td>
		<td class="center_text" width="160px"  style="font-weight: bold;">
         TOTAL
      </td>
   </tr>

   @foreach($items as $item)
   <tr class="result_rows">
   	<td></td>	<td class="center_text">{{$item["desc"]}}</td>	<td class="center_text">${{$item["total"]}}</td>
   </tr>

   @endforeach
    <tr class="result_rows">
        <td colspan="2"  style="text-align: left; font-weight: bold;"> TOTALES </td>  <td class="center_text">${{$valortotal}}</td>
   </tr>
</table>

<table style=" width: 100%; margin-top: 30px" >
   <tr>
      <td  width="120px" height="50px" class="center_text">
         Firma
      </td>
      <td>
      </td>
   </tr>
   <tr>
      <td  width="120px" height="50px" class="center_text">
         Aclaración
      </td>
      <td>
      </td>
   </tr>
</table>