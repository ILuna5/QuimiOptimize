document.getElementById('result-form').addEventListener('submit', async function(event) {
    event.preventDefault();

    try {
        const codigoProduto = document.getElementById('codigo-produto').value;
        const ph = document.getElementById('ph').value;
        const viscosidade = document.getElementById('viscosidade').value;
        const densidade = document.getElementById('densidade').value;
        const ativo = document.getElementById('ativo').value;
        const umidade = document.getElementById('umidade').value;
        const pontoFusao = document.getElementById('ponto-fusao').value;
        const substanciasEstranhas = document.getElementById('substancias-estranhas').value;
        const observacoes = document.getElementById('observacoes').value;

        const data = {
            Ph: ph,
            Viscosidade: viscosidade,
            Densidade: densidade,
            Ativo: ativo,
            Umidade: umidade,
            PontoDeFusao: pontoFusao,
            SubstanciasEstranhas: substanciasEstranhas,
            Obs: observacoes,
            Objeto_Codigo: parseInt(codigoProduto) // Assume que código do produto é um número
        };

        console.log("Dados enviados (JSON):", JSON.stringify(data)); // Pretty print JSON

        const response = await fetch('/Testes', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data, null, 2)
        });

        const responseText = await response.text();
        console.log("Resposta bruta do servidor:", responseText);

        try {
            const result = JSON.parse(responseText);
            console.log("Resposta do servidor (JSON):", result);

            if (response.ok) {
                alert("Cadastro realizado com sucesso!");
            } else {
                alert("Erro ao cadastrar: " + result.message);
            }
        } catch (jsonError) {
            console.error("Erro ao analisar JSON:", jsonError);
            alert("Resposta inválida do servidor.");
        }
    } catch (error) {
        console.error("Erro ao enviar dados:", error);
        alert("Erro ao enviar dados. Tente novamente mais tarde.");
    }
});
