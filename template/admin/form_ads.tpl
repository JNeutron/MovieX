                    <form method="post" action="" class="form-horizontal">
                        <fieldset>
                            <legend>Administrar publicidad</legend>
                            <div class="control-group">
                                <div class="control-label"><label for="popup">Pop-Up:</label></div>
                                <div class="controls">
                                    <textarea name="popup" id="popup" rows="5" class="input-xxlarge">{$adsA.popup}</textarea>
                                    <span class="help-block">Ingresa el c&oacute;digo del pop-up o cualquier c&oacute;digo javascript que quieras insertar entre las etiquetas &#60;head&#62;&#60;/head&#62;.</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><label for="b300">Banner 300x250:</label></div>
                                <div class="controls">
                                    <textarea name="ad300" id="b300" rows="5" class="input-xxlarge">{$adsA.ad300}</textarea>
                                    <span class="help-block">Ingresa el c&oacute;digo para el banner de 300x250.</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><label for="b468">Banner 468x60:</label></div>
                                <div class="controls">
                                    <textarea name="ad468" id="b468" rows="5" class="input-xxlarge">{$adsA.ad468}</textarea>
                                    <span class="help-block">Ingresa el c&oacute;digo para el banner de 468x60.</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><label for="b160">Banner 160x600:</label></div>
                                <div class="controls">
                                    <textarea name="ad160" id="b160" rows="5" class="input-xxlarge">{$adsA.ad160}</textarea>
                                    <span class="help-block">Ingresa el c&oacute;digo para el banner de 160x600.</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><label for="b728">Banner 728x90:</label></div>
                                <div class="controls">
                                    <textarea name="ad728" id="b728" rows="5" class="input-xxlarge">{$adsA.ad728}</textarea>
                                    <span class="help-block">Ingresa el c&oacute;digo para el banner de 728x90.</span>
                                </div>
                            </div>
                            <p class="alert">Recuerda que los c&oacute;digos que ingreses aqu&iacute; son guardados tal cual, si alguno presenta errores de sintaxis puede alterar toda la estructura de la p&aacute;gina.</p>
                            <input type="hidden" name="save" value="true" />
                            <div class="form-actions"><button type="submit" class="btn btn-success">Guardar cambios</button></div>
                        </fieldset>
                    </form>