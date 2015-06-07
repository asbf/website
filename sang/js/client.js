$(document).ready(function() {
	var result_input = false;

	$('#collecte').change(function(e) {
		var collecte = $('#collecte').val();
		$('input.resultat').each(function(index, element) {
			if($(element).attr('data-collecte-id') == collecte) {
				result_input = $(element);
				$(element).show();
			} else {
				$(element).hide();
			}
		});
	});

	$('#admin').submit(function(e) {
		e.preventDefault();
		var collecte_id = $('#collecte').val();
		var collecte_result = result_input.val();
		$.ajax({
		  url: "admin.php",
		  method: "POST",
		  data : {'update': true, 'collecte_id' : collecte_id, 'collecte_result' : collecte_result}
		}).done(function(msg) {
			console.log(msg);
			$('#admin .flash').text("Mis à jour avec succès.");
			$('#admin .flash').fadeIn("fast");
			var interval = setInterval(function() {
				$('#admin .flash').fadeOut("fast");
				clearInterval(interval);
			}, 1500);
		});
		console.log("collecte: ", collecte_id, "/ résultat: ", collecte_result);
	});
})
