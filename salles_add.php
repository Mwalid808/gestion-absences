<?php
	$title_produit = "Ajouter";
	$function_to_call = "salle_add";
	
	if( $_GET['salles_add'] != 0 )
	{
		$element_array_rows = mysqli_query($con, "select * from emploi_salles where salle_id = '".$_GET['salles_add']."'");
		$element_array = mysqli_fetch_array($element_array_rows);
		$title_produit = "Modifier";
		$function_to_call = "salle_edit&salle_id=".$_GET['salles_add'];
	}
?>

<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>salles</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php"><?= "Accueil"; ?></a></li>
						<li class="breadcrumb-item"><a href="index.php?salles=0">salles</a></li>
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
											<input type="text" class="form-control" id="salle_nom" name="salle_nom" placeholder="Nom ..." value="<?= $element_array["salle_nom"]; ?>" />
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Capacite</label>
											<input type="text" class="form-control" id="salle_capacite" name="salle_capacite" placeholder="Capacite ..." value="<?= $element_array["salle_capacite"]; ?>" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Type</label>
											<select class="form-control" name="salle_type" id="salle_type">
												<option value="cour" <?= selected("cour", $element_array["salle_type"]); ?>>cour</option>
												<option value="td" <?= selected("td", $element_array["salle_type"]); ?>>td</option>
												<option value="tp" <?= selected("tp", $element_array["salle_type"]); ?>>tp</option>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group" style="text-align:right;">
											<a href="index.php?salles=0" class="btn btn-default">Cancel</a>
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