                    {if !$result && !$error}
                    <form method="post" action="" class="form-horizontal">
                        <div class="alert alert-block alert-error">
                            <h4>¡Eliminar elemento!</h4>
                            <p style="margin: 5px 0">A continuaci&oacute;n va a eliminar {$delType}, si lo hace los datos no podr&aacute;n ser restaurados. &iquest;Realmente desea continuar?</p>
                            <p><input type="submit" name="delete" value="Eliminar" class="btn btn-danger" /> <button onclick="history.go(-1); return false;" class="btn">Cancelar</button></p>
                        </div>
                    </form>
                    {/if}