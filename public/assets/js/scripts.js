//! Fonction pour la gestion de la barre de navigation
function toggleMenu () {
    //* On récupère le menu
    const navbar = document.querySelector('.navbar');
    //* On récupère le boutton
    const burger = document.querySelector('.burger');

    //* On change la classe de la navbar
    burger.addEventListener('click', (e) => {    
        navbar.classList.toggle('show-nav');
    });    
}

toggleMenu();