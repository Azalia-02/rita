
@foreach($sensores as $sensor)

    <!-- ✅ Tarjetas por categorías -->
    @include('partials.temperatura', ['sensor' => $sensor])
    @include('partials.ritmo_sanguineo', ['sensor' => $sensor])
    @include('partials.ecg', ['sensor' => $sensor])
    @include('partials.humedad', ['sensor' => $sensor])
    @include('partials.fecha', ['sensor' => $sensor])
@endforeach
