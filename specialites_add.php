<?php
	$title_produit = "Ajouter";
	$function_to_call = "specialite_add";
	
	if( $_GET['specialites_add'] != 0 )
	{
		$element_array_rows = mysqli_query($con, "select * from emploi_specialites where specialite_id = '".$_GET['specialites_add']."'");
		$element_array = mysqli_fetch_array($element_array_rows);
		$title_produit = "Modifier";
		$function_to_call = "specialite_edit&specialite_id=".$_GET['specialites_add'];
	}
?>

<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Spécialités</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php"><?= "Accueil"; ?></a></li>
						<li class="breadcrumb-item"><a href="index.php?specialites=0">Spécialités</a></li>
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
											<input type="text" class="form-control" id="specialite_nom" name="specialite_nom" placeholder="Nom ..." value="<?= $element_array["specialite_nom"]; ?>" />
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Cycle</label>
											<select class="form-control" name="cycle_id" id="cycle_id">
												<?php
													$query=mysqli_query($con, "SELECT * from emploi_cycles");
													
													if( $query->num_rows > 0 )
													{
														while( $cycle_array = mysqli_fetch_array($query) )
														{
															echo('
																<option value="'.$cycle_array["cycle_id"].'" '.selected($cycle_array["cycle_id"], $element_array["cycle_id"]).'>'.$cycle_array["cycle_nom"].'</option>
															');
														}
													}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Filière</label>
											<select class="form-control" name="filiere_id" id="filiere_id">
												<?php
													$query=mysqli_query($con, "SELECT * from emploi_filieres");
													
													if( $query->num_rows > 0 )
													{
														while( $cycle_array = mysqli_fetch_array($query) )
														{
															echo('
																<option value="'.$cycle_array["filiere_id"].'" '.selected($cycle_array["filiere_id"], $element_array["filiere_id"]).'>'.$cycle_array["filiere_nom"].'</option>
															');
														}
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group" style="text-align:right;">
											<a href="index.php?specialites=0" class="btn btn-default">Cancel</a>
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