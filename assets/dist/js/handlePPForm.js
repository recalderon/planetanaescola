
document.addEventListener('DOMContentLoaded', ()=>{
    handleDocumentarios(), handleSegmentosEscolares(), handleDisciplinas(), handleTemas()
})

function handleDocumentarios(){
    let selectDisciplinas = document.querySelector('select#input_2_7');
    // Step 1: Create a new <option> element
    var newOption = document.createElement('option');

    // Step 2: Set text and value for the new option
    newOption.text = 'Selecione uma opção';
    newOption.value = '-1';
    newOption.selected = true
    newOption.disabled = true

    // Step 4: Add the new option as the first child of the <select> element
    selectDisciplinas.insertBefore(newOption, selectDisciplinas.firstChild);


    let slimStart = new SlimSelect({
        select: 'select#input_2_7',
        settings: {
            placeholderText: 'Selecione uma opção',
            searchPlaceholder: 'Pesquisar',
        }
    });

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const productTest = urlParams.has('docID')
    const product = urlParams.get('docID')

    if(productTest){
        slimStart.setSelected(product)
    }
}

function handleDisciplinas(){
    let selectDisciplinas = document.querySelector('select#input_2_17');

    new SlimSelect({
        select: 'select#input_2_17',
        settings: {
            placeholderText: 'Selecione uma opção',
            searchPlaceholder: 'Pesquisar',
        }
    });

}

function handleSegmentosEscolares(){
    let selectAnos = document.querySelector('select#input_2_18');

    let arrayAnosEf1 = [17, 18, 19, 20, 21];
    let arrayAnosEf2 = [23, 24, 25, 26];
    let arrayAnosEM = [30, 31, 32];

    Array.from(selectAnos.options).forEach(option => {
        if (option.label == '-- Selecione Um --'){
            option.remove()
        }
        if (option.label == 'Ensino Fundamental I'){

            let createOptgroup = document.createElement('optgroup')
            createOptgroup.label = option.label
            selectAnos.appendChild(createOptgroup)

            arrayAnosEf1.forEach(ano => {
                let getOptGrp = selectAnos.querySelector('optgroup[label="' + option.label + '"]')
                let getExistingOpt = document.querySelector('option[value="' + ano + '"]')
                getOptGrp.appendChild(getExistingOpt)
            })

            option.remove()
        }

        if(option.label == 'Ensino Fundamental II'){

            let createOptgroupEf2 = document.createElement('optgroup')
            createOptgroupEf2.label = option.label
            selectAnos.appendChild(createOptgroupEf2)

            arrayAnosEf2.forEach(ano => {
                let getOptGrp = selectAnos.querySelector('optgroup[label="' + option.label + '"]')
                let getExistingOpt = document.querySelector('option[value="' + ano + '"]')
                getOptGrp.appendChild(getExistingOpt)
            })

            option.remove()
        }

        if(option.label == 'Ensino Medio'){

            let createOptgroupEM = document.createElement('optgroup')
            createOptgroupEM.label = option.label
            selectAnos.appendChild(createOptgroupEM)

            arrayAnosEM.forEach(ano => {
                let getOptGrp = selectAnos.querySelector('optgroup[label="' + option.label + '"]')
                let getExistingOpt = document.querySelector('option[value="' + ano + '"]')
                getOptGrp.appendChild(getExistingOpt)
            })

            option.remove()
        }
    })

    new SlimSelect({
        select: 'select#input_2_18',
        settings: {
            placeholderText: 'Selecione uma opção',
            showSearch: false,
        }
    });
}

function handleTemas(){
    let selectTemas = document.querySelector('select#input_2_19');
    selectTemas.setAttribute('multiple', true);

    new SlimSelect({
        select: 'select#input_2_19',
        settings: {
            placeholderText: 'Selecione uma opção',
            searchPlaceholder: 'Pesquisar',
        }
    });

}