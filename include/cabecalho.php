<div class="navbar navbar-inverse" role="navigation">
  <div class="container-fluid"  style='background-color: #73a839;'>
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="./home.php">FiveClínic <?php echo $_ambiente ?></a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        
        <div class="dropdown" style="float:left; width:150px;">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          <i class="fa fa-cog"></i> Configurações
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
          <li><a href="./alterar_senha.php">Alterar Senha</a></li>
          <li><a href="./cidade_listar.php">Cidade</a></li>
          <li><a href="./convenio_listar.php">Convênio</a></li>
		  <!--<li><a href="./especialidades_listar.php">Especialidades</a></li>-->
          <li><a href="./feriado_cadastrar.php">Feriado</a></li>
          <li><a href="./fornecedor_listar.php">Fornecedor</a></li>
          <li><a href="./funcionario_listar.php">Funcionário</a></li>
          <li><a href="./grupo_usuario_listar.php">Grupo de Usuário</a></li>
		  <li><a href="./medicamentos_listar.php">Medicamentos</a></li>
		   <!--<li><a href="./permissao_cadastrar.php">Permissão</a></li>-->
          <li><a href="./produtos_listar.php">Produto</a></li>
		  
		   <!--<li><a href="./profissional_listar.php">Profissional</a></li>-->
         <!-- <?php if($_grupo_usuario_id == 8){?>

            <li><a href="./empresa_cadastrar.php">Empresa</a></li>
          <?php } ?> -->
         </ul>
        </div>
        <div class="sair"><li><a href="logof.php"><span class="item_menu_admin"><i class="fa fa-sign-out"></i> Sair</span></a></li></div>
        <!--<li><a href="usuario_dados.php"><span class="item_menu_admin"><i class="fa fa-user"></i>Usuário</a></span></li>-->
        
      </ul>
    </div>
  </div>
</div>