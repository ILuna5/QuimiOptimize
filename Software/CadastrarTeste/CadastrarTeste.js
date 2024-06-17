document.getElementById('test-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = {
        nomeProduto: document.getElementById('nome-produto').value,
        ph: document.getElementById('ph').value,
        viscosidade: document.getElementById('viscosidade').value,
        densidade: document.getElementById('densidade').value,
        ativo: document.getElementById('ativo').value,
        umidade: document.getElementById('umidade').value,
        pontoFusao: document.getElementById('ponto-fusao').value,
        substanciasEstranhas: document.getElementById('substancias-estranhas').value,
        observacoes: document.getElementById('observacoes').value
    };
    console.log('Dados do formulário:', formData);
    alert('Resultados cadastrados com sucesso!');
    document.getElementById('test-form').reset();
});
