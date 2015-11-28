$(document).ready(function()
{
	if ( $('.selecionar-tipo').length )
	{
		$('.label-cpf-cnpj, .iCheck-helper').click(function()
		{
			if ( $('.selecionar-tipo:checked').val() == 'PF' )
			{
				$('#form-group-cnpj').addClass('hide');
				$('#form-group-razao').addClass('hide');
				$('#form-group-nomefantasia').addClass('hide');
				$('#form-group-telfixo').addClass('hide');
				$('#form-group-cpf').removeClass('hide');
			} else
			{
				$('#form-group-cpf').addClass('hide');
				$('#form-group-telfixo').removeClass('hide');
				$('#form-group-cnpj').removeClass('hide');
				$('#form-group-razao').removeClass('hide');
				$('#form-group-nomefantasia').removeClass('hide');
			}
		});
		
	}
	
	if ( $('.selecionar-tipo-afiliado').length )
	{
		$('.label-cpf-cnpj-afiliado, .iCheck-helper').click(function()
		{
			if ( $('.selecionar-tipo-afiliado:checked').val() == 'PF' )
			{
				$('#form-group-cnpj-afiliado').addClass('hide');
				$('#form-group-cpf-afiliado').removeClass('hide');
			} else
			{
				$('#form-group-cpf-afiliado').addClass('hide');
				$('#form-group-cnpj-afiliado').removeClass('hide');
			}
		});
	}
	
	if ( $('#select-estado').length )
	$('#select-estado').change(function()
	{
		$('#cidades_prestador').find('option').each(function()
		{
			if ( $(this).val() != '0' )
				$(this).remove();
		});
		$('#cidades_prestador option:selected').html('Carregando...');
		$.get( BASE_URL + 'afiliado/cidades/?estado='+$(this).find('option:selected').val())
		.success(function(result)
		{
			$('#cidades_prestador option:selected').html('Selecione uma cidade');
			var json = JSON.parse( result );
			for ( var x in json )
			{
				$('#cidades_prestador').append('<option value="'+json[x].cidade+'">'+json[x].cidade+'</option>');
			}
		});
	});
	
	$('#form-cpf, #form-cpf-afiliado').mask('999.999.999-99');
	$('#form-cnpj, #form-cnpj-afiliado').mask('99.999.999/9999-99');
	$('#form-telefone, #form-telefone-afiliado').mask('(99) 9999-9999');
	$('#form-celular, #form-celular-afiliado').mask('(99) 99999-9999');
	
	var categorias = [
		{id: 1, nome: 'Pés e Mãos'},
		{id: 2, nome: 'Massagem'},
		{id: 3, nome: 'Cabelereiro'},
		{id: 4, nome: 'Maquiagem'},
		{id: 5, nome: 'Depilação'},
		{id: 6, nome: 'Design de Sobrancelha'},
		{id: 7, nome: 'Cílios'},
		{id: 8, nome: 'Estética facial'},
		{id: 9, nome: 'Estética corporal'},
		{id: 10, nome: 'Práticas integrativas'},
		{id: 11, nome: 'Piercing / Tatuagem'},
		{id: 12, nome: 'Personal Trainer'},
		{id: 13, nome: 'Fisioterapia / Pilates / RPG'},
		{id: 14, nome: 'Nutrição'},
		{id: 15, nome: 'Odontologia'},
		{id: 16, nome: 'Salão'},
		{id: 17, nome: 'Academia'},
		{id: 18, nome: 'Spa'},
		{id: 19, nome: 'Clínica de Estética'},
		{id: 20, nome: 'Hidroterapia/Hidroginástica/Natação'},
		{id: 21, nome: 'Acupuntura / Auriculoterapia'},
		{id: 22, nome: 'Yoga / Reike'}
	];
	
	for ( var ind in categorias )
	{
		$('#lista-todas tbody').append('<tr><td><a href="javascript:;" onclick="escolherCategoria('+categorias[ind].id + ', \''+categorias[ind].nome+'\', this)">' + categorias[ind].nome + '</a></td></tr>');
	}
});

function escolherCategoria( id, nome, obj )
{
	var total = $('#lista-todas tbody tr').length;
	if ( id > 10 )
	{
		$('#lista-todas').hide();
	} else
	{
		for ( var y = 10; y <= $('#lista-todas tbody tr').length; y++)
			$('#lista-todas tbody tr').eq(y).hide();
	}
	$('#titulo-especialidades').removeClass('hide');
	$('#lista-escolhida').show();
	$('#lista-escolhida tbody').append('<tr><td><input type="hidden" name="categoria[]" value="'+id+'" /><a href="javascript:;">'+nome+'</a></td><td><a href="javascript:;" onclick="removerCategoria('+id+',\''+nome+'\', this)"><i class="fa fa-times"></i>&nbsp;Remover</a></td></tr>');
	$(obj).parent().parent().remove();
}

function removerCategoria( id, nome, obj )
{
	if ( id > 10 )
		$('#lista-todas').show();
	$(obj).parent().parent().remove();
	$('<tr><td><a href="javascript:;" onclick="escolherCategoria(' + id + ', \''+nome+'\', this)">' + nome + '</a></td></tr>').insertBefore( $('#lista-todas tbody tr').eq(id-1) );
	if ( !$('#lista-escolhida tbody tr').length )
	{
		$('#titulo-especialidades').addClass('hide');
		$('#lista-escolhida').hide();
		for ( var y = 10; y <= $('#lista-todas tbody tr').length; y++)
			$('#lista-todas tbody tr').eq(y).show();
	}
}

function checkMail()
{
	var result = null;
	var scriptUrl = BASE_URL + "cliente/check/?tipo=email&data=" + encodeURIComponent($('#form-email').val());
	$.ajax({
		url: scriptUrl,
		type: 'get',
		dataType: 'json',
		async: false,
		success: function(data) {
			result = data;
		} 
	});
	return result;
}

function checkCPFCNPJ( data )
{
	var result = null;
	var scriptUrl = BASE_URL + "cliente/check/?tipo=cpfcnpj&data=" + encodeURIComponent(data);
	$.ajax({
		url: scriptUrl,
		type: 'get',
		dataType: 'json',
		async: false,
		success: function(data) {
			result = data;
		} 
	});
	return result;
}
function checkForm1()
{
	if ( $('#form-nome').length )
	{
		if ( $('#form-nome').val().length < 10 )
		{
			$('#form-nome').addClass('error').focus();
			alert('Digite um nome valido para continuar.');
			return false;
		}
	}
	
	if ( $('#form-senha').length )
	{
		if ( !$('#form-senha').val().length )
		{
			$('#form-senha').addClass('error').focus();
			alert('Digite uma senha valida para continuar.');
			return false;
		}
	}
	
	
	if ( $('#form-rua').length )
	{
		if ( $('#form-rua').val().length < 10 )
		{
			$('#form-rua').addClass('error').focus();
			alert('Digite um endereço valido para continuar.');
			return false;
		}
	}
	
	if ( $('#form-bairro').length )
	{
		if ( !$('#form-bairro').val().length )
		{
			$('#form-bairro').addClass('error').focus();
			alert('Digite um bairro valido para continuar.');
			return false;
		}
	}
	
	if ( $('#select-estado option:selected').val() == '0' )
	{
		alert('Selecione um estado para continuar.');
		$('#select-estado').addClass('error').focus();
		return false;
	}
	
	if ( !$('#cidades_prestador option:selected').length )
	{
		alert('Selecione uma cidade para continuar.');
		$('#cidades_prestador').addClass('error').focus();
		return false;
	}
	
	if ( $('#form-email').length )
	{
		if ( !isEmail($('#form-email').val()))
		{
			$('#form-email').addClass('error').focus();
			alert('Escolha outro e-mail para continuar.');
			return false;
		}
	
		if ( checkMail().status == 'FAIL' )
		{
			$('#form-email').addClass('error').focus();
			alert('Este e-mail ja se encontra em uso, tente outro para continuar.');
			return false;
		}
	}
	
	if ( $('.selecionar-tipo:checked').val() == 'PF' )
	{
		if ( checkCPFCNPJ($('#form-cpf').val()).status == 'FAIL' )
		{
			$('#form-cpf').addClass('error').focus();
			alert('Este CPF ja se encontra em uso, tente outro para continuar.');
			return false;
		}
	} else
	{
		if ( checkCPFCNPJ($('#form-cnpj').val()).status == 'FAIL' )
		{
			$('#form-cnpj').addClass('error').focus();
			alert('Este CNPJ ja se encontra em uso, tente outro para continuar.');
			return false;
		}
	}
	
	$('#form-email').removeClass('error');
	$('#form-cpf').removeClass('error');
	$('#form-cnpj').removeClass('error');
	$('#form-nome').removeClass('error');
	$('#form-senha').removeClass('error');
	$('#form-rua').removeClass('error');
	$('#form-bairro').removeClass('error');
	$('#select-estado').removeClass('error');
	$('#cidades_prestador').removeClass('error');
	return true;
}

function checkForm3()
{
	if ( !$('#lista-escolhida tbody tr').length )
	{
		alert('Selecione ao menos uma categoria para continuar!');
		return false;
	}
	return true;
}