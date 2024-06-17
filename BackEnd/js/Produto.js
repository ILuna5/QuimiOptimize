const produtoForm = document.getElementById('produtoForm');
const mensagemCadastro = document.getElementById('mensagemCadastro');

produtoForm.addEventListener('submit', async (event) => {
    event.preventDefault();

    const Codigo = document.getElementById('Codigo').value;
    const Produto = document.getElementById('Produto').value;

    const produtoData = {
        Codigo,
        Produto
    };

    console.log('Produto Data:', produtoData);

    try {
        const response = await fetch('/Objetos', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(produtoData)
        });

        console.log('Response received:', response);

        let data;
        try {
            data = await response.json();
            console.log('Response JSON:', data);
        } catch (jsonError) {
            console.error('Error parsing JSON:', jsonError);
            throw new Error('Resposta da API não é um JSON válido');
        }

        if (!response.ok) {
            console.error('Response not OK:', response.status, data);
            throw new Error(data.msg || 'Erro ao cadastrar usuário');
        }

        mensagemCadastro.textContent = data.msg;
    } catch (error) {
        console.error('Erro ao cadastrar usuário:', error);
        mensagemCadastro.textContent = 'Erro ao cadastrar usuário. Tente novamente mais tarde.';
    }
});
