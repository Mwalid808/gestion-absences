<?php
	$title_produit = "Ajouter";
	$function_to_call = "reclaramation_add";
	
	if( $_GET['reclaramations_add'] != 0 )
	{
		$element_array_rows = mysqli_query($con, "select * from emploi_reclaramations where reclaramation_id = '".$_GET['reclaramations_add']."'");
		$element_array = mysqli_fetch_array($element_array_rows);
		$title_produit = "Modifier";
		$function_to_call = "reclaramation_edit&reclaramation_id=".$_GET['reclaramations_add'];
	}
?>

<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>reclaramations</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php"><?= "Accueil"; ?></a></li>
						<li class="breadcrumb-item"><a href="index.php?reclaramations=0">reclaramations</a></li>
						<li class="breadcrumb-item active">nouveau</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><?= $title_produit; ?></h3>
						</div>
						<div class="card-body">
							<form action="ajax.php?function=<?= $function_to_call; ?>" method="POST" role="form" enctype="multipart/form-data">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Sujet</label>
											<input type="text" class="form-control" id="reclaramation_sujet" name="reclaramation_sujet" placeholder="Sujet ..." value="<?= $element_array["reclaramation_sujet"]; ?>" />
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>content</label>
											<input type="text" class="form-control" id="reclaramation_content" name="reclaramation_content" placeholder="content ..." value="<?= $element_array["reclaramation_content"]; ?>" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group" style="text-align:right;">
											<a href="index.php?reclaramations=0" class="btn btn-default">Cancel</a>
											<button type="submit" class="btn btn-success"><?= $title_produit; ?></button>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="card-footer">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>