const formCadastro = document.getElementById('formCadastro');
const mensagemCadastro = document.getElementById('mensagemCadastro');

formCadastro.addEventListener('submit', async (event) => {
    event.preventDefault();

    const Usuario = document.getElementById('Usuario').value;
    const Senha = document.getElementById('Senha').value;

    console.log('Form submitted:', { Usuario, Senha });

    try {
        const response = await fetch('/Usuario', {
            Usuario, Senha
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
