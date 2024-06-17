const mensagemCadastro = document.getElementById('mensagemCadastro');

document.getElementById('login-form').addEventListener('submit', async(event) => {
    event.preventDefault();
    const formData = {
        username: document.getElementById('username').value,
        password: document.getElementById('password').value
    };
    console.log('Login Data:', formData);

    try {
        const response = await fetch('/Objetos', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
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

    alert('Login successful!');
    document.getElementById('login-form').reset();
});
