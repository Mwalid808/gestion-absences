<!-- Main Sidebar Container -->
		  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: rgba(0,0,0,.87)">
			<!-- Brand Logo -->
			<a href="index.php" class="brand-link" style="text-align: center;">
			  <!-- Brand Logo -->
			  <span class="brand-text font-weight-light">Gestion Absences</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
			  <!-- Sidebar user panel (optional) -->
			  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="info">
				  <a href="index.php" class="d-block"><?= $user_array["user_prenom"]." ".$user_array["user_prenom"]; ?></a>
				</div>
			  </div>
			  
			  <?php
					$menu_array = array(
						array(
							'name'					=>		"Accueil",
							'icon'					=>		'fas fa-tachometer-alt',
							'lien'					=>		'index.php',
							'condition'				=>		'1',
							'sub_menu'				=>		'false',
						),
						array(
							'name'					=>		"Départements",
							'icon'					=>		'fas fa-bars nav-icon',
							'lien'					=>		'index.php?departements=0',
							'condition'				=>		( in_array($user_array["user_type"], array("admin1")) ),
							'sub_menu'				=>		'false',
						),
						array(
							'name'					=>		"Filière",
							'icon'					=>		'fas fa-bars nav-icon',
							'lien'					=>		'index.php?filieres=0',
							'condition'				=>		( in_array($user_array["user_type"], array("admin")) ),
							'sub_menu'				=>		'false',
						),
						array(
							'name'					=>		"Spécialités",
							'icon'					=>		'fas fa-bars nav-icon',
							'lien'					=>		'index.php?specialites=0',
							'condition'				=>		( in_array($user_array["user_type"], array("admin")) ),
							'sub_menu'				=>		'false',
						),
						array(
							'name'					=>		"Salles",
							'icon'					=>		'fas fa-layer-group nav-icon',
							'lien'					=>		'index.php?salles=0',
							'condition'				=>		 ( in_array($user_array["user_type"], array("admin")) ),
							'sub_menu'				=>		'false',
						),
						array(
							'name'					=>		"Groupes",
							'icon'					=>		'fas fa-layer-group nav-icon',
							'lien'					=>		'index.php?groupes=0',
							'condition'				=>		( in_array($user_array["user_type"], array("admin")) ),
							'sub_menu'				=>		'false',
							'sub_menu_array'		=>		array(),
						),
						array(
							'name'					=>		"Emplois",
							'icon'					=>		'fas fa-table nav-icon',
							'lien'					=>		'index.php?emplois=0',
							'condition'				=>		( in_array($user_array["user_type"], array("admin", "enseignant", "etudiant")) ),
							'sub_menu'				=>		'false',
						),
						array(
							'name'					=>		"Modules",
							'icon'					=>		'fas fa-book nav-icon',
							'lien'					=>		'index.php?modules=0',
							'condition'				=>		( in_array($user_array["user_type"], array("admin")) ),
							'sub_menu'				=>		'false',
						),
						array(
							'name'					=>		"Clés",
							'icon'					=>		'fas fa-key nav-icon',
							'lien'					=>		'index.php?keys=0',
							'condition'				=>		( in_array($user_array["user_type"], array("admin1", "agent")) ),
							'sub_menu'				=>		'false',
						),
						array(
							'name'					=>		"Materials",
							'icon'					=>		'far fa-window-restore',
							'lien'					=>		'index.php?materials=0',
							'condition'				=>		( in_array($user_array["user_type"], array("admin1", "technicien")) ),
							'sub_menu'				=>		'false',
						),
						array(
							'name'					=>		"Reclaramations",
							'icon'					=>		'far fa-envelope',
							'lien'					=>		'index.php?reclaramations=0',
							'condition'				=>		( in_array($user_array["user_type"], array("admin", "technicien")) ),
							'sub_menu'				=>		'false',
						),
						array(
							'name'					=>		"Gestion Absences",
							'icon'					=>		'fas fa-calendar-times',
							'lien'					=>		'index.php?absences=0',
							'condition'				=>		( in_array($user_array["user_type"], array("admin", "technicien")) ),
							'sub_menu'				=>		'false',
						),
						array(
							'name'					=>		"Utilisateurs",
							'icon'					=>		'fas fa-users nav-icon',
							'lien'					=>		'index.php?users=0',
							'condition'				=>		( in_array($user_array["user_type"], array("admin")) ),
							'sub_menu'				=>		'false',
						),
					);
				?>
				
				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<?php
							foreach( $menu_array as $single_value )
							{
								if( $single_value["condition"] == "1" )
								{
									?>
										<li class="nav-item <?= ($single_value["sub_menu"] == "true") ? "has-treeview": ""; ?>">
											<a href="<?= $single_value["lien"]; ?>" class="nav-link">
												<i class="nav-icon <?= $single_value["icon"]; ?>"></i>
												<p><?= $single_value["name"]; echo ( $single_value["sub_menu"] == "true" ) ? '<i class="fas fa-angle-left right"></i>': ""; ?></p>
											</a>
											<?php
												if( $single_value["sub_menu"] == "true" )
												{
													?>
														<ul class="nav nav-treeview">
															<?php
																foreach( $single_value["sub_menu_array"] as $sub_single_value )
																{
																	if( $sub_single_value["condition"] == "1" )
																	{
																		?>
																			<li class="nav-item">
																				<a href="<?= $sub_single_value["lien"]; ?>" class="nav-link">
																					<i class="nav-icon <?= $sub_single_value["icon"]; ?>"></i>
																					<p><?= $sub_single_value["name"]; ?></p>
																				</a>
																			</li>
																		<?php
																	}
																}
															?>
														</ul>
													<?php
												}
											?>
										</li>
									<?php
								}
							}
						?>
						
						<?php
							if( $user_array["user_type"] == "admin" )
							{
								?>
									
								<?php
							}
						?>

						<?php
							if( $user_array["user_type"] == "admin" )
							{
								?>
									
								<?php
							}
						?>
						
						<?php
							if( $user_array["user_type"] == "admin" )
							{
								?>
									
								<?php
							}
						?>
					</ul>
				</nav>
			  <!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		  </aside>
