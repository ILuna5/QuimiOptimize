document.addEventListener('DOMContentLoaded', async () => {
    console.log('DOM fully loaded and parsed');

    const tabelaResultados = $('#tabela-resultados').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true
    });

    const exportarBtn = document.getElementById('exportar');

    if (!exportarBtn) {
        console.error('Element with ID "exportar" not found');
        return;
    }

    // Função para buscar os dados do backend
    async function fetchResultados() {
        console.log('Fetching data from backend');
        try {
            const response = await fetch('/Testes');
            console.log('Response status:', response.status);
            if (!response.ok) {
                throw new Error('Erro ao buscar dados');
            }
            const text = await response.text(); // Obtém a resposta como texto
            console.log('Raw response:', text); // Log da resposta bruta
            const resultados = JSON.parse(text); // Analisa a resposta como JSON
            console.log('Parsed JSON:', resultados);
            return resultados;
        } catch (error) {
            console.error('Erro ao buscar resultados:', error);
            return [];
        }
    }

    // Inserir dados na tabela
    const resultados = await fetchResultados();
    console.log('Resultados obtidos:', resultados);

    resultados.forEach((resultado, index) => {
        console.log(`Processando resultado ${index + 1}:`, resultado);
        tabelaResultados.row.add([
            resultado.Produto,
            resultado.Ph,
            resultado.Viscosidade,
            resultado.Densidade,
            resultado.Ativo,
            resultado.Umidade,
            resultado.PontoDeFusao,
            resultado.SubstanciasEstranhas,
            resultado.Obs
        ]).draw();
    });

    // Função para exportar a tabela para Excel com formatação
    exportarBtn.addEventListener('click', () => {
        console.log('Exportando dados para Excel');
        const wb = XLSX.utils.book_new();
        const ws_data = [
            [],
            [],
            ['QuimiOptimize'], // Título da tabela
            ['Produto', 'PH', 'Viscosidade', 'Densidade', 'Ativo', 'Umidade', 'Ponto de Fusão', 'Substâncias Estranhas', 'Observações'],
            ...resultados.map(r => [r.Produto, r.Ph, r.Viscosidade, r.Densidade, r.Ativo, r.Umidade, r.PontoDeFusao, r.SubstanciasEstranhas, r.Obs])
        ];

        const ws = XLSX.utils.aoa_to_sheet(ws_data);

        // Ajustar a largura das colunas
        ws['!cols'] = [
            { wch: 15 },
            { wch: 10 },
            { wch: 15 },
            { wch: 15 },
            { wch: 10 },
            { wch: 10 },
            { wch: 15 },
            { wch: 20 },
            { wch: 25 }
        ];

        // Mesclar as células do título
        ws['!merges'] = [{ s: { r: 2, c: 0 }, e: { r: 2, c: 8 } }];

        // Adicionar bordas
        const range = XLSX.utils.decode_range(ws['!ref']);
        for (let R = range.s.r; R <= range.e.r; ++R) {
            for (let C = range.s.c; C <= range.e.c; ++C) {
                const cell_address = { c: C, r: R };
                const cell_ref = XLSX.utils.encode_cell(cell_address);
                if (!ws[cell_ref]) ws[cell_ref] = {};
                if (!ws[cell_ref].s) ws[cell_ref].s = {};
                ws[cell_ref].s.border = {
                    top: { style: "thin", color: { rgb: "000000" } },
                    bottom: { style: "thin", color: { rgb: "000000" } },
                    left: { style: "thin", color: { rgb: "000000" } },
                    right: { style: "thin", color: { rgb: "000000" } }
                };
            }
        }

        XLSX.utils.book_append_sheet(wb, ws, 'Resultados');
        XLSX.writeFile(wb, 'resultadoTesteQuimiOptimize.xlsx');
        console.log('Exportação concluída');
    });
});
