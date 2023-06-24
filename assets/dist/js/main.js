document.addEventListener('DOMContentLoaded', () => {
  handleDocThumbs(), handleSwipers(), startFancybox(), setPraticaSelects()
})

function handleSwipers() {
  let allSwipers = Array.from(document.querySelectorAll('.swiper.temas'));
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
}

function handleDocThumbs() {
  let containerCard = Array.from(document.querySelectorAll('.m-card'))
  containerCard.forEach(el => {
    let cover = el.querySelector('.m-cover');
    cover.addEventListener('mouseenter', (e) => {
      el.querySelector('.m-content').classList.remove('visually-hidden')
    })

    cover.addEventListener('mouseleave', (e) => {
      el.querySelector('.m-content').classList.add('visually-hidden')
    })
  })
}

function startFancybox() {
  let wrapperFB = Array.from(document.querySelectorAll("[data-fancybox]"))
  if (wrapperFB.length >= 1) {
    wrapperFB.forEach((fb) => {
      Fancybox.bind(fb, {});
    })
  }
}

function setPraticaSelects() {
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const checkDocID = urlParams.has('docID')
  const getDocID = urlParams.get('docID')

  let selectDocumentario = document.querySelector('#input_2_26');

  if (selectDocumentario) {
    let controlDocumentario = selectDocumentario.tomselect;

    if (checkDocID) {
      controlDocumentario.setValue([getDocID])
    }

    let getTSSegmentoElemento = document.querySelector('.gfield_select_tomselect#input_2_1007')
    let getTSSegmento = getTSSegmentoElemento.tomselect

    getTSSegmento.destroy()

    // Find the option with value 15
    var optionToMove = getTSSegmentoElemento.querySelector('option[value="15"]');
    // Move the option to the top
    getTSSegmentoElemento.prepend(optionToMove);

    let newTS = new TomSelect(getTSSegmentoElemento, {
      sortField: {
        field: 'value',
        direction: 'asc' // or 'desc' for descending order
      },
      optgroupValueField: 'value'
    });

    newTS.options[16].disabled = true
    newTS.options[22].disabled = true
    newTS.options[29].disabled = true
    newTS.refreshItems()
  }
}

async function buildRequest(valueTipo, valueTema, valueAnos, offset) {

  let arguments = [valueTipo, valueTema, valueAnos, offset]

  let searchArgs;
  let cleanArray = [];

  if (arguments.includes(undefined) || arguments.includes(null)) {
    arguments.forEach(arg => {
      if (typeof arg == 'string') {
        cleanArray.push(arg)
      }
    })
    searchArgs = cleanArray.length > 1 ? cleanArray.join("&") : cleanArray;
  } else {
    searchArgs = arguments.join("&");
  }

  try {
    let data = await fetch('/wp-json/customsearch/v1/catalogo?' + searchArgs);
    localStorage.setItem('total-pages', data.headers.get('X-Wp-Totalpages'))
    localStorage.setItem('total-posts', data.headers.get('X-Wp-Total'))
    return await data.json();
  } catch (error) {
    console.error(error);
  }
}