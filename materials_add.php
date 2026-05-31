<?php
	$title_produit = "Ajouter";
	$function_to_call = "material_add";
	
	if( $_GET['materials_add'] != 0 )
	{
		$element_array_rows = mysqli_query($con, "select * from emploi_materials where material_id = '".$_GET['materials_add']."'");
		$element_array = mysqli_fetch_array($element_array_rows);
		$title_produit = "Modifier";
		$function_to_call = "material_edit&material_id=".$_GET['materials_add'];
	}
?>

<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>materials</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php"><?= "Accueil"; ?></a></li>
						<li class="breadcrumb-item"><a href="index.php?materials=0">materials</a></li>
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
											<label>Salle</label>
											<select class="form-control" name="salle_id" id="salle_id">
												<?php
													$query = mysqli_query($con, "SELECT * from emploi_salles");
													
													if( $query->num_rows > 0 )
													{
														while( $cycle_array = mysqli_fetch_array($query) )
														{
															echo('
																<option value="'.$cycle_array["salle_id"].'" '.selected($cycle_array["salle_id"], $element_array["salle_id"]).'>'.$cycle_array["salle_nom"].'</option>
															');
														}
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Nom</label>
											<input type="text" class="form-control" id="material_nom" name="material_nom" placeholder="Nom ..." value="<?= $element_array["material_nom"]; ?>" />
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>matricule</label>
											<input type="text" class="form-control" id="material_mat" name="material_mat" placeholder="matricule ..." value="<?= $element_array["material_mat"]; ?>" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>etat</label>
											<select class="form-control" name="material_etat" id="material_etat">
												<option value="disponible" <?= selected("disponible", $element_array["material_etat"]); ?>>disponible</option>
												<option value="non-disonible" <?= selected("non-disonible", $element_array["material_etat"]); ?>>non-disonible</option>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group" style="text-align:right;">
											<a href="index.php?materials=0" class="btn btn-default">Cancel</a>
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