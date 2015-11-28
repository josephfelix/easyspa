<div class="pageheader">
  <h2><i class="fa fa-home"></i> Dashboard</h2>
</div>
<div class="contentpanel">
    <div class="row">
        <div class="col-sm-6 col-md-3">
          <div class="panel panel-success panel-stat">
            <div class="panel-heading">
              
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <i class="fa fa-users"></i>
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Usu&aacute;rios</small>
                    <h1><?=$total_usuarios?></h1>
                  </div>
                </div><!-- row -->
              </div><!-- stat -->
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->
        
        <div class="col-sm-6 col-md-3">
          <div class="panel panel-danger panel-stat">
            <div class="panel-heading">
              
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <i class="fa fa-suitcase"></i>
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">PRESTADORES</small>
                    <h1><?=$total_funcionarias?></h1>
                  </div>
                </div><!-- row -->
              </div><!-- stat -->
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->
        
        <div class="col-sm-6 col-md-3">
          <div class="panel panel-primary panel-stat">
            <div class="panel-heading">
              
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <i class="fa fa-file"></i>
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Pagamentos pendentes</small>
                    <h1>4235</h1>
                  </div>
                </div><!-- row -->                  
              </div><!-- stat -->
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->
        
        <div class="col-sm-6 col-md-3">
          <div class="panel panel-dark panel-stat">
            <div class="panel-heading">
              
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <i class="fa fa-money"></i>
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Receita</small>
                    <h1 style="font-size: 22px;">R$ 87.248</h1>
                  </div>
                </div><!-- row -->                  
              </div><!-- stat -->
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->
      </div><!-- row -->
      
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-9">
				  <div id="barchart" style="width: 100%; height: 300px; margin-bottom: 20px"></div>
				</div><!-- col-sm-8 -->
				<div class="col-sm-3">
					<h5 class="subtitle mb5">Novas prestadoras</h5>
					<h1><?=$total_prestadoras_mes?></h1>
					<p class="mb15">C&aacute;lculo com base nos &uacute;ltimos 30 dias para todas as regi&otilde;es do pa&iacute;s.</p>
					<hr />
					<h5 class="subtitle mb5">Novos usuarios</h5>
					<h1><?=$total_usuarios_mes?></h1>
					<p class="mb15">C&aacute;lculo com base nos &uacute;ltimos 30 dias para todas as regi&otilde;es do pa&iacute;s.</p>
				</div><!-- col-sm-4 -->
			</div><!-- row -->
		</div><!-- panel-body -->
	</div><!-- panel -->
      
    </div><!-- contentpanel -->