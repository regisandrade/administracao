$(document).ready(function() {
	$("#listagem").tableSorter({
		sortColumn: 'Descrição',
		sortClassAsc: 'headerSortUp',
		sortClassDesc: 'headerSortDown',
		headerClass: 'header',
		highlightClass: 'highlightColumn',
		rowHighlightClass: 'highlightRow',
		stripingRowClass: ['corsim','cornao'],
		stripeRowsOnStartUp: true
	});
	$('#listagem tbody tr td.busca').quicksearch({
		hideElement: 'parent',
		position: 'prepend',
		attached: '#busca',
		focusOnLoad: true,
		stripeRowClass: ['corsim','cornao'],
		loaderText: 'Aguarde...',
		labelText: 'Pesquise pelo Nome:'
	});
});