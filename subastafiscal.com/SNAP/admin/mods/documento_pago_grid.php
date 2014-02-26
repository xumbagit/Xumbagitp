        <div class="container">
            <div class="row">
                <div class="span1 offset10">
                    <div class="btn-group">
                        <button class="btn btn-primary" type="button" id="validate_pagogrid">Validar</button>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="span12" style="min-height: 600px;">
                    <h3>Listado</h3>
                    <div>
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 20px; text-align: center"><input type='checkbox' id='selectall' /></th>
                                    <th>Nro Documento</th>
                                    <th>Tipo</th>
                                    <?php
                                    if($_GET['tipo']=="SUBASTA"){
                                    	?>
                                    		<th>Auditoria</th>
                                    	<?php
                                    }
                                    ?>
                                    <th>Fecha</th>
                                    <th>Tracking</th>
                                    <th>Soporte</th>
                                    <th>Monto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = 'SELECT * FROM documentos';
								if($dbn->QuerySQL($query)==0){
									if($dbn->getFilas()>0){
										/*getData obtiene informacion de la consulta */
										//echo("FILAS".$dbn->getFilas());
										while($line=$dbn->getData()){
		                                        echo "<tr>";
		                                        echo "  <td style='text-align:center;'>";
		                                        echo "  <input type='checkbox' id='" . $line['C_U_Codigo'] . "' class='val_pago' value='" . $line['Doc_Codigo'] . "' />";
		                                        echo "  </td>";
		                                        echo "  <td>" . $line['Doc_TipoNombre'] . "</a></td>";
		                                        if ($line['Doc_Tipo'] == 3)
		                                            echo "  <td><a href='documentocertdtll_grid.php?doc_codigo=" . $line['Doc_Codigo'] . "' target='_blank'>" . $line['Doc_NroControl'] . "</a></td>";
		                                        else
		                                            echo "  <td><a href='documentodtll_grid.php?doc_codigo=" . $line['Doc_Codigo'] . "' target='_blank'>" . $line['Doc_NroControl'] . "</a></td>";
		                                        
		                                        //echo "  <td>" . $line['Doc_NroControl'] . "</a></td>";
		                                        echo "  <td>" . $line['Pag_Nombre'] . "</a></td>";
		                                        echo "  <td>" . $line['Ban_Nombre'] . "</a></td>";
		                                        echo "  <td>" . number_format($line['Doc_PgMonto'], '2', ',', '.') . "</a></td>";
		                                        echo "  <td>" . date("d-m-Y", strtotime($line["Doc_PgFechaIns"])) . "</a></td>";
		                                        echo "  <td>" . ($line['Doc_PgSoporte'] == "" ? "-" : $line['Doc_PgSoporte']) . "</a></td>";
		                                        echo "</tr>";
		                                    }
										}
									}
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="span1 offset10">
                    <button class="btn btn-primary" type="button" id="validate_pagogrid">Validar</button>
                </div>
                <div class="span1">
                    <button class="btn btn-primary" type="button" id="clean_pagogrid">Limpiar</button>
                </div>

            </div>
            <hr>
            <div class="span2 offset10">
                <p>Subasta Fiscal 2012</p>
            </div>
        </div>

