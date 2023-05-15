<!DOCTYPE html>
<html>
<head>
	<title>Kontakt</title>
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

	<div id="contact" class="contact-area section-padding mt-3">
		<div class="container">										
			<div class="section-title text-center">
				<h1>Haben sie Fragen ?</h1>
				<p>Dann füllen Sie gerne unser Kontakformular aus oder Kontaktieren Sie einen unserer Mitarbeiter auf eine der verschiedenen Möglichkeiten!</p>
			</div>					
			<div class="row">
				<div class="col-lg-7">	
					<div class="contact">
						<form class="form" name="enq" method="post" action="contact.php" onsubmit="return validation();">
							<div class="row">
								<div class="form-group col-md-6">
									<input type="text" name="name" class="form-control" placeholder="Name" required="required">
								</div>
								<div class="form-group col-md-6">
									<input type="email" name="email" class="form-control" placeholder="Email" required="required">
								</div>
								<div class="form-group col-md-12">
									<input type="text" name="subject" class="form-control" placeholder="Subject" required="required">
								</div>
								<div class="form-group col-md-12">
									<textarea rows="6" name="message" class="form-control" placeholder="Your Message" required="required"></textarea>
								</div>
								<div class="col-md-12 text-center">
									<button type="submit" value="Send message" name="submit" id="submitButton" class="btn" title="Submit Your Message!">Send Message</button>
								</div>
							</div>
						</form>
					</div>
				</div><!--- END COL --> 
				<div class="col-lg-5">
					<div class="single_address">
						<i class="fa fa-map-marker"></i>
						<h4>Unsere Adresse</h4>
						<p>Hochstädtplatz 5, Wien, Östereich</p>
					</div>
					<div class="single_address">
						<i class="fa fa-envelope"></i>
						<h4>Senden Sie Ihre Nachricht</h4>
						<p>Info@cuppalife.com</p>
					</div>
					<div class="single_address">
						<i class="fa fa-phone"></i>
						<h4>Rufen Sie uns an</h4>
						<p>(+43) 517 397 7100</p>
					</div>
					<div class="single_address">
						<i class="fa fa-clock-o"></i>
						<h4>Öffnungszeiten</h4>
						<p>Mo - Fr: 08.00 - 16.00 Uhr<br>Sa: 10.00 - 14.00 Uhr</p>
					</div>					
				</div><!--- END COL --> 
			

		</div><!--- END ROW -->
	</div><!--- END CONTAINER -->	
</div>
			
		</main>
		<footer>
			<?php
				include 'footer.php';
			?>
		</footer>
	</body>
</html>