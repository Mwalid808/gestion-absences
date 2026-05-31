<?php
	$title_produit = "Ajouter";
	$function_to_call = "annees_add";
?>

<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Année universitaire</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php"><?= "Accueil"; ?></a></li>
						<li class="breadcrumb-item active">Année universitaire</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><?= $title_produit; ?></h3>
						</div>
						<div class="card-body">
							<form action="ajax.php?function=<?= $function_to_call; ?>" method="POST" role="form" enctype="multipart/form-data">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Nom</label>
											<input type="text" class="form-control" id="annee_nom" name="annee_nom" placeholder="Nom ..." value="<?= $element_array["annee_nom"]; ?>" />
										</div>
									</div>
									<div class="col-sm-6">
										
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group" style="text-align:right;">
											<a href="index.php?departements=0" class="btn btn-default">Cancel</a>
											<button type="submit" class="btn btn-default"><?= $title_produit; ?></button>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="card-footer">
							
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
			  <div class="col-12">
				<div class="card">
				  <div class="card-header">
					<h3 class="card-title">Année universitaire</h3>

					<div class="card-tools">
					  
					</div>
				  </div>
				  <!-- /.card-header -->
				  <div class="card-body table-responsive p-0">
					<table class="table table-bordered table-striped ">
					  <thead>
						<tr>
						  <th>ID</th>
						  <th>Nom</th>
						  <th>Action</th>
						</tr>
					  </thead>
					  <tbody>
						<?php
							$query=mysqli_query($con, "SELECT * from emploi_annees");
							
							if( $query->num_rows > 0 )
							{
								while($client_array=mysqli_fetch_array($query))
								{
									?>
										<tr>
											<td><?= $client_array["annee_id"]; ?></td>
											<td><?= $client_array["annee_nom"]; ?></td>
											<td>
												<a onclick="if(!confirm('Confirmer cette etape')) return false;" href="ajax.php?function=annees_delete&annee_id=<?= $client_array["annee_id"]; ?>"><i  class="fa fa-trash"></i></a>
											</td>
										</tr>
									<?php
								}
							}
						?>
					  </tbody>
					</table>
				  </div>
				  <div class="card-footer clearfix">
					<ul class="pagination float-right">
						
					</ul>
				  </div>
				</div>
				<!-- /.card -->
			  </div>
			</div>
		</div>
	</section>
</div>