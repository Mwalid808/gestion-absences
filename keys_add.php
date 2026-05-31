<?php
	$title_produit = "Ajouter";
	$function_to_call = "cle_add";
	
	if( $_GET['keys_add'] != 0 )
	{
		$element_array_rows = mysqli_query($con, "select * from emploi_cles where cle_id = '".$_GET['keys_add']."'");
		$element_array = mysqli_fetch_array($element_array_rows);
		$title_produit = "Modifier";
		$function_to_call = "cle_edit&cle_id=".$_GET['keys_add'];
	}
	else
	{
		$element_array["cle_status"] = "0";
	}
?>

<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>cles</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php"><?= "Accueil"; ?></a></li>
						<li class="breadcrumb-item"><a href="index.php?keys=0">cles</a></li>
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
											<label>Enseignant</label>
											<select class="form-control" name="user_id" id="user_id">
												<?php
													$query=mysqli_query($con, "SELECT * from emploi_users where user_type = 'enseignant'");
													
													if( $query->num_rows > 0 )
													{
														while( $specialite_array = mysqli_fetch_array($query) )
														{
															// '.abgrcs::selected($specialite_array->user_id, $formation_array->user_id).'
															echo('
																<option value="'.$specialite_array["user_id"].'" '.selected($element_array["user_id"], $specialite_array["user_id"]).'>'.$specialite_array["user_nom"].'</option>
															');
														}
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Salle</label>
											<select class="form-control" name="salle_id" id="salle_id">
												<?php
													$query=mysqli_query($con, "SELECT * from emploi_salles");
													
													if( $query->num_rows > 0 )
													{
														while( $specialite_array = mysqli_fetch_array($query) )
														{
															echo('
																<option value="'.$specialite_array["salle_id"].'" '.selected($element_array["salle_id"], $specialite_array["salle_id"]).'>'.$specialite_array["salle_nom"].'</option>
															');
														}
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Status</label>
											<br />
											<input type="radio" id="cle_status" name="cle_status" value="1" <?= checked($element_array["cle_status"], "1"); ?> /> Active
											<input type="radio" id="cle_status" name="cle_status" value="0" <?= checked($element_array["cle_status"], "0"); ?> /> In-Active
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group" style="text-align:right;">
											<a href="index.php?keys=0" class="btn btn-default">Cancel</a>
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