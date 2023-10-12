<?php
require_once "../php/functions/gs_employes.php";
$id = str_replace("id=", "", $urlParts["query"]);
$dossiers = getDossiersBy("id", $id);
?>


<!doctype html>
<html lang="en">

<head>
	<title>Table 02</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="../table-02/css/style.css">

</head>

<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Documents de l'employé</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table">
							<thead class="thead-dark">
								<tr>
									<th>Titres</th>
									<th>Données</th>

									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($dossiers as $key => $value) : ?>
									<?php if ($value !== "" && $value !== null) : ?>
										<tr class="alert" role="alert">
											<?php if ($key !== "id") : ?>
												<th scope="row"><?= ucfirst(str_replace("_"," ",$key)) ?></th>
												<td><?= $value ?></td>
												<?php if ($key !== "numero_securite_sociale") : ?>
													<td>
														<a data-id=<?= $key ?> href="#" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true"><i class="fa fa-close"></i></span>
														</a>
													</td>
												<?php endif; ?>
											<?php endif; ?>
										</tr>
									<?php else : ?>
										<tr class="alert" role="alert">
											<?php if ($key !== "id") : ?>
												<th scope="row"><?= ucfirst(str_replace("_"," ",$key)) ?></th>
												<td style="color: red;">Aucun fichier disponible!</td>
											<?php endif; ?>
										</tr>
									<?php endif; ?>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>