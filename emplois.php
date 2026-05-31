<?php
	function get_seance($emploi_jour, $emploi_temp, $emploi_semestre)
	{
		global $con, $user_array;
		
		if( $user_array["user_type"] == "enseignant" )
		{
			$query = mysqli_query($con, "SELECT * from emploi_emplois where enseignant_id = '".$user_array["user_id"]."' and emploi_temp = '".$emploi_temp."' and emploi_jour = '".$emploi_jour."' and emploi_annee_univ = '".$_GET["annee_nom"]."' and emploi_semestre = '".$emploi_semestre."'");
		
			if( $query->num_rows > 0 )
			{
				$emplois_array = mysqli_fetch_array($query);
				
				$type = "bg-success";
				if($emplois_array["emploi_type"] == "td" )
					$type = "bg-primary";
				else if($emplois_array["emploi_type"] == "tp" )
					$type = "bg-danger";
				
				$user_array = mysqli_fetch_array(mysqli_query($con, "SELECT * from emploi_users where user_id = '".$emplois_array['enseignant_id']."'"));
				$module_array = mysqli_fetch_array(mysqli_query($con, "SELECT * from emploi_modules where module_id = '".$emplois_array['module_id']."'"));
				$salle_array = mysqli_fetch_array(mysqli_query($con, "SELECT * from emploi_salles where salle_id = '".$emplois_array['salle_id']."'"));
				
				return "<div class='".$type."'>".$module_array['module_nom']."</div><br />".$salle_array['salle_nom'];
			}
		}
		else if( $user_array["user_type"] == "etudiant" )
		{
			$query = mysqli_query($con, "SELECT * from emploi_emplois where groupe_id = '".$user_array["groupe_id"]."' and emploi_temp = '".$emploi_temp."' and emploi_jour = '".$emploi_jour."' and emploi_annee_univ = '".$_GET["annee_nom"]."' and emploi_semestre = '".$emploi_semestre."'");
		
			if( $query->num_rows > 0 )
			{
				$emplois_array = mysqli_fetch_array($query);
				
				$type = "bg-success";
				if($emplois_array["emploi_type"] == "td" )
					$type = "bg-primary";
				else if($emplois_array["emploi_type"] == "tp" )
					$type = "bg-danger";
				
				$module_array = mysqli_fetch_array(mysqli_query($con, "SELECT * from emploi_modules where module_id = '".$emplois_array['module_id']."'"));
				$salle_array = mysqli_fetch_array(mysqli_query($con, "SELECT * from emploi_salles where salle_id = '".$emplois_array['salle_id']."'"));
				
				return "<div class='".$type."'>".$module_array['module_nom']."</div><br />".$salle_array['salle_nom'];
			}
		}
		else
		{
			$query = mysqli_query($con, "SELECT * from emploi_emplois where emploi_temp = '".$emploi_temp."' and emploi_jour = '".$emploi_jour."' and emploi_semestre = '".$emploi_semestre."' and emploi_annee_univ = '".$_GET["annee_nom"]."' and groupe_id in (select groupe_id from emploi_groupes where specialite_id = '".$_GET['specialite_id']."')");
			
			$result = "";
			if( $query->num_rows > 0 )
			{
				while($emplois_array = mysqli_fetch_array($query))
				{
					/*  */
					if( true )
					{
						$edit_bnt = '<a href="'.$index_page.'?emplois_add='.$emplois_array['emploi_id'].'" class=""><i class="fa fa-edit"></i></a>';
						$add_bnt = '<a onclick="if(!confirm(\'Confirmer cette etape\')) return false;" href="ajax.php?function=delete_emploi&emploi_id='.$emplois_array['emploi_id'].'"><i class="fa fa-trash"></i></a>';
						$absence_bnt = '<a href="'.$index_page.'?absences_add='.$emplois_array['emploi_id'].'" class=""><i class="nav-icon fas fa-calendar-times"></i></a>';
					}
					
					$user_array_1 = mysqli_fetch_array(mysqli_query($con, "SELECT * from emploi_users where user_id = '".$emplois_array['enseignant_id']."'"));
					$module_array = mysqli_fetch_array(mysqli_query($con, "SELECT * from emploi_modules where module_id = '".$emplois_array['module_id']."'"));
					$salle_array = mysqli_fetch_array(mysqli_query($con, "SELECT * from emploi_salles where salle_id = '".$emplois_array['salle_id']."'"));
					
					$type = "bg-success";
					if($emplois_array["emploi_type"] == "td" )
						$type = "bg-primary";
					else if($emplois_array["emploi_type"] == "tp" )
						$type = "bg-danger";
					
					$result .= "<div class='".$type."'>".$module_array['module_nom']."</div><br /> ".$salle_array["salle_nom"]." - Groupe ".$emplois_array["groupe_id"]."<br />".$user_array_1["user_nom"]." ".$user_array_1["user_nom"]."<br />".$edit_bnt." ".$add_bnt." ".$absence_bnt."";
				}
			}
			else
			{
				$annee_nom = $_GET["annee_nom"];
				
				$result = '<a href="'.$index_page.'?emplois_add=0&specialite_id='.$_GET['specialite_id'].'&emploi_semestre='.$emploi_semestre.'&emploi_annee_univ='.$annee_nom.'&emploi_temp='.$emploi_temp.'&emploi_jour='.$emploi_jour.'" class="">Ajouter</a>';
			}
		}
		
		return $result;
	}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Emploi de temps</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
              <li class="breadcrumb-item active">Emploi de temps</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Emploi de temps</h3>

                <div class="card-tools">
					<form method="GET" class="form-inline">
						<input type="hidden" name="emplois" value="0" />
						<?php
							if( $user_array["user_type"] == "admin" )
							{
								?>
									<select class="form-control" name="specialite_id" id="specialite_id" onchange="submit();">
										<?php
											$query = mysqli_query($con, "SELECT *, (select filiere_nom from emploi_filieres where emploi_filieres.filiere_id = emploi_specialites.filiere_id) as filiere_nom from emploi_specialites");
											
											if( $query->num_rows > 0 )
											{
												$i = 0;
												while( $module_array_1 = mysqli_fetch_array($query) )
												{
													if( !isset($_GET["specialite_id"]) && $i == 0 )
														$_GET["specialite_id"] = $module_array_1["specialite_id"];
													
													echo('
														<option value="'.$module_array_1["specialite_id"].'" '.selected($module_array_1['specialite_id'], $_GET["specialite_id"]).'>'.$module_array_1["filiere_nom"].' - '.$module_array_1["specialite_nom"].'</option>
													');
													
													$i++;
												}
											}
										?>
									</select>
								<?php
							}
						?>
						<select class="form-control" name="emploi_semestre" id="emploi_semestre" onchange="submit();">
							<option value="1" <?= selected($_GET["emploi_semestre"], "1"); ?>>Semestre 1</option>
							<option value="2" <?= selected($_GET["emploi_semestre"], "2"); ?>>Semestre 2</option>
						</select>
						<select class="form-control" name="annee_nom" id="annee_nom" onchange="submit();">
							<?php
								if( !isset($_GET["emploi_semestre"]) )
									$_GET["emploi_semestre"] = "1";
								
								$query=mysqli_query($con, "SELECT * from emploi_annees");
								
								if( $query->num_rows > 0 )
								{
									$first_annee = null;
									
									$i = 0;
									while($annee_array = mysqli_fetch_array($query))
									{
										if( !isset($_GET["annee_nom"]) && $i == 0 )
											$_GET["annee_nom"] = $annee_array["annee_nom"];
										
										?>
											<option value="<?= $annee_array["annee_nom"]; ?>" <?= selected($_GET["annee_nom"], $annee_array["annee_nom"]); ?>><?= $annee_array["annee_nom"]; ?></option>
										<?php
										
										$i++;
									}
								}
							?>
						</select>
					</form>
				</div>
				<div class="card-tools">
					<?php
						if( $user_array["user_type"] == "enseignant" )
						{
							?>
								<a href="print.php?id=<?= $user_array["user_id"]; ?>&semstre=<?= $_GET["emploi_semestre"]; ?>&annee_nom=<?= $_GET["annee_nom"]; ?>" class="btn btn-default"><i class="fa fa-print"></i> Imprimer</a>
							<?php
						}
						else if( $user_array["user_type"] == "etudiant" )
						{
							?>
								<a href="print.php?id=<?= $user_array["user_id"]; ?>&semstre=<?= $_GET["emploi_semestre"]; ?>&annee_nom=<?= $_GET["annee_nom"]; ?>" class="btn btn-default"><i class="fa fa-print"></i> Imprimer</a>
							<?php
						}
						else
						{
							if( isset($_GET["specialite_id"]) )
							{
								if( !empty($_GET["specialite_id"]) )
								{
									?>
										<a href="print.php?id=<?= $_GET["specialite_id"]; ?>&semstre=<?= $_GET["emploi_semestre"]; ?>&annee_nom=<?= $_GET["annee_nom"]; ?>" class="btn btn-default"><i class="fa fa-print"></i> Imprimer</a>
									<?php
								}
							}
						}
					?>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-striped ">
                  <thead>
                    <tr>
                      <td align="center"> Jour</td>
                      <td align="center"> Séance I <br /> 08:30-10:00</td>
                      <td align="center"> Séance II <br /> 10:00-11:30</td>
                      <td align="center"> Séance III <br /> 11:30-13:00</td>
                      <td align="center"> Séance IV <br /> 13:00-14:30</td>
                      <td align="center"> Séance V <br /> 14:30-16:00</td>
                      <td align="center"> Séance VI <br /> 16:00-17:30</td>
                    </tr>
                  </thead>
                  <tbody>
					<?php
						$list_days = array("Dimanch", "Lundi", "Mardi", "Mercredi", "Jeudi");
						
						foreach( $list_days as $single_value )
						{
							?>
								<tr>
									<td align="center"><?= $single_value; ?></td>
									<td align="center"><?= get_seance($single_value, "08:30-10:00", $_GET["emploi_semestre"]); ?></td>
									<td align="center"><?= get_seance($single_value, "10:00-11:30", $_GET["emploi_semestre"]); ?></td>
									<td align="center"><?= get_seance($single_value, "11:30-13:00", $_GET["emploi_semestre"]); ?></td>
									<td align="center"><?= get_seance($single_value, "13:00-14:30", $_GET["emploi_semestre"]); ?></td>
									<td align="center"><?= get_seance($single_value, "14:30-16:00", $_GET["emploi_semestre"]); ?></td>
									<td align="center"><?= get_seance($single_value, "16:00-17:30", $_GET["emploi_semestre"]); ?></td>
								</tr>
							<?php
						}
					?>
                  </tbody>
                </table>
				<br />
                <table class="table table-bordered table-striped ">
                  <tbody>
					<tr>
						<td align="" style="padding: 20px;">
							<div class='bg-success' style="width: 15%; padding-left: 10px;">Cour</div>  <br />
							<div class='bg-primary' style="width: 15%; padding-left: 10px;">TD</div>  <br />
							<div class='bg-danger' style="width: 15%; padding-left: 10px;">TP</div>  <br />
						</td>
					</tr>
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
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>