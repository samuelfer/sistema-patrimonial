<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cargos e funções</title>
</head>

<body style="font-size: 12px;">
    <h2 style="text-align: center">Cargos e Funções</h2>

    <table style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr style="background-color: #adb5bd;">
                <th style="border: 1px solid #ccc;">ID</th>
                <th style="border: 1px solid #ccc;">Nome</th>
                <th style="border: 1px solid #ccc;">Ativo</th>
                <th style="border: 1px solid #ccc;">Unid. Gestora</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($offices as $office)
                <tr>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $office->id }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $office->name }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $office->status == 1 ? 'Sim' : 'Não' }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $office->managementUnit?->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Nenhuma conta encontrada!</td>
                </tr>
            @endforelse
        </tbody>

    </table>
</body>

</html>
