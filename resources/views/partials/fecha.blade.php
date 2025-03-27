<div class="card-container">
    <div class="title-card">
        <p>Sensor ID: {{ is_object($sensor) ? $sensor->id_sensor ?? 'N/A' : ($sensor['id_sensor'] ?? 'N/A') }}</p>
    </div>
    <div class="card-content">
        <p class="title">📅 Fecha</p>
        <p class="value">{{ is_object($sensor) ? $sensor->created_at ?? 'N/A' : ($sensor['created_at'] ?? 'N/A') }}</p>
        <br>
        <br><br><br><br><br>
        <br>
    </div>
</div>
