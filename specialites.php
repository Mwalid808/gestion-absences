<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Spécialités <a href="index.php?specialites_add=0" class="btn btn-success">Ajouter</a></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
              <li class="breadcrumb-item active">Spécialités</li>
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
                <h3 class="card-title">Spécialités</h3>

                <div class="card-tools">
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-striped ">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Filiere</th>
                      <th>Nom</th>
                      <th>Cycle</th>
                      <th>S1</th>
                      <th>S2</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
					<?php
						$condition = "1";
						$cycle = "(select cycle_nom from emploi_cycles where emploi_cycles.cycle_id = emploi_specialites.cycle_id) as cycle";
						$filiere = "(select filiere_nom from emploi_filieres where emploi_filieres.filiere_id = emploi_specialites.filiere_id) as filiere";
						
						if( $chef_departement_id != 0 )
						{
							$condition = "departement_id = '".$chef_departement_id."'";
						}
						
						$query=mysqli_query($con, "SELECT *, ".$cycle.", ".$filiere." from emploi_specialites where ".$condition."");
						
						if( $query->num_rows > 0 )
						{
							while($client_array=mysqli_fetch_array($query))
							{
								?>
									<tr>
										<td><?= $client_array["specialite_id"]; ?></td>
										<td><?= $client_array["filiere"]; ?></td>
										<td><?= $client_array["specialite_nom"]; ?></td>
										<td><?= $client_array["cycle"]; ?></td>
										<td><a href="print.php?id=<?php print  $client_array['specialite_id']; ?>&semstre=1" class=""><i class="fa fa-print"></i></a></td>
										<td><a href="print.php?id=<?php print  $client_array['specialite_id']; ?>&semstre=2" class=""><i class="fa fa-print"></i></a></td>
										<td>
											<a href="<?php print $index_page;?>?specialites_add=<?php print  $client_array['specialite_id']; ?>" class=""><i class="fa fa-edit"></i></a>
											
											<a onclick="if(!confirm('Confirmer cette etape')) return false;" href="ajax.php?function=delete_specialite&specialite_id=<?= $client_array["specialite_id"]; ?>"><i  class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php
							}
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