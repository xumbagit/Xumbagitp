<div class="tablabalance">
  <div id="pestanabalancetarifas">Tarifas de Balance al d&iacute;a<span id="siniva"> (sin iva)</span></div> 
  <div id="bordertabla">
    <table width="300" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
      <tr class="fila_blanca_balance">
        <td colspan="2" width="300"><span class="valores_fiscalcentrado">Balance Personal</span></td>
        <span class="lineabalance3"></span>
      </tr>
      <tr class="fila_blanca_balance">
        <td width="230"><span class="valores_fiscal">Descripci&oacute;n</span></td>
        <td width="70"><span class="valores_precio">Precio Bs.F</span></td>
      </tr>
      <? getTarifas(1); ?>
      <tr class="fila_blancabalance">
        <span class="lineabalance5"></span>
        <td colspan="2" width="300"><span class="valores_fiscalcentrado">Balance Conyugal</span></td>
        <span class="lineabalance"></span>
      </tr>
      <tr class="fila_blancabalance">
        <td width="230"><span class="valores_fiscal">Descripci&oacute;n</span></td>
        <td width="70"><span class="valores_precio">Precio Bs. F</span></td>
      </tr>
      <? getTarifas(2); ?>
      <tr class="fila_grisbalance">
        <td><span class="casillasbalanceuna">40% adicional al costo correspondiente</span></td>
        <td><span class="preciobalance"></span></td>
      </tr>
      <tr class="fila_blancabalance">
        <td colspan="2" width="300"><span class="valores_fiscalcentrado">Certificaci&oacute;n de Ingreso</span></td>
        <span class="lineabalance2"></span>
      </tr>
      <tr class="fila_blancabalance">
        <td width="230"><span class="valores_fiscal">Descripci&oacute;n</span></td>
        <td width="70"><span class="valores_precio">Precio Bs. F</span></td>
      </tr>
      <? getTarifas(3); ?>
    </table>
  </div>
</div>