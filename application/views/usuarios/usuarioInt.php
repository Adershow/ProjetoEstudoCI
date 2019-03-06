<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li ><a href="<?=base_url('home')?>" class="active"><i class="fas fa-users"></i> <span>Lista de Usuarios</span></a></li>
				<li><a href="<?=base_url('categorias')?>" class=""><i class="fas fa-sitemap"></i> <span>Lista Categorias</span></a></li>
				<li><a href="<?=base_url('questoes')?>" class=""><i class="fas fa-question"></i> <span>Lista de Questões</span></a></li>
				<li><a href="sugestoesCri/lista" class=""><i class="fas fa-comments"></i> <span>Forum de Críticas ou Sugestões</span></a></li>
			</ul>
		</nav>
	</div>
</div>
<!-- END LEFT SIDEBAR -->



<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<!-- RECENT PURCHASES -->
					<div class="panel">
						<div class="panel-heading">
							<?php foreach ($Usuario as $key){ ?>


								<h3 class="panel-title" style="font-size: 30px;">Informações do usuario <?php echo $key['nome']; ?></h3>
							</div>
							<div class="panel-body no-padding">
								<table class="table table-striped" >
									<tbody style="font-size: 22px;">

										<?php echo form_open('usuarios/update', array('method'=>'post')); ?>
											<tr>
												<th ><a style="margin-left: 10%; color: inherit;" > Nome </a></th>
												<td><input type="text" id="nome" style="background-color: #FAFAFA; border: none;" name="nome" value="<?php echo $key['nome']; ?>" readonly /><a  id="nomeBtn" onclick="edita('nomeBtn', 'nome');" style="margin-left: 90%; text-decoration:none; cursor: pointer;"><i class="fas fa-edit"></i></a></td>
											</tr>
											<tr>
												<th><a style="margin-left: 10%; color: inherit;" >Email</a></th>
												<td><input type="text" style="background-color: white; border: none;" id="email" name="email" value="<?php echo $key['email']; ?>" readonly /><a  id="nomeBtn1" onclick="edita('nomeBtn1', 'email');" style="margin-left: 90%; text-decoration:none; cursor: pointer;"><i class="fas fa-edit"></i></a></td>
											</tr>

											<tr>
												<th><a style="margin-left: 10%; color: inherit;" >Senha(Cuidado)</a></th>
												<td><input type="password" name="senha"></i></a></td>
											</tr>
											<tr>
												<th>
													<div class="form-check-inline" style="margin-left: 10%;">
														<label class="form-check-label">
															<input type="radio" name="adm" value="1" class="form-check-input">Adm
														</label>
													</div>
													<div class="form-check-inline" style="margin-left: 10%;">
														<label class="form-check-label">
															<input type="radio" class="form-check-input" value="0" name="adm">Usuário Comum
														</label>
													</div>
												</th>
												<td><button class="btn btn-success" type="submit" value="<?php echo $key['id']; ?>" name="id">Salvar</button></td>
											</tr>
										</form>
									</tbody>
								</table>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-6">
					<!-- RECENT PURCHASES -->
					<div class="panel">
						<div class="panel-heading">



							<h3 class="panel-title" style="font-size: 30px;">Histórico</h3>
						</div>
						<div class="panel-body no-padding">
							<table class="table table-striped" >
								<tbody style="font-size: 18px;">
									<? foreach ($Historico as $key) { ?>

										<tr>
											<th>Questões respondidas corretamente</th>
											<td><?php if($key['QRC'] != null){
												echo $key['QRC'];
											}else{
												echo 'Nenhuma questão respondida corretamente';
											} ?></td>
										</tr>
										<tr >
											<th>Questões respondidas erroneamente</th>
											<td><?php if($key['QRE'] != null){
												echo $key['QRE'];
											}else{
												echo "Nenhuma questões respondida errada"; 
											} ?></td>
										</tr>
										<tr>
											<th>Total de questões respondidas</th>
											<td><?php if($key['QRT'] != null){echo $key['QRT'];}else{ echo 'Nenhuma questão respondida';} ?></td>
										</tr>
										<tr>
											<th>Total de horas de uso</th>
											<td><?php echo $key['tempo_no_site']; ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
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