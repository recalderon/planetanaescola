

let inputEstado = document.querySelector('input[name="cadastro_estado"]')
let inputCidade = document.querySelector('input[name="cadastro_cidade"]')
let inputCEP = document.querySelector('input[name="cadastro_cep"]')
let buttonPesquisa = document.querySelector('#pesquisar_cep')


function buscarCEP() {
  let cep = inputCEP.value
  console.debug(cep)
  if (cep.length < 8) return;
  let url = 'https://viacep.com.br/ws/${cep}/json/'.replace('${cep}', cep);
  fetch(url)
    .then((res) => {
      if (res.ok) {
        res.json().then((json) => {
          if (!json.erro) {
            let cidade = json.localidade;
            let estado = json.uf;
            // Preenche os campos
            inputCidade.value = cidade;
            inputEstado.value = estado;
          }
        });
      }
    });
}

if(buttonPesquisa){
  buttonPesquisa.addEventListener('click', buscarCEP())
}else{
  console.log('não é pagina de cadastro')
}