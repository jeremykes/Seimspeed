$(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
});

function loadCarModels(make,url) {
	$.ajax({
		type: 'POST',
		url: url,
		data: {
			make: make,
		},
		dataType: 'json',
		success: function(data) {
			carmodels = data;
			initCarModelAutocomplete();
		}
	});
}

function initCarModelAutocomplete() {
	$(".carmodelautocomplete").autocomplete({
        source: carmodels,
        minLength: 2
    });
}

