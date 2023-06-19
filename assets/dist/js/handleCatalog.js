/* adicionar parametro para tipo de pesquisa. quando selecionar no dropdown, setar e construir */
document.addEventListener('DOMContentLoaded', ()=>{
    initWf()
})

function initWf() {
    let btnPesquisa = document.querySelector('#realizar-pesquisa')
    btnPesquisa.addEventListener('click', getDocInfo)
    localStorage.getItem('valueTipo') ? getInputs() : getDocInfo()
}

async function getInputs() {
    let LSTemas = localStorage.getItem('valueTemas')
    let LSAnos = localStorage.getItem('valueAnos')

    let docDataBasedInputs = await buildRequest('tipo=documentario', 'temas=' + LSTemas, 'anos=' + LSAnos)
    localStorage.removeItem('valueTipo')
    localStorage.removeItem('valueTemas')
    localStorage.removeItem('valueAnos')
    return buildDocPreview(docDataBasedInputs)

}

async function getDocInfo(event) {
    let temasSpec;
    let docData;
    let terms = [];
    let gettemas = Array.from(document.querySelectorAll('input[data-search-arg="temas"]'))

    gettemas.forEach(term =>{
        if(term.checked == true){
            terms.push(term.dataset.catId)
        }
    })

    if(event == undefined){
        localStorage.setItem('lastQuery', 'per_page=6')
        localStorage.setItem('actual-page', 1)
        docData = await buildRequest('tipo=documentario', 'per_page=6')
        setPaginationVars(docData)
        return buildDocPreview(docData);
    }else{
        temasSpec = 'temas=' + terms.join()
        localStorage.setItem('lastQuery', temasSpec)
        docData = await buildRequest('tipo=documentario', temasSpec)
        setPaginationVars(docData)
        return buildDocPreview(docData);
    };
}

function setPaginationVars(data){
    let lastQuery = localStorage.getItem('lastQuery')
    let getActualPage = localStorage.getItem('actual-page')
    let totalPages = localStorage.getItem('total-pages')
    let totalPosts = localStorage.getItem('total-posts')
    let requestedPosts = localStorage.getItem('requested-posts')
    let sendRq;

    localStorage.removeItem('requested-posts');
    localStorage.setItem('requested-posts', data.length);

    const prev = document.querySelector('.prev');
    prev.addEventListener('click', async(e) => {
        e.preventDefault();
        if (getActualPage > 1) {
            --getActualPage;
            sendRq = await buildRequest('tipo=documentario', lastQuery, 'page=' + getActualPage);
            return buildDocPreview(sendRq);
        }
    });

    const next = document.querySelector(".next");
    next.addEventListener("click", async(e) => {
        e.preventDefault();
        if (getActualPage < totalPages) {
            getActualPage++
            if(lastQuery){
                sendRq = await buildRequest('tipo=documentario', lastQuery, 'page=' + getActualPage, 'offset=' + requestedPosts )
                return buildDocPreview(sendRq);
            }else{
                sendRq = await buildRequest('tipo=documentario', 'page=' + getActualPage );
                return buildDocPreview(sendRq);
            }
        }
    });
}

function buildDocPreview(docInfo){
    if (docInfo.length > 0) {
        let template = '';
        let gridWrapper = document.querySelector('#grid-wrapper')
        docInfo.forEach(doc => {
            let docUI = {};

            docUI.title = doc.title
            docUI.thumb = doc.thumbnail
            docUI.link = doc.link
            docUI.sinopse = doc.synopsis
            docUI.direcao = doc.direction

            template += ' <div class="col-lg-4 position-relative"> ';
            template += ' <div class="d-flex flex-column doc_content"> ';
            template += ' <div class="doc_thumb"> ';
            template += docUI.thumb;
            template += ' </div> ';
            template += ' <div class="h-100 small position-absolute d-flex flex-column doc_info visually-hidden"> ';
            template += ' <div class="d-flex flex-column px-4 pt-4 gap-2 justify-content-center h-100"> ';
            template += ' <span class="fw-bold text-uppercase doc_title"> ' + docUI.title + ' </span> ';
            template += ' <span ' + docUI.direcao + ' ></span> ';
            template += ' <p> ' + docUI.sinopse + ' </p> ';
            template += ' </div> ';
            template += ' <div class="bg-white w-100 small fw-bold text-center py-2 mt-auto"> ';
            template += ' <a href=" ' + docUI.link + ' ">Assista</a> ';
            template += ' </div> ';
            template += ' </div> ';
            template += ' </div> ';
            template += ' </div> ';
        })

        if (gridWrapper.children.length > 0) { // Or just `if (element.children.length)`
            do { gridWrapper.removeChild(gridWrapper.firstChild) } while (gridWrapper.firstChild);
            gridWrapper.innerHTML = template
        }else{
            gridWrapper.innerHTML = template
        }

    } else {
        document.querySelector('#grid-results').textContent = 'Não encontramos resultados.'
    }
}

function buildPraticaPedagogicaPreview(ppInfo){
    if(ppInfo.length > 0){
        let template = '';
        ppInfo.forEach(pratica => {
            let praticaUI = {};

            praticaUI.title = pratica.title
            praticaUI.thumb = pratica.thumbnail
            praticaUI.link = pratica.link
            praticaUI.sinopse = pratica.synopsis
            praticaUI.direcao = pratica.direction

            template += ' <div class="h-100 position-relative">'
            template += ' <div class="d-flex flex-column pratica_content"> ';
            template += ' <div class="pratica_thumb"> ';
            template += praticaUI.thumb;
            template += ' </div> ';
            template += ' <div class="h-100 small position-absolute d-flex flex-column pratica_info visually-hidden"> ';
            template += ' <div class="d-flex flex-column px-4 pt-4 gap-2 justify-content-center h-100"> ';
            template += ' <span class="fw-bold text-uppercase pratica_title"> ' + praticaUI.title + ' </span> ';
            template += ' <span ' + praticaUI.direcao + ' ></span> ';
            template += ' <p> ' + praticaUI.sinopse + ' </p> ';
            template += ' </div> ';
            template += ' <div class="bg-white w-100 small fw-bold text-center py-2 mt-auto"> ';
            template += ' <a href=" ' + praticaUI.link + ' ">Assista</a> ';
            template += ' </div> ';
            template += ' </div> ';
            template += ' </div> ';
            template += ' </div> ';

        })
        document.querySelector('#grid-results').innerHTML = template
    } else {
        document.querySelector('#grid-results').textContent = 'Não encontramos resultados.'
    }
}