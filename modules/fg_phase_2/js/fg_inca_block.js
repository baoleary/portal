Drupal.behaviors.fg_phase_2_inca_block_form = function(context) {
	function doUpdate(tests, systems, target) {
		if (tests && systems) {
			$.ajax({
				url: Drupal.settings.basePath + 'fg/inca/test/' + tests + '/' + systems + '/ajax',
				dataType: 'json',
				success: function(resp) {
					target.html('<h4>'+resp.title+'</h4>'+resp.test);
				}
			});
		}
	}
	$('.fg-inca-form').each(function() {
		var $form = $(this),
				$testInput = $(':input[name=test_suite]', $form),
				$systemInput = $(':input[name=fg_system]', $form),
				$resultDiv = $('.test-result', $form);
		
		$testInput.bind('change', function() {
			if ($testInput.val() && $systemInput.val()) {
				$resultDiv.html('<span>Loading...</span>');
				doUpdate($testInput.val(), $systemInput.val(), $resultDiv);
			}
		});
		
		$systemInput.bind('change', function() {
			if ($testInput.val() && $systemInput.val()) {
				$resultDiv.html('<span>Loading...</span>');
				doUpdate($testInput.val(), $systemInput.val(), $resultDiv);
			}
		});
		
	});
}