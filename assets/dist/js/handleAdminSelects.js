/* adicionar parametro para tipo de pesquisa. quando selecionar no dropdown, setar e construir */
document.addEventListener('DOMContentLoaded', ()=>{
    initWfAdminSelects()
})

function initWfAdminSelects() {
    let selectPaises = document.querySelector('div[data-name="paises"] select')
    let opt = new Option();
    selectPaises.setAttribute('multiple', true);
    selectPaises.classList.remove('cf-select__input')
    selectPaises.insertBefore(opt, selectPaises.firstChild);
    selectPaises.firstChild.dataset.placeholder = 'true'
    return setSlim()
}

function setSlim(){
    new SlimSelect({
        select: 'div[data-name="paises"] select',
        settings: {
            placeholder: true,
            placeholderText: 'Selecione uma opção',
            searchPlaceholder: 'Pesquisar',
            searchHighlight: true,
            hideSelected: true,
        }
    });
}