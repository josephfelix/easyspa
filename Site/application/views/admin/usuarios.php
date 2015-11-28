<div class="pageheader">
  <h2><i class="fa fa-users"></i> Usu&aacute;rios</h2>
</div>
<div class="contentpanel">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-9">
				  <div id="barchart" style="width: 100%; height: 300px; margin-bottom: 20px"></div>
				</div><!-- col-sm-8 -->
				<div class="col-sm-3">
					<h5 class="subtitle mb5">Usu&aacute;rios ativos</h5>
					<h1>0</h1>
					<p class="mb15">C&aacute;lculo com base em todas as regi&otilde;es.</p>
					<hr />
					<h5 class="subtitle mb5">Usu&aacute;rios inativos</h5>
					<h1>0</h1>
					<p class="mb15">Usu&aacute;rios que n&atilde;o utilizam mais a plataforma para gerenciar prestadoras.</p>
				</div><!-- col-sm-4 -->
			</div><!-- row -->
		</div><!-- panel-body -->
	</div><!-- panel -->
	
	
	<ul class="nav nav-tabs nav-dark">
		<li class="active"><a href="#todos" data-toggle="tab"><strong>TODOS</strong></a></li>
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
			Todos os usu&aacute;rios por ordem aleat&oacute;ria de exibi&ccedil;&atilde;o
			<br /><br />
			<div class="table-responsive">
				<table class="table mb30">
					<thead>
					  <tr>
						<th>COD USU&Aacute;RIO</th>
						<th>TIPO</th>
						<th>UF</th>
						<th>CIDADE</th>
						<th>NOME DO CLIENTE</th>
						<th>E-MAIL</th>
					  </tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>PF</td>
							<td>RJ</td>
							<td>S&atilde;o Jo&atilde;o de Meriti</td>
							<td>Claudilene Soares Sobrinho</td>
							<td><a href="mailto:teste@teste.com.br">teste@teste.com.br</a></td>
						</tr>
						<tr>
							<td>21</td>
							<td>PF</td>
							<td>RJ</td>
							<td>S&atilde;o Jo&atilde;o de Meriti</td>
							<td>Claudilene Soares Sobrinho</td>
							<td><a href="mailto:teste@teste.com.br">teste@teste.com.br</a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="tab-pane" id="ativos">
			Ativos
		</div>
		<div class="tab-pane" id="inativos">
			Inativos
		</div>
	</div>
</div>