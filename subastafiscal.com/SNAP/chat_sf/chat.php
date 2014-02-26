<div id="contenedorchat">
  <div id="contenedorsinheight">
    <div id="botonchat"><a href="#"><span class="chataseso">Asesoría<br />Online</span></a></div>
    <div id="contenedorchatabajo" style="display:none">
      <div id="inputdearribag">Seleccione el tipo de Asesoría que necesite:
        <br />
        <div id="tipo_asesoria_div">
          <select id='tipo_asesoria' name='tipo_asesoria' class='seleccionchat'>
            <option value='0' selected>[Seleccionar]</option>
            <?php require_once('lib/functions.php'); getAsesorias(); ?>
          </select>
        </div>
        <input id="button_asesoria" type="button" value="aceptar" class="botoninputchat" />
      </div>
    </div>
  </div>
</div>
