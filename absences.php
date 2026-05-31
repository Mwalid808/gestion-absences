<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Absences</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
              <li class="breadcrumb-item active">Absences</li>
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
                <h3 class="card-title">Absences</h3>

                <div class="card-tools">
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-striped ">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>absence sujet</th>
                      <th>absence content</th>
                      <th>absence date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
					<?php
						$query = mysqli_query($con, "SELECT * from emploi_absences");
						
						if( $query->num_rows > 0 )
						{
							while($client_array = mysqli_fetch_array($query))
							{
								?>
									<tr>
										<td><?= $client_array["absence_id"]; ?></td>
										<td><?= $client_array["absence_sujet"]; ?></td>
										<td><?= $client_array["absence_content"]; ?></td>
										<td><?= $client_array["absence_date"]; ?></td>
										<td>
											<?php
												if( true )
												{
													?>
														<a href="<?php print $index_page;?>?absences_add=<?php print  $client_array['absence_id']; ?>" class=""><i class="fa fa-edit"></i></a>
														
														<a onclick="if(!confirm('Confirmer cette etape')) return false;" href="ajax.php?function=delete_absence&absence_id=<?= $client_array["absence_id"]; ?>"><i  style='' class="fa fa-trash"></i></a>
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