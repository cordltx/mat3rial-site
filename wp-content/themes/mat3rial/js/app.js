(function() {
	var staticLogo = 'http://mat3rial.com/wp-content/themes/mat3rial/img/logo.png';
	var animatedLogo = 'http://mat3rial.com/wp-content/themes/mat3rial/img/logo-anim.gif';

	var animPreload = new Image();
	animPreload.src = animatedLogo;

	var logo = document.getElementById('logo-main');

	logo.addEventListener('mouseover', function()
	{
		logo.src = animatedLogo;
	});

	logo.addEventListener('mouseout', function()
	{
		logo.src = staticLogo;
	});
})();
