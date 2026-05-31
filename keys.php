<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cles <a href="index.php?keys_add=0" class="btn btn-success">Ajouter</a></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
              <li class="breadcrumb-item active">Cles</li>
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
                <h3 class="card-title">Cles</h3>

                <div class="card-tools form-inline">
                  <form method="GET" class="form-inline">
						<input type="hidden" name="cles" value="0" />
						
						<div class="form-group input-group-sm">
							
						</div>
					</form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-striped ">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Salle</th>
                      <th>User</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
					<?php
						$condition = "1";
						
						$specialite_id_cond = "1";
						
						if( isset($_GET["user_id"]) )
						{
							if( !empty($_GET["user_id"]) )
							{
								$specialite_id_cond = "user_id = '".$_GET["user_id"]."'";
							}
						}
						
						$salle_full_name = "(SELECT salle_nom from emploi_salles where emploi_salles.salle_id = emploi_cles.salle_id) as salle_full_name";
						$enseignant_full_name = "(SELECT concat_ws(' ', user_nom, user_prenom) FROM `emploi_users` where emploi_users.user_id = emploi_cles.user_id) as enseignant_full_name";
						
						$query=mysqli_query($con, "SELECT *, ".$salle_full_name.", ".$enseignant_full_name." from emploi_cles where ".$condition." and ".$specialite_id_cond."");
						
						if( $query->num_rows > 0 )
						{
							while($client_array=mysqli_fetch_array($query))
							{
								?>
									<tr>
										<td><?= $client_array["cle_id"]; ?></td>
										<td><?= $client_array["salle_full_name"]; ?></td>
										<td><?= $client_array["enseignant_full_name"]; ?></td>
										<td><?= $client_array["cle_date"]; ?></td>
										<td><?= $client_array["cle_status"]; ?></td>
										<td>
											<?php
												if( true )
												{
													?>
														<a href="<?php print $index_page;?>?keys_add=<?php print  $client_array['cle_id']; ?>" class=""><i class="fa fa-edit"></i></a>
														
														<a onclick="if(!confirm('Confirmer cette etape')) return false;" href="ajax.php?function=delete_key&cle_id=<?= $client_array["cle_id"]; ?>"><i  style='' class="fa fa-trash"></i></a>
													<?php
												}
											?>
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