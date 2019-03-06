		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav"  class="sidebar">
			<div class="sidebar-scroll">
				<nav >
					<ul class="nav">
						<li ><a href="<?=base_url('home')?>" class=""><i class="fas fa-users"></i> <span>Lista de Usuarios</span></a></li>
						<li><a href="<?=base_url('categorias')?>" class="active"><i class="fas fa-sitemap"></i> <span>Lista Categorias</span></a></li>
						<li><a href="<?=base_url('questoes')?>" class=""><i class="fas fa-question"></i> <span>Lista de Questões</span></a></li>
						<li><a href="sugestoesCri/lista" class=""><i class="fas fa-comments"></i> <span>Forum de Críticas ou Sugestões</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<!-- RECENT PURCHASES -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Lista de Categorias</h3>
									<h4 class="panel-title" style="color: red;"><?php if(isset($_SESSION['delete'])){echo $_SESSION['delete'];} ?></h4>
									<div class="left" style="margin-top: 1.5%;">
										<div class="d-flex justify-content-center h-100">
											<p class="lead"><?php echo validation_errors();?></p>
											<?php echo form_open('categorias/search', array('method'=>'post')); ?>
											<div class="searchbar">
												<input class="search_input" type="text" name="nome" placeholder="Search...">
												<button type="submit"><i class="fas fa-search"></i></button>
											</div>
										</form>
									</div>
								</div>
								<div class="right" style="margin-top: 1.5%;">
									<input type="button" class="btn btn-success" value="Adicionar" data-toggle="modal" data-target="#registrar">
								</div>
							</div>
							<div class="panel-body no-padding">
								<table class="table table-striped" >
									<thead style="font-size: 20px;">
										<tr>
											<th>ID</th>
											<th>Nome</th>
											<th>Opções</th>
										</tr>
									</thead>
									<tbody style="font-size: 18px;">
										<?php foreach ($Categorias as $key) { ?>
											<tr>
												<td><?php echo $key['id']; ?></td>
												<td><?php echo $key['nome']; ?></td>
												<td><?php echo form_open('categorias/categoriaInt', array('method'=>'get')); ?><button class="btn btn-info" type="submit" name="id" value="<?php echo $key['id']; ?>" style="max-width: 80px; margin-top: 15px;">Acessar</button></form>

													<?php echo form_open('categorias/delete', array('method'=>'get'));?><button class="btn btn-danger" style="max-width: 80px; margin-top: 15px;" value="<?php echo $key['id']; ?>" name="id">Excluir</button></form>
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
				</div>

				<div class="modal fade" id="registrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" style="font-size: 20px;" id="exampleModalLabel">Registre uma Categorias</h5>
								<h6 class="modal-title" style="font-size: 12px;" id="exampleModalLabel"><?php if(isset($data['msg'])){
									echo $data['msg'];
								}?></h6>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<?php echo form_open('categorias/add', array('method'=>'post')); ?>
								<div class="form-row">
									<div class="form-group">
										<label for="inputEmail4">Nome</label>
										<input type="text" name="nome" class="form-control" id="inputEmail4" placeholder="Nome" required>
									</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
									<button type="submit" class="btn btn-primary">Salvar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END MAIN CONTENT -->
</div>
<!-- END MAIN -->
</div>