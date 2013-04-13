        {if $page != 'admin' && $page != 'message' && $ads.ad728}<div class="mxAd">{$ads.ad728}</div>{/if}
        <div class="footer clearfix">
            <div class="pull-left"><a href="{$url}"><strong>{$site_name}</strong></a> &copy; {$smarty.now|date_format:"%Y"} - Todos los derechos reservados.</div>
            <div class="pull-right">El uso de este sitio aplica la aceptaci&oacute;n de sus <a href="{$url}/page/terms-of-use.html">pol&iacute;ticas de uso</a>. 
                <br /><a title="Acerca de" href="{$url}/page/about.html">Acerca de</a> - <a title="Contacto" href="{$url}/page/contact.html">Contacto</a> - <a href="{$url}/admin/">Admin</a> - Software by <a href="http://www.qiozco.com" target="_blank">Qiozco</a>
            </div>
        </div>
    </div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{$url_static}/js/jquery.min.js"></script>
    <script src="{$url_static}/js/bootstrap.min.js"></script>
    <script src="{$url_static}/js/funciones.js"></script>
    {if $page == 'admin' || $page == 'message'}
    <script src="{$url_static}/js/jTable/jquery.dataTables.min.js" type="text/javascript"></script>
    {literal}
    <style type="text/css" media="screen">
    	.dataTables_info { padding-top: 0; }
    	.dataTables_paginate { padding-top: 0; }
    </style>
    <script type="text/javascript">
    $(document).ready( function() {
    	oTable = $('#datos').dataTable({
    		"bJQueryUI": true,
    		"sPaginationType": "full_numbers",
    		"iDisplayLength": 20,
            "aaSorting": [[ 0, "desc" ]],
    		"oLanguage": {
    			"oPaginate": {
    				"sFirst": "Inicio",
    				"sLast": "&Uacute;ltima",
    				"sNext": "Siguiente",
    				"sPrevious": "Anterior"
    			},
    			"sInfo": "Total _TOTAL_ registros. Mostrando (_START_ a _END_)",
    			"sLengthMenu": 'Mostrar <select><option value="25">25</option><option value="50">50</option><option value="75">75</option><option value="100">100</option><option value="150">150</option><option value="-1">Todos</option></select> registros',
    			"sSearch": "Buscar:",
    			"sZeroRecords": "No hay registros para su b&uacute;queda",
    			"sInfoFiltered": "de _MAX_ totales",
    			"sInfoEmpty" : "Mostrando 0 a 0 de 0 registros"
    		}
    
    	});
    } );
    </script>
    {/literal}
    {else}
        {$ads.popup}
    {/if}
    <script type="text/javascript">
        var site_url = '{$url}';
    </script>
  </body>
</html>
