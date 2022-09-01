document
	.getElementById('advancedSearch')
	.addEventListener('click', showAdvanced);

function showAdvanced() {
	var btn = document.getElementById('advancedBar');
	if (btn.style.display === 'none') {
		btn.style.display = 'grid';
	} else {
		btn.style.display = 'none';
	}
}
