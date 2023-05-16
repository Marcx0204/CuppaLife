<!DOCTYPE HTML>
<html>
	<head>
		<title>Produkte</title>
        <?php
			include 'head.php';
		?>

	<body>
		<!---start-wrap---->

        <header>
			<?php 
				include 'navbar.php';
			?>
		</header>
    <div>
        <li>Produkt 1  <a href="#" data-product-id="product1" class="addToCartLink">In Warenkorb</a></li>
        <li>Produkt 2</li>
        <li>Produkt 3</li>
        <li>Produkt 4</li>
    </div>


</body>

<footer>
<?php
				include 'footer.php';
			?>
</footer>

</html>

<script>
    // Angenommen, Sie haben eine Funktion, die ein Produkt zum Warenkorb hinzufügt
function addToCart(productId) {
  // AJAX-Anforderung an den Server senden
  $.ajax({
    url: "/cart/add",  // Die URL des Server-Endpunkts, der den Warenkorb aktualisiert
    type: "POST",  // HTTP-Methode
    data: { id: productId },  // Die Daten, die an den Server gesendet werden
    success: function(response) {
      // Bei erfolgreicher Anfrage können Sie eine Bestätigung anzeigen oder den Warenkorb auf der Seite aktualisieren
      console.log("Produkt wurde zum Warenkorb hinzugefügt");
    },
    error: function(jqXHR, textStatus, errorThrown) {
      // Bei Fehlern können Sie eine Fehlermeldung anzeigen
      console.log("Fehler beim Hinzufügen des Produkts zum Warenkorb: ", errorThrown);
    }
  });
}

// Sie könnten einen Event-Handler hinzufügen, der auf Klicks auf Ihre "In den Warenkorb legen"-Links reagiert
$(".addToCartLink").on("click", function(e) {
  e.preventDefault();  // Das normale Verhalten des Links verhindern
  var productId = $(this).data("productId");  // Die Produkt-ID aus den Datenattributen des Links holen
  addToCart(productId);  // Die Funktion zum Hinzufügen zum Warenkorb aufrufen
});
</script>