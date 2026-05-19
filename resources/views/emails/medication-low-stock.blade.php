<x-mail::message>
# Alerta de Stock Bajo

Hola {{ $patient->name }},

Te informamos que tu stock del medicamento **{{ $medication->medication_name }}** se encuentra bajo.

Actualmente cuentas con solo **{{ $currentStock }}** pastillas restantes.

Es importante que te pongas en contacto con tu farmacéutico para reabastecer tu medicamento lo antes posible y así evitar interrupciones en tu tratamiento.

<x-mail::button :url="config('app.url')">
Ir a Vitalia
</x-mail::button>

Gracias,<br>
El equipo de {{ config('app.name') }}
</x-mail::message>
