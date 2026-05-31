<?php
	$title_produit = "Ajouter";
	$function_to_call = "user_add";
	
	if( $_GET['users_add'] != 0 )
	{
		$element_array_rows = mysqli_query($con, "select * from emploi_users where user_id = '".$_GET['users_add']."'");
		$element_array = mysqli_fetch_array($element_array_rows);
		$title_produit = "Modifier";
		$function_to_call = "user_edit&user_id=".$_GET['users_add'];
	}
	
	function is_checked($key, $value)
	{
		if($key == $value)
			return "checked";
		else
			return "";
	}
?>

<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Utilisateurs</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php"><?= "Accueil"; ?></a></li>
						<li class="breadcrumb-item"><a href="index.php?users=0">Utilisateurs</a></li>
						<li class="breadcrumb-item active">Nouveau</li>
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
										<input type="text" class="form-control" id="user_nom" name="user_nom" placeholder="Nom ..." value="<?= $element_array["user_nom"]; ?>" />
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Prenom</label>
											<input type="text" class="form-control" id="user_prenom" name="user_prenom" placeholder="Prenom ..." value="<?= $element_array["user_prenom"]; ?>" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Date de naissance</label>
											<input type="date" class="form-control" id="user_date_naissance" name="user_date_naissance" placeholder="date de naissance ..." value="<?= $element_array["user_date_naissance"]; ?>" />
										</div>
									</div>
									<div class="col-sm-6">
										
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
										<label>Email</label>
										<input type="text" class="form-control" id="user_email" name="user_email" placeholder="Email ..." value="<?= $element_array["user_email"]; ?>" />
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>N° Tél</label>
											<input type="text" class="form-control" id="user_phone" name="user_phone" placeholder="N° Tél ..." value="<?= $element_array["user_phone"]; ?>" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Utilisateur</label>
											<input type="text" class="form-control" id="user_login" name="user_login" placeholder="Utilisateur ..." value="<?= $element_array["user_login"]; ?>" />
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Mot de passe</label>
											<input type="text" class="form-control" id="user_pass" name="user_pass" placeholder="Mot de passe ..." value="<?= $element_array["user_pass"]; ?>" />
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Civilité</label>
											<select class="form-control" name="user_civilite" id="user_civilite">
												<option <?php echo selected($element_array["user_civilite"], "Mr"); ?>>Mr</option>
												<option <?php echo selected($element_array["user_civilite"], "Mme"); ?>>Mme</option>
												<option <?php echo selected($element_array["user_civilite"], "Melle"); ?>>Melle</option>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Grade</label>
											<input type="text" class="form-control" id="user_grade" name="user_grade" placeholder="Grade ..." value="<?= $element_array["user_grade"]; ?>" />
										</div>
									</div>
									<?php
										if( $element_array["user_type"] == "enseignant" )
										{
											?>
												<div class="col-sm-6">
													<div class="form-group">
														<label>Département</label>
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
											<?php
										}
										
										
										if( $element_array["user_type"] == "etudiant" )
										{
											?>
												<div class="col-sm-6">
													<div class="form-group">
														<label>Groupe</label>
														<select class="form-control" name="groupe_id" id="groupe_id">
															<?php
																$select_spe = "(SELECT specialite_nom from emploi_specialites where emploi_specialites.specialite_id = emploi_groupes.specialite_id) as specialite_nom";
																
																$query=mysqli_query($con, "SELECT *, ".$select_spe." from emploi_groupes");
																
																if( $query->num_rows > 0 )
																{
																	while( $emploi_array = mysqli_fetch_array($query) )
																	{
																		echo('
																			<option value="'.$emploi_array["groupe_id"].'" '.selected($emploi_array["groupe_id"], $element_array["groupe_id"]).'>'.$emploi_array["specialite_nom"].' - '.$emploi_array["groupe_nom"].'</option>
																		');
																	}
																}
															?>
														</select>
													</div>
												</div>
											<?php
										}
									?>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Type</label>
											<select class="form-control" name="user_type" id="user_type" <?= ( $_GET['users_add'] != 0 && $user_array["user_type"] != "admin" ) ? "readonly style='pointer-events: none;'" : ""; ?>>
												<option <?php echo selected($element_array["user_type"], "admin"); ?>>admin</option>
												<option <?php echo selected($element_array["user_type"], "enseignant"); ?>>enseignant</option>
												<option <?php echo selected($element_array["user_type"], "etudiant"); ?>>etudiant</option>
												<option <?php echo selected($element_array["user_type"], "agent"); ?>>agent</option>
												<option <?php echo selected($element_array["technicien"], "technicien"); ?>>technicien</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group" style="text-align:right;">
											<a href="index.php?users=0" class="btn btn-default">Cancel</a>
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