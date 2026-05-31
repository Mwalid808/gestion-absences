<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Départements <a href="index.php?departements_add=0" class="btn btn-success">Ajouter</a></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
              <li class="breadcrumb-item active">Départements</li>
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
                <h3 class="card-title">Départements</h3>

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
                      <th>S1</th>
                      <th>S2</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
					<?php
						$query=mysqli_query($con, "SELECT * from emploi_departements");
						
						if( $query->num_rows > 0 )
						{
							while($client_array=mysqli_fetch_array($query))
							{
								?>
									<tr>
										<td><?= $client_array["departement_id"]; ?></td>
										<td><?= $client_array["departement_nom"]; ?></td>
										<td><a href="print_dep.php?id=<?php print  $client_array['departement_id']; ?>&semstre=1" class=""><i class="fa fa-print"></i></a></td>
										<td><a href="print_dep.php?id=<?php print  $client_array['departement_id']; ?>&semstre=2" class=""><i class="fa fa-print"></i></a></td>
										<td>
											<a href="<?php print $index_page;?>?departements_add=<?php print  $client_array['departement_id']; ?>" class=""><i class="fa fa-edit"></i></a>
											
											<a onclick="if(!confirm('Confirmer cette etape')) return false;" href="ajax.php?function=delete_departement&departement_id=<?= $client_array["departement_id"]; ?>"><i  class="fa fa-trash"></i></a>
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