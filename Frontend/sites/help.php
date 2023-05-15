<!DOCTYPE html>
<html lang="de-AT">
	<head>
		<title>Help</title>

		<?php
			include 'head.php';
		?>
	</head>
	<body>
		<header>
			<?php 
				include 'navbar.php';
			?>
		</header>
		<main>
			<!--Section: FAQ; original code from https://mdbootstrap.com/docs/standard/extended/faq/ -->
			<section>
				<h2 class="text-center mt-5 mb-4 pb-2 text-primary fw-bold">Hilfe Seite FAQ</h2>
				<h3 class="text-center mb-5">Bekommen Sie eine Antwort auf die meist gestelltesten Fragen</h3>
				<div class="row m-0">
					<div class="col-md-6 col-lg-4 mb-4">
				  		<h5 class="mb-3 text-primary mx-4">
							Wie kann ich das Impressum erreichen?
						</h5>
				  		<p class="mx-4">
							Das impressum ist von jeder Seite gut über die Fußleiste erreichbar. Scrollen Sie einfach bis zum Ende einer beliebigen Seite
							und Klicken sie unten auf der Fußleiste auf Impressum.
						</p>
					</div>
					<div class="col-md-6 col-lg-4 mb-4">
					<h5 class="mb-3 text-primary mx-4">
							Wie kann ich mich Registrieren falls ich noch kein Konto besitze?
						</h5>
				  		<p class="mx-4">
						  	Sie habe die Möglichtkeit oben in der Navigationsleiste auf Registireren zu klicken 
							oder klicken Sie <a href= "#" data-bs-toggle="modal" data-bs-target="#reg-modal-register"><strong><u>hier</u></strong></a>
						   	um sich zu Registrieren.
							
				  		</p>
					</div>

					<div class="col-md-6 col-lg-4 mb-4">
				  		<h5 class="mb-3 text-primary mx-4">
							Wie kann ich mich Anmelden, wenn ich mich schon registriert habe?
				  		</h5>
				  		<p class="mx-4">
						  	Sie habe die Möglichtkeit oben in der Navigationsleiste auf Anmelden zu klicken 
							oder klicken Sie <a href= "#" data-bs-toggle="modal" data-bs-target="#reg-modal-login"><strong><u>hier</u></strong></a>
						   	um sich anzumelden.
						</p>
					</div>

					<div class="col-md-6 col-lg-4 mb-4 ">
						<h5 class="mb-3 text-primary mx-4">Wo kann ich meine Ski/Snowboard verstauen?
						</h5>
				  		<p class="mx-4">
							Für das sichere verwahren ihrer Skiausrüstung haben wir einen extra Skiraum. Dieser wird nachts abgeschlossen
							und ist Rund um die Uhr Videoüberwacht. 
				  		</p>
					</div>

					<div class="col-md-6 col-lg-4 mb-4">
				  		<h5 class="mb-3 text-primary mx-4">
							Gibt es Kriterien für die Wahl meines Benutzernamens?
				 		</h5>
				  		<p class="mx-4">
							Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni tempora quae 
							voluptatum provident fugit accusantium. Rem ea ut ipsam cumque reprehenderit dolore inventore
						</p>
					</div>

					<div class="col-md-6 col-lg-4 mb-4">
				  		<h5 class="mb-3 text-primary mx-4">Kann jeder User einen Blogbeitrag erstellen?
						</h5>
				  		<p class="mx-4">
							Nein, nur ein Admin hat die rechte Blogbeiträge hinzuzufügen. Als User können nur die erstellten 
							Blogbeiträge eingesehen werden.
				  		</p>
					</div>
			  	</div>
			</section>
			<!--Section: FAQ-->
		</main>
		<footer>
			<?php
				include 'footer.php';
			?>
		</footer>
	</body>
</html>