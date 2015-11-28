function checarForm()
{
	if ( !$('#termos').is(':checked') )
	{
		alert('Aceite os termos de uso para continuar!');
		return false;
	}
	if ( $('#form-usuario').hasClass('error') )
	{
		alert('Escolha outro nome de usuario para continuar!');
		$('#form-usuario').focus();
		return false;
	}
	
	if ( $('#form-cpf').hasClass('error') || $('#form-cnpj').hasClass('error') )
	{
		alert('Escolha outro CPF/CNPJ para continuar!');
		return false;
	}
	return true;
}
	
jQuery(document).ready(function() {
	
    /*
        Fullscreen background
    */    
    $.backstretch([
                           URL_INICIAL + "assets/img/backgrounds/1.jpg"
                         , URL_INICIAL + "assets/img/backgrounds/2.jpg"
                         , URL_INICIAL + "assets/img/backgrounds/3.jpg"
                         ], {duration: 3000, fade: 750});
    
    $('#top-navbar-1').on('shown.bs.collapse', function(){
    	$.backstretch("resize");
    });
    $('#top-navbar-1').on('hidden.bs.collapse', function(){
    	$.backstretch("resize");
    });
    
    /*
        Form validation
    */
	
	if ( $('.selecionar-tipo').length )
	$('.selecionar-tipo').click(function()
	{
		if ( $(this).val() == 'PF' )
		{
			$('#container-cnpj').hide();
			$('#container-cpf').show();
		} else
		{
			$('#container-cpf').hide();
			$('#container-cnpj').show();
		}
	});
	
	function isEmail (a) {
	var b = /@[\w\-]+\./,
            c = /\.[a-zA-Z]{2,3}$/;
        return -1 != a.search(/[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/) || -1 == a.search(b) || -1 == a.search(c) ? !1 : !0
	}
	
	//masks
	
	$('#form-email').keyup(function()
	{
		if ( isEmail( $(this).val() ) )
		{
			$(this).removeClass('error');
			$(this).addClass('success');
		} else
		{
			$(this).removeClass('success');
			$(this).addClass('error');
		}
	});
	
	if ( $('#form-usuario').length )
	$('#form-usuario').change(function()
	{
		$.get('/afiliado/checar/?usuario=' + $('#form-usuario').val())
		.success(function(result)
		{
			var json = JSON.parse( result );
			if ( json.status == 'OK' )
			{
				$('#form-usuario').removeClass('error');
				$('#form-usuario').addClass('success');
			} else
			{
				$('#form-usuario').removeClass('success');
				$('#form-usuario').addClass('error');
			}
		});
	});
	
	if ( $('#form-cpf').length )
	{
		$('#form-cpf').change(function()
		{
			$.get('/afiliado/checar/?cpf=' + $('#form-cpf').val())
			.success(function( result )
			{
				var json = JSON.parse( result );
				if ( json.status == 'OK' )
				{
					$('#form-cpf').removeClass('error');
					$('#form-cpf').addClass('success');
				} else
				{
					$('#form-cpf').removeClass('success');
					$('#form-cpf').addClass('error');
					
				}
			});
		});
	}
	
	if ( $('#form-cnpj').length )
	{
		$('#form-cnpj').change(function()
		{
			$.get('/afiliado/checar/?cnpj=' + $('#form-cnpj').val())
			.success(function( result )
			{
				var json = JSON.parse( result );
				if ( json.status == 'OK' )
				{
					$('#form-cnpj').removeClass('error');
					$('#form-cnpj').addClass('success');
				} else
				{
					$('#form-cnpj').removeClass('success');
					$('#form-cnpj').addClass('error');
					
				}
			});
		});
	}
	
	if ( $('#form-usuario').length )
	$('#form-usuario').keypress(function(e)
	{
		if ( $(this).val().length > 20 ) return false;
		if ( (e.which >= 65 && e.which <= 90) || (e.which >= 48 && e.which <= 57 ) ||
			 (e.which >= 97 && e.which <= 122 ))
		{
			return true;
		}
		return false;		
	});
	
	if ( $('#select-estado').length )
	$('#select-estado').change(function()
	{
		$('#select-cidade').find('option').each(function()
		{
			if ( $(this).val() != '0' )
				$(this).remove();
		});
		$('#select-cidade option:selected').html('Carregando...');
		$.get('/afiliado/cidades/?estado='+$(this).find('option:selected').val())
		.success(function(result)
		{
			$('#select-cidade option:selected').html('Selecione uma cidade');
			var json = JSON.parse( result );
			for ( var x in json )
			{
				$('#select-cidade').append('<option value="'+json[x].cidade+'">'+json[x].cidade+'</option>');
			}
		});
	});
	
	if ( $('#form-cep').length )
	{
		$('#form-cep').mask('99999-999');
		$('#form-cpf').mask('999.999.999-99');
		$('#form-cnpj').mask('99.999.999/9999-99');
		$('#form-telefone').mask('(99) 9999-9999');
		$('#form-celular').mask('(99) 99999-9999');
	}
});
