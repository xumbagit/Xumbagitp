        <div class="container">
            <div class="row">
                <div class="span12">
                    <label>Bienvenido <strong><span class="nickname-display"><?php echo $_SESSION['Nombre_Admin']; ?></span></strong></label>
                    <div id="information_service"></div>
                    <input id="hidden_tipo_identificacion" type="hidden" value="<?php echo $_SESSION['Tipo_Identificacion']; ?>" />
                    <input id="hidden_nro_identificacion" type="hidden" value="<?php  echo $_SESSION['Nro_Identificacion']; ?>" />
                    <input id="hidden_correo" type="hidden" value="<?php echo $_SESSION['Correo_Admin']; ?>" />
                    <input id="hidden_from" type="hidden" value="" />
                    <input id="hidden_current_client" type="hidden" value="" />
                    <input id="hidden_current_nick_client" type="hidden" value="" />
                    <input id="hidden_current_loginame_client" type="hidden" value="" />
                    <input id="hidden_current_loginame" type="hidden" value="" />
                    <input id="hidden_servicio" type="hidden" value="" />
                </div>
            </div>

            <div id="sel_service" style="display:inline">
                <select id="service">
                    <?php getAsesorias(); ?>
                </select><br/>
                <button class="btn" id="sel_service_btn" >Aceptar</button>
            </div>

            <div id="chat_div" style="display:none">
                <div class="row">
                    <div class="span10" >
                        <div class="btn-group">
                            <button class="btn" id="exit_chat" ><i class="icon-off"></i> Salir del Chat</button>
                        </div>
                    </div>
                    <div class="span2" id="deldiv"></div>
                </div>

                <div id="chat" class="row">
                    <div class="span6">
                        <div class="row">
                            <div id="log" class="span6"></div>
                        </div>
                        <div class="row">
                            <div class="span6">
                                <textarea id="message" class="span6" maxlength="140" title="Escribe un mensaje y presiona Enter..." placeholder="Escribe un mensaje y presiona Enter..." disabled></textarea>
                                <div>
                                    <button id="normal_sending" class="btn btn-small btn-primary disabled">Enviar</button>
                                    <button id="broadcast_sending" class="btn btn-small btn-primary disabled">Broadcast</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="span4 offset1">
                        <div style="margin-left: 25px; margin-bottom: 5px;"><span class="label"><i class="icon-user icon-white"></i> Usuarios Atendidos</span></div>
                        <div id="clients_div" class="row" style="height:400px;">
                            <table id="current_clients" class="table table-hover table-condensed" caption="Clientes atendidos.">
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="historial" style="display:none"></div>
        </div>