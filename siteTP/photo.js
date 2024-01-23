let menu = document.querySelector('#menu-icon');
let navlist = document.querySelector('.navlist');

menu.onclick = () => {
    menu.classList.toggle('bx-x');
    navlist.classList.toggle('open');
}

const sr = ScrollReveal({
    delay: 450,
    distance: '65px',
    duration: 2000,
    reset: true
});

sr.reveal('.hero-text', {delay: 200, origin: 'top'});
sr.reveal('.hero-img', {delay: 450, origin: 'bottom'});
sr.reveal('.scroll-down', {delay: 500, origin: 'right'});



