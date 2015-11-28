<div class="pageheader">
  <h2><i class="fa fa-suitcase"></i> Prestadores de servi&ccedil;o</h2>
</div>
<div class="contentpanel">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-9">
				  <div id="barchart" style="width: 100%; height: 300px; margin-bottom: 20px"></div>
				</div><!-- col-sm-8 -->
				<div class="col-sm-3">
					<h5 class="subtitle mb5">Prestadores ativos</h5>
					<h1>200</h1>
					<p class="mb15">C&aacute;lculo com base em todas as regi&otilde;es</p>
					<hr />
					<h5 class="subtitle mb5">Prestadores inativos</h5>
					<h1>158</h1>
					<p class="mb15">Prestadores que est&atilde;o em d&eacute;bito e se tornaram inativos no sistema</p>				  
				</div><!-- col-sm-4 -->
			</div><!-- row -->
		</div><!-- panel-body -->
	</div><!-- panel -->
	
	
	<ul class="nav nav-tabs nav-dark">
		<li class="active"><a href="#todos" data-toggle="tab"><strong>TODOS</strong></a></li>
		<li><a href="#novos" data-toggle="tab"><strong>NOVOS</strong></a></li>
		<li><a href="#ativos" data-toggle="tab"><strong>ATIVOS</strong></a></li>
		<li><a href="#inativos" data-toggle="tab"><strong>INATIVOS</strong></a></li>
		<li><a href="#emdebito" data-toggle="tab"><strong>EM D&Eacute;BITO</strong></a></li>
	</ul>
	
	<div class="tab-content mb30">
		<div class="tab-pane active" id="todos">
			<select name="uf" style="padding: 5px;">
				<option value="RJ">RJ</option>
			</select>
			<select name="cidade" style="padding: 5px;">
				<option value="Rio de Janeiro">Rio de Janeiro</option>
			</select>
			<input type="text" placeholder="Filtrar por prestador" />
			<button type="button" class="btn btn-mini" style="background:#1d2939;color:#fff;height: 29px;line-height: 12px;">buscar</button>
			<br /><br />
			<div class="table-responsive">
				<table class="table mb30">
					<thead>
					  <tr>
						<th>COD PRESTADOR</th>
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
		<div class="tab-pane" id="novos"></div>
		<div class="tab-pane" id="ativos"></div>
		<div class="tab-pane" id="inativos"></div>
		<div class="tab-pane" id="emdebito"></div>
	</div>
		
</div>