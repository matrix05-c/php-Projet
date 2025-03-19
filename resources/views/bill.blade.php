<!DOCTYPE html>
<html>

<head>
    <title>Facture - {{ $nomClient }}</title>
    <link rel="stylesheet" href="{{ asset('css/bill.css') }}" />
</head>

<body>
    <div class="header">
        <h1 class="bill-title">Facture de Service Automobile</h1>
        <div class="client-info">
            <p>Date: {{ $date }}</p>
            <p>Nom du Client: <strong>{{ $nomClient }}</strong></p>
            <p>Voiture: <strong>{{ $numVoiture }}</strong></p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Service</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($maintenances as $maintenance)
                <tr>
                    <td>{{ $maintenance->services->service }}</td>
                    <td>{{ number_format($maintenance->services->prix, 0, ',', ' ') }} AR</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td>Total</td>
                <td>{{ number_format($total, 0, ',', ' ') }} AR</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Merci pour votre confiance!</p>
    </div>
</body>

</html>
