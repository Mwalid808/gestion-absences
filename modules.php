<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Modules <a href="index.php?modules_add=0" class="btn btn-success">Ajouter</a></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
              <li class="breadcrumb-item active">Modules</li>
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
                <h3 class="card-title">Modules</h3>

                <div class="card-tools form-inline">
                  <form method="GET" class="form-inline">
						<input type="hidden" name="modules" value="0" />
						
						<div class="form-group input-group-sm">
							<select class="form-control" name="specialite_id" id="specialite_id" onchange="submit();">
								<option value='0'>Tout</option>
								<?php
									$query = mysqli_query($con, "SELECT * from emploi_specialites");
									
									if( $query->num_rows > 0 )
									{
										while( $module_array_1 = mysqli_fetch_array($query) )
										{
											echo('
												<option value="'.$module_array_1["specialite_id"].'" '.selected($module_array_1['specialite_id'], $_GET["specialite_id"]).'>'.$module_array_1["specialite_nom"].'</option>
											');
										}
									}
								?>
							</select>
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
                      <th>Spécialité</th>
                      <th>Nom</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
					<?php
						$condition = "1";
						
						$specialite_id_cond = "1";
						
						if( isset($_GET["specialite_id"]) )
						{
							if( !empty($_GET["specialite_id"]) )
							{
								$specialite_id_cond = "specialite_id = '".$_GET["specialite_id"]."'";
							}
						}
						
						$select_spe = "(SELECT specialite_nom from emploi_specialites where emploi_specialites.specialite_id = emploi_modules.specialite_id) as specialite_nom";
						
						$query=mysqli_query($con, "SELECT *, ".$select_spe." from emploi_modules where ".$condition." and ".$specialite_id_cond."");
						
						if( $query->num_rows > 0 )
						{
							while($client_array=mysqli_fetch_array($query))
							{
								?>
									<tr>
										<td><?= $client_array["module_id"]; ?></td>
										<td><?= $client_array["specialite_nom"]; ?></td>
										<td><?= $client_array["module_nom"]; ?></td>
										<td>
											<?php
												if( true )
												{
													?>
														<a href="<?php print $index_page;?>?modules_add=<?php print  $client_array['module_id']; ?>" class=""><i class="fa fa-edit"></i></a>
														
														<a onclick="if(!confirm('Confirmer cette etape')) return false;" href="ajax.php?function=delete_module&module_id=<?= $client_array["module_id"]; ?>"><i  style='' class="fa fa-trash"></i></a>
													<?php
												}
											?>
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