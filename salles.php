<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Salles <a href="index.php?salles_add=0" class="btn btn-success">Ajouter</a></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
              <li class="breadcrumb-item active">Salles</li>
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
                <h3 class="card-title">Salles</h3>

                <div class="card-tools">
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-striped ">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nom</th>
                      <th>Capacite</th>
                      <th>Type</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
					<?php
						$query = mysqli_query($con, "SELECT * from emploi_salles");
						
						if( $query->num_rows > 0 )
						{
							while($client_array = mysqli_fetch_array($query))
							{
								?>
									<tr>
										<td><?= $client_array["salle_id"]; ?></td>
										<td><?= $client_array["salle_nom"]; ?></td>
										<td><?= $client_array["salle_capacite"]; ?></td>
										<td><?= $client_array["salle_type"]; ?></td>
										<td>
											<?php
												if( true )
												{
													?>
														<a href="<?php print $index_page;?>?salles_add=<?php print  $client_array['salle_id']; ?>" class=""><i class="fa fa-edit"></i></a>
														
														<a onclick="if(!confirm('Confirmer cette etape')) return false;" href="ajax.php?function=delete_salle&salle_id=<?= $client_array["salle_id"]; ?>"><i  style='' class="fa fa-trash"></i></a>
													<?php
												}
											?>
											<a href="print_qr.php?function=salle_qr_code&salle_id=<?= $client_array["salle_id"]; ?>"><i  style='' class="fa fa-print"></i></a>
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