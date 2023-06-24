/* adicionar parametro para tipo de pesquisa. quando selecionar no dropdown, setar e construir */
document.addEventListener('DOMContentLoaded', () => {
    initWfFrontPageSelects()
})

function initWfFrontPageSelects() {

    new TomSelect('#select-tipo', {
        controlInput: null,
    })
    handleTemasSelect()
    handleSegmentoSelect()

    let btnPesquisar = document.querySelector('#pesquisa-filtros')
    btnPesquisar.addEventListener('click', () => {
        handleInputs()
    })
}

function handleTemasSelect() {
    let selectId = '#select-temas'
    let urlFetchTerms = '/wp-json/wp/v2/tema'
    let options = [];

    fetch(urlFetchTerms)
        .then(function (response) {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Error fetching terms');
            }
        })
        .then(function (response) {

            response.forEach(function (term) {
                options.push({
                    value: term.id,
                    text: term.name
                });
            });

        })
        .then(() => {
            new TomSelect(selectId, {
                options: options,
                sortField: {
                    field: 'text',
                    direction: 'asc'
                },
                searchField: ['text'],
            });
        })
        .catch(function (error) {
            console.error(error);
        })
}

function handleSegmentoSelect() {
    let selectId = '#select-segmentos'
    let urlFetchTerms = '/wp-json/wp/v2/segmento_escolar?parent='
    let options = [];
    let optgroups = [];

    fetch(urlFetchTerms + '0')
        .then(function (response) {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Error fetching parents');
            }
        })
        .then(function (response) {
            let fetchPromises = [];
            response.forEach(function (parent) {
                optgroups.push({
                    value: parent.slug,
                    label: parent.name,
                })
                let fetchPromise = fetch(urlFetchTerms + parent.id)
                    .then(function (response) {
                        if (response.ok) {
                            return response.json();
                        } else {
                            throw new Error('Error fetching terms');
                        }
                    })
                    .then(function (response) {

                        response.forEach(function (term) {
                            options.push({
                                class: parent.slug,
                                value: term.id,
                                text: term.name
                            });
                        });

                    })
                    .catch(function (error) {
                        console.error(error);
                    });
                fetchPromises.push(fetchPromise);
            })
            return Promise.all(fetchPromises);

        })
        .then(() => {
            new TomSelect(selectId, {
                options: options,
                optgroups: optgroups,
                optgroupField: 'class',
                optgroupLabelField: 'label',
                sortField: {
                    field: 'value',
                    direction: 'asc'
                },
                searchField: ['text'],
                controlInput: null,
                render: {
                    optgroup_header: function (data, escape) {
                        return '<div class="optgroup-header">' + escape(data.label) + '</div>';
                    }
                }
            });
        })
}

function handleInputs() {
    let valueTipo = document.querySelector('#select-tipo').value
    let valueTemas = document.querySelector('#select-temas').value
    let valueAnos = document.querySelector('#select-segmentos').value

    localStorage.setItem('valueTipo', valueTipo)
    localStorage.setItem('valueTemas', valueTemas)
    localStorage.setItem('valueAnos', valueAnos)
    window.location.href = '/catalogo'
}