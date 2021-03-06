<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li ><a href="<?=base_url('home')?>" class=""><i class="fas fa-users"></i> <span>Lista de Usuarios</span></a></li>
				<li><a href="<?=base_url('categorias')?>" class="active"><i class="fas fa-sitemap"></i> <span>Lista Categorias</span></a></li>
				<li><a href="<?=base_url('questoes')?>" class=""><i class="fas fa-question"></i> <span>Lista de Questões</span></a></li>
				<li><a href="sugestoesCri/lista" class=""><i class="fas fa-comments"></i> <span>Forum de Críticas ou Sugestões</span></a></li>
			</ul>
		</nav>
	</div>
</div>
<style type="text/css">
.checked {
	color: orange;
}
</style>
<!-- END LEFT SIDEBAR -->

<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<!-- RECENT PURCHASES -->
					<div class="panel">
						<div class="panel-heading">
							<?php foreach ($Topicos as $key){ ?>


								<h3 class="panel-title" style="font-size: 30px;">Informações da Tópico <?php echo $key['nome']; ?></h3>
							</div>
							<div class="panel-body no-padding">
								<table class="table table-striped" >
									<tbody style="font-size: 22px;">

										<?php echo form_open('topicos/update', array('method'=>'post')); ?>
										<tr>
											<th ><a style="margin-left: 10%; color: inherit;" > Nome </a></th>
											<td><input type="text" id="nome" style="background-color: #FAFAFA; border: none;" name="nome" value="<?php echo $key['nome']; ?>" readonly /><a  id="nomeBtn" onclick="edita('nomeBtn', 'nome');" style="margin-left: 90%; text-decoration:none; cursor: pointer;"><i class="fas fa-edit"></i></a></td>
										</tr>
										<tr>								
											<input type="text" name="cat_id" value="<?php echo $key['categorias_id']; ?>" hidden>
											<th><a style="margin-left: 10%; color: inherit;" > Ação </a></th>
											<td><button class="btn btn-success" type="submit" value="<?php echo $key['id']; ?>" name="id">Salvar</button></td>
										</tr>
									</form>
								</tbody>
							</table>
						</div>
					<?php } ?>
				</div>
			</div>

			<div class="col-md-12">
				<!-- RECENT PURCHASES -->
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Lista de Questões</h3>
						<h4 class="panel-title" style="color: red;"><?php if(isset($_SESSION['deleteQuest'])){echo $_SESSION['deleteQuest'];} ?></h4>

						<?php echo form_open('topicos/search', array('method'=>'post')); ?>
						<div class="searchbar">
							<input class="search_input" type="text" name="nome" placeholder="Search...">
							<?php foreach ($Topicos as $key){ ?>
								<button type="submit" name="topi_id" value="<?php echo $key['id']; ?>"><i class="fas fa-search"></i></button>
							<?php } ?>
						</div>
					</form>
					<div class="right" style="margin-top: 1.5%;">
						<input type="button" class="btn btn-success" value="Adicionar" data-toggle="modal" data-target="#registrar">
					</div>
				</div>
				<div class="panel-body no-padding">
					<table class="table table-striped" >
						<thead style="font-size: 20px;">
							<tr>
								<th>ID</th>
								<th>Titulo</th>
								<th>Tempo</th>
								<th>Avaliação</th>
								<th>Tópico</th>
								<th>Opções</th>
							</tr>
						</thead>
						<tbody style="font-size: 18px;">
							<?php foreach ($Questoes as $key) { ?>
								<tr>
									<td><?php echo $key['id']; ?></td>
									<td><?php echo $key['titulo']; ?></td>
									<td><?php if($key['tempo'] != null){
										echo $key['tempo'];
									}else{
										echo 'Não tem tempo';} ?>

									</td>

									<td>
										<?php switch ($key['avaliacao']) {
											case '1':
											?><span class="fa fa-star checked"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<?php
											break;
											case '2':?>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<?php break;
											case '3': ?>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<?php break;
											case '4':?>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star"></span>
											<?php break; 

											case '5': ?>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<?php break;
											default:
											echo 'Não tem avaliacao';
											break;
										} ?>
									</td>

									<td><?php echo form_open('usuarios/usuarioInt', array('method'=>'get')); ?><button class="btn btn-info" type="submit" name="id" value="<?php echo $key['id']; ?>" style="max-width: 80px; margin-top: 15px;">Acessar</button></form>

										<?php echo form_open('questoes/delete', array('method'=>'get'));?><button class="btn btn-danger" style="max-width: 80px; margin-top: 15px;" value="<?php echo $key['id']; ?>" name="id">Excluir</button></form>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-md-6 text-left"><a href="#" class="btn btn-danger">Anterior</a></div>
						<div class="col-md-6 text-right"><a href="#" class="btn btn-primary">Próximo</a></div>
					</div>
				</div>
			</div>
			<!-- END RECENT PURCHASES -->
		</div>

		<div class="modal fade" id="registrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" style="font-size: 20px;" id="exampleModalLabel">Registre um Questão neste Tópico</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<?php echo form_open('topicos/add', array('method'=>'post')); ?>
						<div class="form-row">
							<div class="form-group">
								<label for="inputEmail4">Nome</label>
								<input type="text" name="nomeAdd" class="form-control" id="inputEmail4" placeholder="Nome" required>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

							<?php foreach ($Topicos as $idTopi) { ?>
								<button type="submit" name="topi_id" value="<?php echo $idTopi['id'] ?>" class="btn btn-primary">Salvar</button>

							<?php } ?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</tr></tbody></table></div>
</div>
</div>
</div>
</div>
<script>
	function edita(nome, nomeInput){ $('#'+nome).on('click', function(){ $('#'+nomeInput).prop('readonly', false); $('#'+nomeInput).focus();});}
	$('input').on('blur', function(){ $('input').prop('readonly', true);});
</script>