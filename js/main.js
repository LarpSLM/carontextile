// document.addEventListener('click',  event => {
//     if (event.target.classList.contains('menu-bottom')) {
//         if (event.target.classList.contains('actiive')) {
//             event.target.classList.remove('active');
//         } else {
//             event.target.classList.add('active')
//         }
//     }
// });

function menuActive() {
    let menu = document.getElementById('menu');
    let logoIco = document.getElementById('logo-ico');
    if (document.getElementById('menu').classList.contains('active')) {
        menu.classList.remove('active');
        logoIco.classList.remove('active');
    } else {
        menu.classList.add('active');
        logoIco.classList.add('active');
    }
}