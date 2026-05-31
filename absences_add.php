<?php
	$title_produit = "Ajouter";
	$function_to_call = "absence_add";
	
	if( $_GET['absences_add'] != 0 )
	{
		$element_array_rows = mysqli_query($con, "select * from emploi_absences where absence_id = '".$_GET['absences_add']."'");
		$element_array = mysqli_fetch_array($element_array_rows);
		
		$enseignant_full_name = "(SELECT concat_ws(' ', user_nom, user_prenom) FROM `emploi_users` where emploi_users.user_id = emploi_emplois.enseignant_id) as enseignant_full_name";
		$module_nom = "(SELECT module_nom FROM `emploi_modules` where emploi_modules.module_id = emploi_emplois.module_id) as module_nom";
		$groupe_nom = "(SELECT groupe_nom FROM `emploi_groupes` where emploi_groupes.groupe_id = emploi_emplois.groupe_id) as groupe_nom";
		$salle_nom = "(SELECT salle_nom FROM `emploi_salles` where emploi_salles.salle_id = emploi_emplois.salle_id) as salle_nom";
		
		$emploi_array_rows = mysqli_query($con, "select *, ".$enseignant_full_name.", ".$module_nom.", ".$groupe_nom.", ".$salle_nom." from emploi_emplois where emploi_id = '".$_GET['absences_add']."'");
		$emploi_array = mysqli_fetch_array($emploi_array_rows);
		
		$title_produit = "Modifier";
		$function_to_call = "emplois_edit&emploi_id=".$_GET['absences_add'];
	}
	
	function get_absences($emploi_id, $user_id, $absence_date)
	{
		global $con;
		
		$query = mysqli_query($con, "SELECT * from emploi_absences where emploi_id = '".$emploi_id."' and user_id = '".$user_id."' and absence_date = '".$absence_date."'");
		
		if( $query->num_rows > 0 )
		{
			return mysqli_fetch_array($query);
		}
		
		return null;
	}
?>

<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Absences</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php"><?= "Accueil"; ?></a></li>
						<li class="breadcrumb-item"><a href="index.php?absences=0">Absences</a></li>
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
									<div class="col-sm-12">
										<b>Enseignant:</b> <?= $emploi_array["enseignant_full_name"]; ?><br />
										<b>Group:</b> <?= $emploi_array["groupe_nom"]; ?><br />
										<b>Salle:</b> <?= $emploi_array["salle_nom"]; ?><br />
										<b>Module:</b> <?= $emploi_array["module_nom"]; ?><br />
										<b>Smestre:</b> <?= $emploi_array["emploi_semestre"]; ?><br />
										<b>Jour:</b> <?= $emploi_array["emploi_jour"]; ?> <b>à</b> <?= $emploi_array["emploi_temp"]; ?><br />
										<hr />
									</div>
								</div>
								<div class="row" style="align-items: flex-start !important;">
									<div class="col-sm-12">
										<div class="form-group">
											<label>Date</label>
											<input type="date" class="form-control" id="absence_date" name="absence_date" placeholder="Nom ..." value="<?= $_GET["absence_date"]; ?>" onchange="window.location = 'index.php?absences_add=<?= $_GET["absences_add"]; ?>&absence_date=' + this.value;" required />
										</div>
									</div>
								</div>
								<?php
									if( !empty($_GET["absence_date"]) )
									{
										?>
											<div class="row" style="align-items: flex-start !important;">
												<div class="col-sm-12">
													<table class="table table-bordered table-hover align-middle">
														<thead class="thead-light">
															<tr>
																<th style="width: 25%;">Étudiant</th>
																<th style="width: 25%;">Présence</th>
																<th>Observation</th>
															</tr>
														</thead>
														<tbody>
															<?php
															$query = mysqli_query($con, "SELECT * FROM `emploi_users` where user_type = 'etudiant' and groupe_id = '".$emploi_array["groupe_id"]."'; ");
															if ($query->num_rows > 0) {
																while ($client_array = mysqli_fetch_array($query))
																{
																	$absence_array = get_absences($emploi_array["emploi_id"], $client_array["user_id"], $_GET["absence_date"]);
																	
																	?>
																		<tr>
																			<td>
																				<?= $client_array["user_nom"]." ".$client_array["user_prenom"]; ?>
																				<input type="hidden" name="user_id[]" value="<?= $client_array["user_id"]; ?>" />
																			</td>
																			<td>
																				<div class="form-check form-check-inline">
																					<input class="form-check-input" type="radio" name="absence_val[]" value="1" id="absence_val_<?= $client_array['emploi_id']; ?>" <?= ($absence_array["absence_val"] == "0") ? "" : "checked"; ?> />
																					<label class="form-check-label" for="absence_val_<?= $client_array['emploi_id']; ?>">Présent</label>
																				</div>
																				<div class="form-check form-check-inline">
																					<input class="form-check-input" type="radio" name="absence_val[]" value="0" id="absence_observation_<?= $absence_array['emploi_id']; ?>" <?= ($absence_array["absence_val"] == "0") ? "checked" : ""; ?>  />
																					<label class="form-check-label" for="absence_observation_<?= $client_array['emploi_id']; ?>">Absent</label>
																				</div>
																			</td>
																			<td>
																				<textarea class="form-control" name="absence_observation[]" placeholder="Observation ..."><?= $absence_array["absence_observation"]; ?></textarea>
																			</td>
																		</tr>
																	<?php
																}
															} else {
																?>
																<tr>
																	<td colspan="3" class="text-center"><br />Pas de result<br /><br /></td>
																</tr>
																<?php
															}
															?>
														</tbody>
													</table>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group" style="text-align:right;">
														<a href="index.php?absences=0" class="btn btn-default">Cancel</a>
														<button type="submit" class="btn btn-success"><?= $title_produit; ?></button>
													</div>
												</div>
											</div>
										<?php
									}
								?>
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