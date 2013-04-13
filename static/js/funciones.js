// VALIDAR BUSQUEDA
function validar_search(){
    var q = $('#s').val();
    //
    if(q == '' || q == 'Buscar película') {
        $('#s').val('').focus();   
    }
    else document.location.href = site_url + '/search/' + q + '/';
    //
    return false;
}
// SHARE FACEBOOK
function shareFB(share_url){
    var config = 'height=310,width=480,scrollTo,resizable=0,scrollbars=0,location=0';
    nueva = window.open('http://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(share_url) , 'Share', config);
    return false;  
}
// REPORTAR
function reportar(id, type){
	$.ajax({
		type: 'POST',
		url: site_url + '/ajax.php?do=report',
		data: 'id=' + id + '&type=' + type,
		success: function(h){
            alert(h.substring(3));
		}
	});
}
// VOTAR
function votar(voto, mid){
	$.ajax({
		type: 'POST',
		url: site_url + '/ajax.php?do=votar',
		data: 'voto=' + voto + '&mid=' + mid,
		success: function(h){
            alert(h.substring(3));
		}
	});
}

$(function(){
    /* LUZ */
    $('#light_switch').click(function(){
        $('#light').toggle();
    });
    
    $('#light').click(function(){
       $(this).hide(); 
    });
    
    $('input[name=embed]').on('click', function (){
        var embed = $(this).val();
        
        if (embed == 1)
        {
            $('#code').show();
            $('#source').hide();
        }
        else
        {
            $('#code').hide();
            $('#source').show();
        }
    });
    
    $('input[name=plugin]').on('click', function (){
        var embed = $(this).val();
        
        if (embed == 1)
        {
            $('#gkPlugin').show();
        }
        else
        {
            $('#gkPlugin').hide();
        }
    })
})