<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
	  <li class="nav-item">
		<a class="nav-link" data-widget="pushmenu" href="index.php" role="button"><i class="fas fa-bars"></i></a>
	  </li>
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
	  <li class="nav-item dropdown">
		<a class="nav-link" data-toggle="dropdown" href="#">
		  <i class="far fa-user"></i>
		</a>
		<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
		  <!-- Notifications Dropdown Menu --
		  <a href="#" class="dropdown-item">
			<i class="fas fa-envelope mr-2"></i> 4 new messages
			<span class="float-right text-muted text-sm">3 mins</span>
		  </a>
		  <!-- Notifications Dropdown Menu -->
		  <div class="dropdown-divider"></div>
		  <a href="index.php?users_add=<?= $user_array["user_id"]; ?>" class="dropdown-item dropdown-footer">Modifier Mon Profile</a>
		  <a href="ajax.php?function=logout" class="dropdown-item dropdown-footer">Déconnexion</a>
		</div>
	  </li>
	</ul>
  </nav>
  <!-- /.navbar -->