<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>órgãos</title>
</head>

<body style="font-size: 12px;">
    <h2 style="text-align: center">Órgãos</h2>
    @include('shared.error-message')
    <table style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr style="background-color: #adb5bd;">
                <th style="border: 1px solid #ccc;">ID</th>
                <th style="border: 1px solid #ccc;">Nome</th>
                <th style="border: 1px solid #ccc;">Ativo</th>
                <th style="border: 1px solid #ccc;">Sigla</th>
                <th style="border: 1px solid #ccc;">Endereço</th>
                <th style="border: 1px solid #ccc;">Unid. Gestora</th>
                <th style="border: 1px solid #ccc;">Responsável</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($organs as $organ)
                <tr>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $organ->id }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $organ->name }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $organ->status == 1 ? 'Sim' : 'Não' }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $organ->sigla }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $organ->address }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $organ->managementUnit?->name }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $organ->people?->name }}</td>
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
