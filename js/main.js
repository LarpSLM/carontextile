
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

let menuButton = document.getElementById('menu-button');
menuButton.addEventListener('click', menuActive);

let upButton = document.getElementById('up-button');
let downButton = document.getElementById('down-button');
let imgOne = document.getElementById('item-img');


if (upButton !== null && downButton !== null) {
    upButton.onclick = function changeImgOne() {
        imgOne.innerHTML = upButton.value;
    };

    downButton.onclick = function changeImgTwo() {
        imgOne.innerHTML = downButton.value;
    };
}




// slider for index.html//

window.onload = function(){

    new Slider({
        images: '.info-div .info-div-img .slider',
        interval: '3000'
    });

    function Slider(images){

        this.images = document.querySelectorAll(images.images);
        this.interval = images.interval;

        let i = 0;

        if (this.images.length === 0) {
            return;
        }

        this.next = function() {
            this.images[i].classList.remove('shown');
            i++;
            if( i >= this.images.length){
                i = 0;
            }
            this.images[i].classList.add('shown');
        };

        setInterval(this.next.bind(this), this.interval);
    }
};
