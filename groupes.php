<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Groupes <a href="index.php?groupes_add=0" class="btn btn-success">Ajouter</a></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
              <li class="breadcrumb-item active">Groupes</li>
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
                <h3 class="card-title">Groupes</h3>

                <div class="card-tools">
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-striped ">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Section</th>
                      <th>Specialite</th>
                      <th>Nom</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
					<?php
						$query=mysqli_query($con, "SELECT *, (select specialite_nom from emploi_specialites where emploi_specialites.specialite_id = emploi_groupes.specialite_id) as speciliate from emploi_groupes");
						
						if( $query->num_rows > 0 )
						{
							while($client_array=mysqli_fetch_array($query))
							{
								?>
									<tr>
										<td><?= $client_array["groupe_id"]; ?></td>
										<td><?= $client_array["section_num"]; ?></td>
										<td><?= $client_array["speciliate"]; ?></td>
										<td><?= $client_array["groupe_nom"]; ?></td>
										<td>
											<?php
												if( true )
												{
													?>
														<a href="<?php print $index_page;?>?groupes_add=<?php print  $client_array['groupe_id']; ?>" class=""><i class="fa fa-edit"></i></a>
														
														<a onclick="if(!confirm('Confirmer cette etape')) return false;" href="ajax.php?function=delete_groupe&groupe_id=<?= $client_array["groupe_id"]; ?>"><i  style='' class="fa fa-trash"></i></a>
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