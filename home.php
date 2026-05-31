<?php
	
?>

<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Accueil</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item active">Accueil</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<section class="content">
		<div class="container-fluid">
			<?php
				if( $user_array["user_type"] == "enseignant" )
				{
					?>
						
					<?php
				}
				else if( $user_array["user_type"] == "etudiant" )
				{
					?>
						
					<?php
				}
				else if( $user_array["user_type"] == "technicien" )
				{
					?>
						
					<?php
				}
				else
				{
					?>
						<div class="row">
							<div class="col-lg-3 col-6">
								<div class="small-box bg-info">
									<div class="inner">
										<h3><?php echo mysqli_num_rows(mysqli_query($con, "SELECT * from emploi_departements")); ?></h3>
										<p>Départements</p>
									</div>
									<div class="icon">
										<i class="fas fa-bars"></i>
									</div>
									<a href="index.php?departements=0" class="small-box-footer">Voir tout <i class="fas fa-arrow-circle-right"></i></a>
								</div>
							</div>
							<div class="col-lg-3 col-6">
								<div class="small-box bg-info">
									<div class="inner">
										<h3><?php echo mysqli_num_rows(mysqli_query($con, "SELECT * from emploi_specialites")); ?></h3>
										<p>Spécialités</p>
									</div>
									<div class="icon">
										<i class="fas fa-bars"></i>
									</div>
									<a href="index.php?specialites=0" class="small-box-footer">Voir tout <i class="fas fa-arrow-circle-right"></i></a>
								</div>
							</div>
							<div class="col-lg-3 col-6">
								<div class="small-box bg-info">
									<div class="inner">
										<h3><?php echo mysqli_num_rows(mysqli_query($con, "SELECT * from emploi_users")); ?></h3>
										<p>Utilisateurs</p>
									</div>
									<div class="icon">
										<i class="fas fa-users"></i>
									</div>
									<a href="index.php?users=0" class="small-box-footer">Voir tout <i class="fas fa-arrow-circle-right"></i></a>
								</div>
							</div>
							<div class="col-lg-3 col-6">
								<div class="small-box bg-info">
									<div class="inner">
										<h3><?php echo mysqli_num_rows(mysqli_query($con, "SELECT * from emploi_modules")); ?></h3>
										<p>Modules</p>
									</div>
									<div class="icon">
										<i class="fas fa-book"></i>
									</div>
									<a href="index.php?modules=0" class="small-box-footer">Voir tout <i class="fas fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>
					<?php
				}
			?>
			<div class="row">
				<div class="col-12">
					<!--
					<div style="text-align:center;"><img src="uploads/logo.jpg" /></div>
					-->
				</div>
			</div>
		</div>
	</section>
</div>