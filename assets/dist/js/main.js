let allSwipers = Array.from(document.querySelectorAll('.swiper'));
allSwipers.forEach(swip => {
    const swiper = new Swiper(swip, {
        // Optional parameters
        slidesPerView: 3,
        spaceBetween: 20,

        // Navigation arrows
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },

    });
})

let allThumbs = Array.from(document.querySelectorAll('.doc_thumb img'));
allThumbs.forEach(thumb => {
    thumb.classList.add('img-fluid')
})

let allDocContent = Array.from(document.querySelectorAll('.doc_content'));
allDocContent.forEach(el =>{
    el.addEventListener('mouseenter', (e) => {
        el.querySelector('.doc_info').classList.remove('visually-hidden')
    })
    el.addEventListener('mouseleave', (e) => {
        el.querySelector('.doc_info').classList.add('visually-hidden')
    })
})
