<?php
	$title_produit = "Ajouter";
	$function_to_call = "filiere_add";
	
	if( $_GET['filieres_add'] != 0 )
	{
		$element_array_rows = mysqli_query($con, "select * from emploi_filieres where filiere_id = '".$_GET['filieres_add']."'");
		$element_array = mysqli_fetch_array($element_array_rows);
		$title_produit = "Modifier";
		$function_to_call = "filiere_edit&filiere_id=".$_GET['filieres_add'];
	}
?>

<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Filière</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php"><?= "Accueil"; ?></a></li>
						<li class="breadcrumb-item"><a href="index.php?filieres=0">Filière</a></li>
						<li class="breadcrumb-item active">nouveau</li>
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
											<input type="text" class="form-control" id="filiere_nom" name="filiere_nom" placeholder="Nom ..." value="<?= $element_array["filiere_nom"]; ?>" />
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Départements</label>
											<select class="form-control" name="departement_id" id="departement_id">
												<?php
													$query=mysqli_query($con, "SELECT * from emploi_departements");
													
													if( $query->num_rows > 0 )
													{
														while( $cycle_array = mysqli_fetch_array($query) )
														{
															echo('
																<option value="'.$cycle_array["departement_id"].'" '.selected($cycle_array["departement_id"], $element_array["departement_id"]).'>'.$cycle_array["departement_nom"].'</option>
															');
														}
													}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group" style="text-align:right;">
											<a href="index.php?filieres=0" class="btn btn-default">Cancel</a>
											<button type="submit" class="btn btn-success"><?= $title_produit; ?></button>
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
		</div>
	</section>
</div>