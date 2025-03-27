<div class="card-container">
    <div class="title-card">
        <p>Sensor ID: {{ is_object($sensor) ? $sensor->id_sensor ?? 'N/A' : ($sensor['id_sensor'] ?? 'N/A') }}</p>
    </div>
    <div class="card-content">
        <p class="title">🌡️ Temperatura Corporal</p>
        <p class="value">{{ is_object($sensor) ? $sensor->temperatura_ds18b20 ?? 'N/A' : ($sensor['temperatura_ds18b20'] ?? 'N/A') }} °C</p>
        <br>
        <br><br><br><br><br>
        <br>
    </div>
</div>
    