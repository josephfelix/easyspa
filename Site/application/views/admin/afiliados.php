<div class="pageheader">
  <h2><i class="fa fa-edit"></i> Afiliados</h2>
</div>
<div class="contentpanel">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-9">
				  <div id="barchart" style="width: 100%; height: 300px; margin-bottom: 20px"></div>
				</div><!-- col-sm-8 -->
				<div class="col-sm-3">
					<h5 class="subtitle mb5">Afiliados ativos</h5>
					<h1><?=sizeof($todos)?></h1>
					<p class="mb15">C&aacute;lculo com base em todas as regi&otilde;es.</p>
					<hr />
					<h5 class="subtitle mb5">Afiliados inativos</h5>
					<h1>0</h1>
					<p class="mb15">Afiliados que n&atilde;o utilizam mais a plataforma para gerenciar prestadoras.</p>
				</div><!-- col-sm-4 -->
			</div><!-- row -->
		</div><!-- panel-body -->
	</div><!-- panel -->
	
	
	<ul class="nav nav-tabs nav-dark">
		<li class="active"><a href="#todos" data-toggle="tab"><strong>TODOS</strong></a></li>
		<li><a href="#destaques" data-toggle="tab"><strong>DESTAQUES</strong></a></li>
		<li><a href="#ativos" data-toggle="tab"><strong>ATIVOS</strong></a></li>
		<li><a href="#inativos" data-toggle="tab"><strong>INATIVOS</strong></a></li>
	</ul>
	
	<div class="tab-content mb30">
		<div class="tab-pane active" id="todos">
			<select name="uf">
				<option value="RJ">RJ</option>
			</select>
			<select name="cidade">
				<option value="Rio de Janeiro">Rio de Janeiro</option>
			</select>
			Todos os afiliados por ordem aleat&oacute;ria de exibi&ccedil;&atilde;o
			<br /><br />
			<div class="table-responsive">
				<table class="table mb30">
					<thead>
					  <tr>
						<th>COD. AFILIADO</th>
						<th>CONFIRMADO</th>
						<th>DATA DE CADASTRO</th>
						<th>TOTAL PRESTADORES</th>
						<th>TOTAL DE COMISS&Atilde;O</th>
						<th>PENDENTE</th>
						<th>UF</th>
						<th>CIDADE</th>
						<th>TIPO</th>
						<th>NOME DO AFILIADO</th>
					  </tr>
					</thead>
					<tbody>
						<?php
						if ( is_array( $todos ) )
						{
							foreach ( $todos as $afiliado )
							{
						?>
						<tr>
							<td><?=$afiliado->idafiliado?></td>
							<td><?=$afiliado->confirmado?'SIM':'N&Atilde;O'?></td>
							<td><?=date('d/m/Y', strtotime($afiliado->data))?></td>
							<td>0 prestadores</td>
							<td>R$ 00,00</td>
							<td>R$ 00,00</td>
							<td><?=$afiliado->estado?></td>
							<td><?=$afiliado->cidade?></td>
							<td><?=$afiliado->tipo?></td>
							<td><?=$afiliado->nome?> <?=$afiliado->sobrenome?></td>
						</tr>
						<?php
							}
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="tab-pane" id="destaques">
			Destaques
		</div>
		<div class="tab-pane" id="ativos">
			Ativos
		</div>
		<div class="tab-pane" id="inativos">
			Inativos
		</div>
	</div>
</div>