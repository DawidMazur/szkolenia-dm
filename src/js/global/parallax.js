const parallax = document.querySelectorAll('[data-parallax]');
if(parallax.length > 0) {
    parallax.forEach(function(el) {
        var parallaxInstance = new Parallax(el);
    });
}