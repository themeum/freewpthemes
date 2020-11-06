jQuery(document).ready(function($){
	'use strict';

	$('.thmc-rgba-colorpicker input[type=text]').thmcWpColorPicker();

	$('.thmc-date-picker input[type=text]').datepicker({
		dateFormat: "yy-mm-dd"
	});
	$('.customize-control-select select').select2();
	$('.thmc-multi-select select').select2({
		tags: true
	});

	$('.thmc-multi-select select').on('change', function () {
		var settingId = $(this).data('customize-setting-link'),
			setting = wp.customize.control(settingId);

		if ($(this).val() == null) {
			setting.setting._value = [];
			setting.previewer.refresh();
		} else {
			setting.setting._value = $(this).val();
			setting.previewer.refresh();
		}
	});

	$('.thmc-switch-button').on('click', '.thmc-switch-ui', function (e) {
		e.preventDefault();

		var currentValue = $(this).parent().find('input:checked').val(),
			settingId = $(this).parent().find('input:checked').data('customize-setting-link'),
			setting = wp.customize.control(settingId);

		$(this).parent().find('input:checked').attr('checked', false);

		if (currentValue == 'on') {
			$(this).parent().find('input[value=off]').attr('checked', true).trigger( 'change' );
			// setting.setting._value = 'off';
			// setting.previewer.refresh();
		} else {
			$(this).parent().find('input[value=on]').attr('checked', true).trigger( 'change' );
			// setting.setting._value = 'on';
			// setting.previewer.refresh();
		}
	});

	$( '.thmc-multi-checkbox input[type="checkbox"]' ).on('change', function () {
		var checkboxValues = $( this ).parents( '.thmc-multi-checkbox' ).find( 'input[type="checkbox"]:checked' ).map(function() { return this.value; }).get().join( ',' );

		$( this ).parents( '.customize-control' ).find( 'input[type=hidden]' ).val( checkboxValues ).trigger( 'change' );
	});


	$('body').on('click', '#tmm-export-data', function (e) {
		e.preventDefault();

		window.location.href = thm_customizer.ajax_url+'?action=thm_export_data';

		// $.ajax({
		// 	url: thm_customizer.ajax_url,
		// 	method: "POST",
		// 	data: {
		// 		'action': 'thm_export_data',
		// 	}
		// });

		

	});

	$('body').on('click', '#tmm-import-data', function (e) {
		e.preventDefault();

		var file_data = $('#tmm-import-data-file').prop('files')[0],
			status = $('#thm-import-status');

		console.log(file_data);

		if (typeof file_data == 'undefined') {

			status.addClass('thm-import-error')
			status.text(thm_customizer.file_error);

			setTimeout(function () {
				status.removeClass('thm-import-error')
				status.text('');
			}, 10000);

			return;
		}

		var form_data = new FormData(); 

		form_data.append('file', file_data);
    	form_data.append('name', file_data.name);
		// form_data.append('file', file_data);
		form_data.append('action', 'thm_import_data');

		

		$.ajax({
			url: thm_customizer.ajax_url,
			cache: false,
            contentType: false,
            processData: false,
			method: "POST",
			data: form_data,
			success: function (html) {
				console.log(html == 1);
				if (html == 1) {
					status.addClass('thm-import-success')
					status.text(thm_customizer.import_success);

					setTimeout(function () {
						location.reload();
					}, 2000);

					

					setTimeout(function () {
						status.removeClass('thm-import-success')
						status.text('');
					}, 10000);
				} else {
					status.addClass('thm-import-error')
					status.text(thm_customizer.import_error);

					setTimeout(function () {
						status.removeClass('thm-import-error')
						status.text('');
					}, 10000);
				}
			},
			error: function () {
				status.addClass('thm-import-error')
				status.text(thm_customizer.import_error);

				setTimeout(function () {
					status.removeClass('thm-import-error')
					status.text('');
				}, 10000);
			}
		});

	});
});