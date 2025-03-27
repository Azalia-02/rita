<div class="card-container">
    <div class="title-card">
        <p>Sensor ID: {{ is_object($sensor) ? $sensor->id_sensor ?? 'N/A' : ($sensor['id_sensor'] ?? 'N/A') }}</p>
    </div>
    <div class="card-content">
 

        <p class="title">📉 BPM MAX30102</p>
        <p class="value">{{ is_object($sensor) ? $sensor->bpm_max30102 ?? 'N/A' : ($sensor['bpm_max30102'] ?? 'N/A') }} BPM</p>
        <br>
        <br><br><br><br><br>
        <br>
    </div>
</div>
