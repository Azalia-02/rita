<div class="card-container">
    <div class="title-card">
        <p>Sensor ID: {{ is_object($sensor) ? $sensor->id_sensor ?? 'N/A' : ($sensor['id_sensor'] ?? 'N/A') }}</p>
    </div>
    <div class="card-content">
        <p class="title">❤️ Ritmo Cardíaco</p>
        <p class="value">{{ is_object($sensor) ? $sensor->bpm ?? 'N/A' : ($sensor['bpm'] ?? 'N/A') }} BPM</p>
        <p class="title">🩸 Oxígeno en Sangre</p>
        <p class="value">{{ is_object($sensor) ? $sensor->spo2 ?? 'N/A' : ($sensor['spo2'] ?? 'N/A') }} %</p>
    </div>
</div>
