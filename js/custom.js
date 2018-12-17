$(document).ready(function(){
    /* Super fun! Thanks for the inspiration aaronparecki.com and seblog.nl */
    let photo = document.querySelector('.namebadge img')
    if (photo) {
      window.addEventListener('deviceorientation', (e) => {
        let tiltLR = e.gamma; let tiltFB = e.beta;
        photo.style.transform = `rotate(${tiltLR * -1}deg)`
      })
    } 
});
