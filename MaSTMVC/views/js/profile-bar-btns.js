document.getElementById('statistics').addEventListener('click', showContent, 1);
document.getElementById('stamps').addEventListener('click', showContent, 2);
document.getElementById('sign-out').addEventListener('click', showContent, 3);

function showContent(num) {
	var btn = document.getElementById('statistics-content');
	btn.style.display = 'none';
	btn = document.getElementById('stamps-content');
	btn.style.display = 'none';
	btn = document.getElementById('sign-out-content');
	btn.style.display = 'none';

	if (num === 1) {
		btn = document.getElementById('statistics-content');
		btn.style.display = 'block';
		btn = document.getElementById('statistics');
		btn.classList.add('profile-content-bar-item-active');
	} else if (num === 2) {
		btn = document.getElementById('stamps-content');
		btn.style.display = 'block';
		btn = document.getElementById('stamps');
		btn.classList.add('profile-content-bar-item-active');
	} else {
		btn = document.getElementById('sign-out-content');
		btn.style.display = 'block';
		btn = document.getElementById('sign-out');
		btn.classList.add('profile-content-bar-item-active');
	}
}
