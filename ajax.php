<?php
	require_once('conbase.php');
	
	$query = mysqli_query($con, "SELECT * from emploi_users where user_id = '".$_COOKIE['abgrcs_admin_login']."'");
	
	if( $query->num_rows > 0 )
	{
		$user_array = mysqli_fetch_array($query);
	}
	
	$function = $_GET['function'];
	
	if( $function == "login_admin" )
	{
		$pseudo = $_POST['login_user_prenom'];
		$password = $_POST['login_user_pass'];
		
		$resultat = mysqli_query($con, "select * from emploi_users where user_login = '".$pseudo."' and user_pass = '".$password."'");
		
		if( mysqli_num_rows($resultat) > 0 ){
			
			$user_array = mysqli_fetch_array($resultat);
			
			setcookie("abgrcs_admin_login", $user_array["user_id"], time()+3600, "/");
			
			header('location: index.php');	
		}
		else
		{
			header('location: index.php?msg=error_login');	
		}		
	}
	else if( $function == "logout" )
	{
		setcookie("abgrcs_admin_login", "", time()-3600, "/");
		
		header('location: index.php');
	}	
	else if( $function == "user_add" )
	{
		$departement_id = isset($_POST['departement_id'])? $_POST['departement_id'] : "0";
		$groupe_id = isset($_POST['groupe_id'])? $_POST['groupe_id'] : "0";
		
		$query = mysqli_query($con, "
			INSERT INTO emploi_users
			 (departement_id, groupe_id, user_prenom, user_nom, user_date_naissance, user_email, user_phone, user_login, user_pass, user_type) 
			 
			 values 
			 
			 ( '".$departement_id."', '".$_POST['groupe_id']."', '".$_POST['user_prenom']."', '".$_POST['user_nom']."', '".$_POST['user_date_naissance']."', '".$_POST['user_email']."', '".$_POST['user_phone']."', '".$_POST['user_login']."', '".$_POST['user_pass']."', '".$_POST['user_type']."');
		");
		
		header('location: index.php?users=0');
	}
	else if( $function == "user_edit" )
	{
		$departement_id = isset($_POST['departement_id'])? $_POST['departement_id'] : "0";
		$groupe_id = isset($_POST['groupe_id'])? $_POST['groupe_id'] : "0";
		
		$query = mysqli_query($con, "
			UPDATE emploi_users SET 
				departement_id = '".$departement_id."',
				groupe_id = '".$groupe_id."',
				user_prenom = '".$_POST['user_prenom']."',
				user_nom = '".$_POST['user_nom']."',
				user_date_naissance = '".$_POST['user_date_naissance']."',
				user_email = '".$_POST['user_email']."',
				user_phone = '".$_POST['user_phone']."',
				user_login = '".$_POST['user_login']."',
				user_pass = '".$_POST['user_pass']."',
				user_civilite = '".$_POST['user_civilite']."',
				user_grade = '".$_POST['user_grade']."'
			 WHERE user_id = '".$_GET['user_id']."';
		");
		
		if( $_POST['user_type'] != "" )
		{
			$query = mysqli_query($con, "
				UPDATE emploi_users SET 
					user_type = '".$_POST['user_type']."'
				 WHERE user_id = '".$_GET['user_id']."';
			");
		}
		
		header('location: index.php?users=0');
	}
	else if( $function == "delete_user" )
	{
		$query = mysqli_query($con, "DELETE from emploi_users where user_id = '".$_GET['user_id']."'");
		
		header('location: index.php?users=0');
	}
	else if( $function == "module_add" )
	{
		$query = mysqli_query($con, "
			INSERT INTO emploi_modules
			 (specialite_id, module_nom) values ( '".$_POST['specialite_id']."', '".$_POST['module_nom']."' );
		");
		
		header('location: index.php?modules=0');
	}
	else if( $function == "module_edit" )
	{
		$query = mysqli_query($con, "
			UPDATE emploi_modules SET 
				specialite_id = '".$_POST['specialite_id']."',
				module_nom = '".$_POST['module_nom']."'
			 WHERE module_id = '".$_GET['module_id']."';
		");
		
		header('location: index.php?modules=0');
	}
	else if( $function == "delete_module" )
	{
		$query = mysqli_query($con, "DELETE from emploi_modules where module_id = '".$_GET['module_id']."'");
		
		header('location: index.php?modules=0');
	}
	else if( $function == "specialite_add" )
	{
		$query = mysqli_query($con, "
			INSERT INTO emploi_specialites
			 (specialite_nom, filiere_id, cycle_id) values ( '".$_POST['specialite_nom']."', '".$_POST['filiere_id']."', '".$_POST['cycle_id']."' );
		");
		
		header('location: index.php?specialites=0');
	}
	else if( $function == "specialite_edit" )
	{
		$query = mysqli_query($con, "
			UPDATE emploi_specialites SET 
				specialite_nom = '".$_POST['specialite_nom']."',
				filiere_id = '".$_POST['filiere_id']."',
				cycle_id = '".$_POST['cycle_id']."'
			 WHERE specialite_id = '".$_GET['specialite_id']."';
		");
		
		header('location: index.php?specialites=0');
	}
	else if( $function == "delete_specialite" )
	{
		$query = mysqli_query($con, "DELETE from emploi_specialites where specialite_id = '".$_GET['specialite_id']."'");
		
		header('location: index.php?specialites=0');
	}
	
	else if( $function == "filiere_add" )
	{
		$query = mysqli_query($con, "
			INSERT INTO emploi_filieres
			 (filiere_nom, departement_id) values ( '".$_POST['filiere_nom']."', '".$_POST['departement_id']."' );
		");
		
		header('location: index.php?filieres=0');
	}
	else if( $function == "filiere_edit" )
	{
		$query = mysqli_query($con, "
			UPDATE emploi_filieres SET 
				filiere_nom = '".$_POST['filiere_nom']."',
				departement_id = '".$_POST['departement_id']."'
			 WHERE filiere_id = '".$_GET['filiere_id']."';
		");
		
		header('location: index.php?filieres=0');
	}
	else if( $function == "delete_filiere" )
	{
		$query = mysqli_query($con, "DELETE from emploi_filieres where filiere_id = '".$_GET['filiere_id']."'");
		
		header('location: index.php?filieres=0');
	}
	else if( $function == "departement_add" )
	{
		$query = mysqli_query($con, "
			INSERT INTO emploi_departements
			 (departement_nom) values ( '".$_POST['departement_nom']."' );
		");
		
		header('location: index.php?departements=0');
	}
	else if( $function == "departement_edit" )
	{
		$query = mysqli_query($con, "
			UPDATE emploi_departements SET 
				departement_nom = '".$_POST['departement_nom']."'
			 WHERE departement_id = '".$_GET['departement_id']."';
		");
		
		header('location: index.php?departements=0');
	}
	else if( $function == "delete_departement" )
	{
		$query = mysqli_query($con, "DELETE from emploi_departements where departement_id = '".$_GET['departement_id']."'");
		
		header('location: index.php?departements=0');
	}
	else if( $function == "cycle_add" )
	{
		$query = mysqli_query($con, "
			INSERT INTO emploi_cycles
			 (cycle_nom, cycle_nbr_semstre) values ( '".$_POST['cycle_nom']."', '".$_POST['cycle_nbr_semstre']."' );
		");
		
		header('location: index.php?cycles=0');
	}
	else if( $function == "cycle_edit" )
	{
		$query = mysqli_query($con, "
			UPDATE emploi_cycles SET 
				cycle_nom = '".$_POST['cycle_nom']."',
				cycle_nbr_semstre = '".$_POST['cycle_nbr_semstre']."'
			 WHERE cycle_id = '".$_GET['cycle_id']."';
		");
		
		header('location: index.php?cycles=0');
	}
	else if( $function == "delete_cycle" )
	{
		$query = mysqli_query($con, "DELETE from emploi_cycles where cycle_id = '".$_GET['cycle_id']."'");
		
		header('location: index.php?cycles=0');
	}
	else if( $function == "groupe_add" )
	{
		$query = mysqli_query($con, "
			INSERT INTO emploi_groupes
			 (section_num, specialite_id, groupe_nom) values ( '".$_POST['section_num']."', '".$_POST['specialite_id']."', '".$_POST['groupe_nom']."' );
		");
		
		header('location: index.php?groupes=0');
	}
	else if( $function == "groupe_edit" )
	{
		$query = mysqli_query($con, "
			UPDATE emploi_groupes SET 
				section_num = '".$_POST['section_num']."',
				specialite_id = '".$_POST['specialite_id']."',
				groupe_nom = '".$_POST['groupe_nom']."'
			 WHERE groupe_id = '".$_GET['groupe_id']."';
		");
		
		header('location: index.php?groupes=0');
	}
	else if( $function == "delete_groupe" )
	{
		$query = mysqli_query($con, "DELETE from emploi_groupes where groupe_id = '".$_GET['groupe_id']."'");
		
		header('location: index.php?groupes=0');
	}
	else if( $function == "salle_add" )
	{
		$query = mysqli_query($con, "
			INSERT INTO emploi_salles
			 (salle_nom, salle_capacite, salle_type) values ( '".$_POST['salle_nom']."', '".$_POST['salle_capacite']."', '".$_POST['salle_type']."' );
		");
		
		header('location: index.php?salles=0');
	}
	else if( $function == "salle_edit" )
	{
		$query = mysqli_query($con, "
			UPDATE emploi_salles SET 
				salle_nom = '".$_POST['salle_nom']."',
				salle_capacite = '".$_POST['salle_capacite']."',
				salle_type = '".$_POST['salle_type']."'
			 WHERE salle_id = '".$_GET['salle_id']."';
		");
		
		header('location: index.php?salles=0');
	}
	else if( $function == "delete_salle" )
	{
		$query = mysqli_query($con, "DELETE from emploi_salles where salle_id = '".$_GET['salle_id']."'");
		
		header('location: index.php?salles=0');
	}
	else if( $function == "material_add" )
	{
		$query = mysqli_query($con, "
			INSERT INTO emploi_materials
			 (salle_id, material_nom, material_mat, material_etat) values ( '".$_POST['salle_id']."', '".$_POST['material_nom']."', '".$_POST['material_mat']."', '".$_POST['material_etat']."' );
		");
		
		header('location: index.php?materials=0');
	}
	else if( $function == "material_edit" )
	{
		$query = mysqli_query($con, "
			UPDATE emploi_materials SET 
				salle_id = '".$_POST['salle_id']."',
				material_nom = '".$_POST['material_nom']."',
				material_mat = '".$_POST['material_mat']."',
				material_etat = '".$_POST['material_etat']."'
			 WHERE material_id = '".$_GET['material_id']."';
		");
		
		header('location: index.php?materials=0');
	}
	else if( $function == "delete_material" )
	{
		$query = mysqli_query($con, "DELETE from emploi_materials where material_id = '".$_GET['material_id']."'");
		
		header('location: index.php?materials=0');
	}
	else if( $function == "reclaramation_add" )
	{
		$query = mysqli_query($con, "
			INSERT INTO emploi_reclaramations
			 (reclaramation_sujet, reclaramation_content, reclaramation_date) values ( '".$_POST['reclaramation_sujet']."', '".$_POST['reclaramation_content']."', '".date("Y-m-d H:i:s")."' );
		");
		
		header('location: index.php?reclaramations=0');
	}
	else if( $function == "reclaramation_edit" )
	{
		$query = mysqli_query($con, "
			UPDATE emploi_reclaramations SET 
				reclaramation_sujet = '".$_POST['reclaramation_sujet']."',
				reclaramation_content = '".$_POST['reclaramation_content']."'
			 WHERE reclaramation_id = '".$_GET['reclaramation_id']."';
		");
		
		header('location: index.php?reclaramations=0');
	}
	else if( $function == "delete_reclaramation" )
	{
		$query = mysqli_query($con, "DELETE from emploi_reclaramations where reclaramation_id = '".$_GET['reclaramation_id']."'");
		
		header('location: index.php?reclaramations=0');
	}
	else if( $function == "emploi_add" )
	{
		$query = mysqli_query($con, "
			INSERT INTO emploi_emplois
			 (
				emploi_jour, emploi_temp, enseignant_id, module_id, groupe_id, salle_id, emploi_type, emploi_annee_univ, emploi_semestre
			 ) 
			 values 
			 ( '".$_POST['emploi_jour']."', '".$_POST['emploi_temp']."', '".$_POST['enseignant_id']."', '".$_POST['module_id']."', '".$_POST['groupe_id']."', '".$_POST['salle_id']."', '".$_POST['emploi_type']."', '".$_POST['emploi_annee_univ']."', '".$_POST['emploi_semestre']."' );
		") or die(mysqli_error($con));
		
		header('location: index.php?emplois=0');
	}
	else if( $function == "emploi_edit" )
	{
		$query = mysqli_query($con, "
			UPDATE emploi_emplois SET 
				emploi_jour = '".$_POST['emploi_jour']."',
				emploi_temp = '".$_POST['emploi_temp']."',
				enseignant_id = '".$_POST['enseignant_id']."',
				module_id = '".$_POST['module_id']."',
				groupe_id = '".$_POST['groupe_id']."',
				salle_id = '".$_POST['salle_id']."',
				emploi_type = '".$_POST['emploi_type']."',
				emploi_annee_univ = '".$_POST['emploi_annee_univ']."',
				emploi_semestre = '".$_POST['emploi_semestre']."'
			 WHERE emploi_id = '".$_GET['emploi_id']."';
		");
		
		header('location: index.php?emplois=0');
	}
	else if( $function == "delete_emploi" )
	{
		$query = mysqli_query($con, "DELETE from emploi_emplois where emploi_id = '".$_GET['emploi_id']."'");
		
		header('location: index.php?emplois=0');
	}
	else if( $function == "emplois_edit" )
	{
		$user_id = $_POST["user_id"];
		$absence_val = $_POST["absence_val"];
		$absence_observation = $_POST["absence_observation"];
		
		if( count($user_id) > 0 )
		{
			for( $i = 0; $i < count($user_id); $i++ )
			{
				$query_check = mysqli_query($con, "SELECT * FROM `emploi_absences` where user_id = '".$user_id[$i]."' and emploi_id = '".$_GET["emploi_id"]."' and absence_date = '".$_POST["absence_date"]."'");
				
				if( mysqli_num_rows($query_check) > 0 )
				{
					$query_check = mysqli_query($con, "UPDATE `emploi_absences` SET 
						absence_val = '".$absence_val[$i]."',
						absence_observation = '".$absence_observation[$i]."'
					where user_id = '".$user_id[$i]."' and emploi_id = '".$_GET["emploi_id"]."' and absence_date = '".$_POST["absence_date"]."'");
				}
				else
				{
					$query_check = mysqli_query($con, "INSERT INTO `emploi_absences` (emploi_id, user_id, absence_val, absence_date, absence_observation) values ('".$_GET["emploi_id"]."', '".$user_id[$i]."', '".$absence_val[$i]."', '".$_POST["absence_date"]."', '".$absence_observation[$i]."');");
				}
			}
		}
		
		header("Location: " . $_SERVER['HTTP_REFERER']);
	}
	else if( $function == "annees_add" )
	{
		$query = mysqli_query($con, "
			INSERT INTO emploi_annees
			 (
				annee_nom
			 ) 
			 values 
			 ( '".$_POST['annee_nom']."' );
		");
		
		header('location: index.php?options=0');
	}
	else if( $function == "annees_delete" )
	{
		$query = mysqli_query($con, "DELETE from emploi_annees where annee_id = '".$_GET['annee_id']."'");
		
		header('location: index.php?options=0');
	}
	else if( $function == "cle_add" )
	{
		$query = mysqli_query($con, "
			INSERT INTO emploi_cles
			 (salle_id, user_id, cle_status) values ( '".$_POST['salle_id']."', '".$_POST['user_id']."', '".$_POST['cle_status']."' );
		");
		
		header('location: index.php?keys=0');
	}
	else if( $function == "cle_edit" )
	{
		$query = mysqli_query($con, "
			UPDATE emploi_cles SET 
				cle_status = '".$_POST['cle_status']."',
				salle_id = '".$_POST['salle_id']."',
				user_id = '".$_POST['user_id']."'
			 WHERE cle_id = '".$_GET['cle_id']."';
		");
		
		header('location: index.php?keys=0');
	}
	else if( $function == "delete_key" )
	{
		$query = mysqli_query($con, "DELETE from emploi_cles where cle_id = '".$_GET['cle_id']."'");
		
		header('location: index.php?keys=0');
	}
	else
	{
		header("location: index.php");
	}
 ?>
