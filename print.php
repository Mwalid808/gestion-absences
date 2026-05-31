<?php
	require_once("conbase.php");
	require('tcpdf/tcpdf.php');
	$pdf = null;
	
	$query=mysqli_query($con, "SELECT * from emploi_users where user_id = '".$_COOKIE['abgrcs_admin_login']."'");
	
	if( $query->num_rows > 0 )
	{
		$user_array = mysqli_fetch_array($query);
	}
	else
	{
		include("login.php");
		exit();
	}
	
	function get_seance($emploi_jour, $emploi_temp, $emploi_semestre)
	{
		global $con, $user_array;
		
		if( $user_array["user_type"] == "enseignant" )
		{
			$query = mysqli_query($con, "SELECT * from emploi_emplois where enseignant_id = '".$user_array["user_id"]."' and emploi_temp = '".$emploi_temp."' and emploi_jour = '".$emploi_jour."' and emploi_annee_univ = '".$_GET["annee_nom"]."' and emploi_semestre = '".$emploi_semestre."'");
		
			if( $query->num_rows > 0 )
			{
				$emplois_array = mysqli_fetch_array($query);
				
				$type = "bg-success";
				if($emplois_array["emploi_type"] == "td" )
					$type = "bg-primary";
				else if($emplois_array["emploi_type"] == "tp" )
					$type = "bg-danger";
				
				$user_array = mysqli_fetch_array(mysqli_query($con, "SELECT * from emploi_users where user_id = '".$emplois_array['enseignant_id']."'"));
				$module_array = mysqli_fetch_array(mysqli_query($con, "SELECT * from emploi_modules where module_id = '".$emplois_array['module_id']."'"));
				$salle_array = mysqli_fetch_array(mysqli_query($con, "SELECT * from emploi_salles where salle_id = '".$emplois_array['salle_id']."'"));
				
				return "<div class='".$type."'>".$module_array['module_nom']."</div><br />".$salle_array['salle_nom'];
			}
		}
		else if( $user_array["user_type"] == "etudiant" )
		{
			$query = mysqli_query($con, "SELECT * from emploi_emplois where groupe_id = '".$user_array["groupe_id"]."' and emploi_temp = '".$emploi_temp."' and emploi_jour = '".$emploi_jour."' and emploi_annee_univ = '".$_GET["annee_nom"]."' and emploi_semestre = '".$emploi_semestre."'");
		
			if( $query->num_rows > 0 )
			{
				$emplois_array = mysqli_fetch_array($query);
				
				$type = "bg-success";
				if($emplois_array["emploi_type"] == "td" )
					$type = "bg-primary";
				else if($emplois_array["emploi_type"] == "tp" )
					$type = "bg-danger";
				
				$module_array = mysqli_fetch_array(mysqli_query($con, "SELECT * from emploi_modules where module_id = '".$emplois_array['module_id']."'"));
				$salle_array = mysqli_fetch_array(mysqli_query($con, "SELECT * from emploi_salles where salle_id = '".$emplois_array['salle_id']."'"));
				
				return "<div class='".$type."'>".$module_array['module_nom']."</div><br />".$salle_array['salle_nom'];
			}
		}
		else
		{
			$query = mysqli_query($con, "SELECT * from emploi_emplois where emploi_temp = '".$emploi_temp."' and emploi_jour = '".$emploi_jour."' and emploi_semestre = '".$emploi_semestre."' and emploi_annee_univ = '".$_GET["annee_nom"]."' and groupe_id in (select groupe_id from emploi_groupes where specialite_id = '".$_GET['id']."')");
			
			$result = "";
			if( $query->num_rows > 0 )
			{
				while($emplois_array = mysqli_fetch_array($query))
				{
					/*  */
					$user_array_0 = mysqli_fetch_array(mysqli_query($con, "SELECT * from emploi_users where user_id = '".$emplois_array['enseignant_id']."'"));
					$module_array = mysqli_fetch_array(mysqli_query($con, "SELECT * from emploi_modules where module_id = '".$emplois_array['module_id']."'"));
					$salle_array = mysqli_fetch_array(mysqli_query($con, "SELECT * from emploi_salles where salle_id = '".$emplois_array['salle_id']."'"));
					
					$type = "bg-success";
					if($emplois_array["emploi_type"] == "td" )
						$type = "bg-primary";
					else if($emplois_array["emploi_type"] == "tp" )
						$type = "bg-danger";
					
					$result .= "<div class='".$type."'>".$module_array['module_nom']."</div><br /> ".$salle_array["salle_nom"]."<br />Groupe ".$emplois_array["groupe_id"]."<br />".$user_array_0["user_nom"]." ".$user_array_0["user_nom"];
				}
			}
		}
		
		return $result;
	}
	
	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('');
	$pdf->SetTitle('Emplois de temp');
	$pdf->SetSubject('');
	$pdf->SetKeywords('contrat, guide');

	// set default header data
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 018', PDF_HEADER_STRING);

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	// $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, 5, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language dependent data:
	$lg = Array();
	$lg['a_meta_charset'] = 'UTF-8';
	$lg['a_meta_dir'] = 'rtl';
	$lg['a_meta_language'] = 'fa';
	//$lg['w_page'] = 'page';

	// set some language-dependent strings (optional)
	$pdf->setLanguageArray($lg);

	// ---------------------------------------------------------
	
	// set font
	$pdf->SetFont('dejavusans', '', 12);

	// add a page
	$pdf->AddPage();

	// set LTR direction for english translation
	$pdf->setRTL(false);

	$pdf->SetFontSize(10);

	// print newline
	$pdf->Ln();

	// Restore RTL direction
	$pdf->setRTL(false);

	// set font
	$pdf->SetFont('aefurat', '', 12);

	// print newline
	$pdf->Ln();

	// Header
	// -----------------------------------------------------------------------------
	
	if( $user_array["user_type"] == "enseignant" )
	{
		
		$group_enseignant = '<br />Enseignant: '.$user_array['user_nom'].' '.$user_array['user_prenom'].'<br />';
	}
	else if( $user_array["user_type"] == "etudiant" )
	{
		$speciality_array = mysqli_fetch_array(mysqli_query($con, "SELECT * from emploi_specialites where specialite_id = '".$user_array['specialite_id']."'"));
		$filire_array = mysqli_fetch_array(mysqli_query($con, "SELECT * from emploi_filieres where filiere_id = '".$user_array['filiere_id']."'"));
		$departement_array = mysqli_fetch_array(mysqli_query($con, "SELECT * from emploi_departements where departement_id = '".$user_array['departement_id']."'"));
		
		$group_etudiant = '<br />Groupe: '.$user_array['groupe_id'].'';
	}
	else
	{
		$speciality_array = mysqli_fetch_array(mysqli_query($con, "SELECT * from emploi_specialites where specialite_id = '".$_GET['id']."'"));
		$filire_array = mysqli_fetch_array(mysqli_query($con, "SELECT * from emploi_filieres where filiere_id = '".$speciality_array['filiere_id']."'"));
		$departement_array = mysqli_fetch_array(mysqli_query($con, "SELECT * from emploi_departements where departement_id = '".$filire_array['departement_id']."'"));
	}
	
	$pdf->writeHTML('<table width="100%" cellpadding="0" border="0">
		<tr>
			<td style="" width="100%" align="center">
				Ministère de l\'enseignement supérieur et de la recherche scientifique
				<br />
				Universite
			</td>
			<td style="text-align:right;">
				<img width="100px" src="uploads/image1.png" />
			</td>
		</tr>
		<tr>
			<td rowspan="2">
				'.$group_enseignant.'
				Departement: '.$departement_array['departement_nom'].'<br />
				Specialité: '.$speciality_array['specialite_nom'].'<br />
				Semestre: '.$_GET['semstre'].'
				'.$group_etudiant.'
			</td>
		</tr>
	</table><br />', true, false, false, false, '');
	
	$resultat = "";
	
	$list_days = array("Dimanch", "Lundi", "Mardi", "Mercredi", "Jeudi");
	
	foreach( $list_days as $single_value )
	{
		$resultat .= '
			<tr>
				<td align="center"> '.$single_value.'</td>
				<td align="center"> '.get_seance($single_value, "08:30-10:00", $_GET["semstre"]).'</td>
				<td align="center"> '.get_seance($single_value, "10:00-11:30", $_GET["semstre"]).'</td>
				<td align="center"> '.get_seance($single_value, "11:30-13:00", $_GET["semstre"]).'</td>
				<td align="center"> '.get_seance($single_value, "13:00-14:30", $_GET["semstre"]).'</td>
				<td align="center"> '.get_seance($single_value, "14:30-16:00", $_GET["semstre"]).'</td>
				<td align="center"> '.get_seance($single_value, "16:00-17:30", $_GET["semstre"]).'</td>
			</tr>
		';
	}
	
	$pdf->writeHTML('
		<table width="100%" cellpadding="0" border="1">
			<tr>
				<td align="center"> Jour</td>
				<td align="center"> Séance I <br /> 08:30-10:00</td>
				<td align="center"> Séance II <br /> 10:00-11:30</td>
				<td align="center"> Séance III <br /> 11:30-13:00</td>
				<td align="center"> Séance IV <br /> 13:00-14:30</td>
				<td align="center"> Séance V <br /> 14:30-16:00</td>
				<td align="center"> Séance VI <br /> 16:00-17:30</td>
			</tr>
			'.$resultat.'
		</table>
	');
	
	// set LTR direction for english translation
	$pdf->setRTL(false);

	//Close and output PDF document
	$pdf->Output('example_018.pdf', 'I');
?>