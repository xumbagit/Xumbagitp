        <div class="container">
            <div class="row">
                <div class="span10" >
                    <div class="btn-group">
                        <button class="btn" id="search" ><i class="icon-repeat"></i> Listar</button>
                        <input type="hidden" value="documentorev_grid.php" id="thispage" /> 
                        <button class="btn" id="limpiar" ><i class="icon-minus"></i>Limpiar</button>
                    </div>
                </div>
                <div class="span2" id="deldiv"></div>
            </div>
            <div class="row">&nbsp;</div>
            <div class="row"><div class="span12"><h4>Buscar Por</h4></div></div>
            <div class="row">&nbsp;</div>
            <div class="row">
                <div class="span1">
                    <p>Cédula</p>
                </div>
                <div class="span3">
                    <input type="text" class="filter" filter="nro_identificacion" placeholder="(Todos)" value="<?php echo($nro_identificacion); ?>"/>
                </div>
                <div class="span1">
                    <p>Correo</p>
                </div>
                <div class="span3">
                    <input type="text" class="filter" filter="correo" placeholder="(Todos)" value="<?php echo($correo); ?>"/>
                </div>
                <div class="span1">
                    <p>Tipo de Documento</p>
                </div>
                <div class="span3">
					<select name="filter" id="filter" class='filtersel'>
						<option value='null'>[Seleccione]</option>
						<option value='null'>(Todos)</option>
					    <option value='0'>Balance Individual</option>
					    <option value='1'>Balance Conyugal</option>
					    <option value='2'>Certificado de Ingresos</option>
					    <option value='3'>Subasta Online</option>
				    </select>
                </div>
            </div>
            <div class="row"><div class="span12"><h3>Listado</h3></div></div>
            <div class="row">
                <div class="span12">

                    <div>
                        <table class="table table-hover table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th style="width: 20px">&nbsp;</th>
                                    <th>Nro Documento</th>
                                    <th>Tipo</th>
                                    <th>Fecha</th>
                                    <th>Tracking</th>
                                    <th>Monto</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $currentpage = $nPagina;
                                if ($nro_identificacion != "" || $nro_identificacion != "$correo") {
                                    $query = "CALL mp_R_Documento_Doc_Acc14(";
                                    $query .= "nBMP_CodigoEst =" . $bmp_codigoest . ",";
                                    $query .= "nDoc_Tipo = " . $doc_tipo . ",";
                                    $query .= "snro_identificacion = " . ($nro_identificacion == ""?"null": "'".$nro_identificacion."'") . ",";
                                    $query .= "scorreo = " . ($correo == ""? "null": "'".$correo."'");
                                    $query .= ")";
                                    //echo $query;
                                    $grid_values = fnc_ejecutaQuery($query);
                                }
                                if ($grid_values != "")
                                    foreach ($grid_values as $line) {
                                        echo "<tr>";
                                        echo "  <td>";
                                        echo "      <button class='close deleteh deletem'>&times;</button>";
                                        echo "      <input type='hidden' value='documento_delete.php?usu_codigo=" . $line['Doc_Codigo'] . "' />";
                                        echo "  </td>";
                                        if ($line['Doc_Tipo'] == 3)
                                            echo "  <td><a href='documentocertdtll_grid.php?doc_codigo=" . $line['Doc_Codigo'] . "'>" . $line['Doc_NroControl'] . "</a></td>";
                                        else
                                            echo "  <td><a href='documentodtll_grid.php?doc_codigo=" . $line['Doc_Codigo'] . "'>" . $line['Doc_NroControl'] . "</a></td>";
                                        echo "  <td>" . utf8_encode($line['Doc_TipoNombre']) . "</td>";
                                        echo "  <td>" . date("d/m/Y", strtotime($line['Doc_PgFechaIns'])) . "</td>";
                                        echo "  <td>" . ($line['Doc_Track'] == null ? "-" : $line['Doc_Track']) . "</td>";
                                        echo "  <td>" . ($line['Doc_PgMonto'] == null ? "-" : $line['Doc_PgMonto']) . "</td>";
                                        //echo "  <td style='text-align:center'><a href='documentodtll_grid.php?doc_codigo=" . $line['Doc_Codigo'] . "'><i class='icon-eye-open'></i></a></td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
