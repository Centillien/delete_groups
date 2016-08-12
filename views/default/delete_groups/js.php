//<script>

elgg.provide('elgg.delete_groups');

elgg.delete_groups.init = function() {
	$('#delete_groups-checkall').click(function() {
		$('#delete_groups-form .elgg-body').find('input[type=checkbox]').prop('checked', this.checked);
	});

	$('.delete_groups-submit').click(function(event) {
		var form = $('#delete_groups-form')[0];
		event.preventDefault();

		// check if there are selected users
		if ($('.elgg-body', form).find('input[type=checkbox]:checked').length < 1) {
			return false;
		}

		// confirmation
		if (!confirm(this.title)) {
			return false;
		}

		form.action = this.href;
		form.submit();
	});
};

elgg.register_hook_handler('init', 'system', elgg.delete_groups.init);
