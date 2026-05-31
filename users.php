<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Utilisateurs <a href="index.php?users_add=0" class="btn btn-success">Ajouter</a></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
              <li class="breadcrumb-item active">Utilisateurs</li>
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
                <h3 class="card-title">Utilisateurs</h3>

                <div class="card-tools">
                  <form method="GET" class="form-inline">
						<input type="hidden" name="users" value="0" />
						<select class="form-control" name="departement_id" id="departement_id" onchange="submit();">
							<option value='0'>Tout departements</option>
							<?php
								$query = mysqli_query($con, "SELECT * from emploi_departements");
								
								if( $query->num_rows > 0 )
								{
									while( $module_array_1 = mysqli_fetch_array($query) )
									{
										echo('
											<option value="'.$module_array_1["departement_id"].'" '.selected($module_array_1['departement_id'], $_GET["departement_id"]).'>'.$module_array_1["departement_nom"].'</option>
										');
									}
								}
							?>
						</select>
						<select class="form-control" name="user_type" id="user_type" onchange="submit();">
							<option value='0'>Tout Utilisateur</option>
							<option value="admin" <?= selected("admin", $_GET["user_type"]); ?>>Admin</option>
							<option value="enseignant" <?= selected("enseignant", $_GET["user_type"]); ?>>Enseignant</option>
							<option value="etudiant" <?= selected("etudiant", $_GET["user_type"]); ?>>Etudiant</option>
						</select>
					</form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-striped ">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th style="width: 20%;">Nom</th>
                      <th>Prenom</th>
                      <th>Date de naissance</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
					<?php
						/* filter departement */
						$departement_id_cond = "1";
						
						if( isset($_GET["departement_id"]) )
						{
							if( !empty($_GET["departement_id"]) )
							{
								$departement_id_cond = "departement_id = '".$_GET["departement_id"]."'";
							}
						}
						
						/* filter user */
						$user_type_cond = "1";
						
						if( isset($_GET["user_type"]) )
						{
							if( !empty($_GET["user_type"]) )
							{
								$user_type_cond = "user_type = '".$_GET["user_type"]."'";
							}
						}
						
						$departement = "(select departement_nom from emploi_departements where emploi_departements.departement_id = emploi_users.departement_id) as departement";
						
						$query = mysqli_query($con, "SELECT *, ".$departement." from emploi_users where ".$departement_id_cond." and ".$user_type_cond."");
						
						if( $query->num_rows > 0 )
						{
							while($client_array=mysqli_fetch_array($query))
							{
								?>
									<tr>
										<td><?= $client_array["user_id"]; ?></td>
										<td><?= $client_array["user_nom"]; ?></td>
										<td><?= $client_array["user_prenom"]; ?></td>
										<td><?= $client_array["user_date_naissance"]; ?></td>
										<td><?= $client_array["user_email"]; ?></td>
										<td><?= $client_array["user_phone"]; ?></td>
										<td>
											<a href="<?php print $index_page;?>?users_add=<?php print  $client_array['user_id']; ?>" class=""><i class="fa fa-edit"></i></a>
											
											<a onclick="if(!confirm('Confirmer cette etape')) return false;" href="ajax.php?function=delete_user&user_id=<?= $client_array["user_id"]; ?>"><i  style='' class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php
							}
						}
						else
						{
							?>
								<tr>
									<td colspan="12" style="text-align:center;"><br />Pas de result<br /><br /></td>
								</tr>
							<?php
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
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>