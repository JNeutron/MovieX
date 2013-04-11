                    {if !$result && !$error}
                    <form method="post" action="" class="form-horizontal">
                        <fieldset>
                            <p class="alert" style="border:none">A continuaci&oacute;n va a eliminar {$delType}, si lo hace los datos no podr&aacute;n ser restaurados. &iquest;Realmente desea continuar?</p>
                            <div class="form-actions">
                                <input type="submit" name="delete" value="Eliminar" class="btn btn-danger" />
                                <button onclick="history.go(-1); return false;" class="btn">Cancelar</button>
                            </div>
                        </fieldset>
                    </form>
                    {/if}