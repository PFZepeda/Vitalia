<x-mail::message>
# Aviso: pocos medicamentos restantes

Hola {{ $patient->name }},

Tienes pocos medicamentos restantes. Por favor, abastece con tu farmacéutico.

<x-mail::button :url="config('app.url')">
Ir a Vitalia
</x-mail::button>

Gracias,<br>
El equipo de {{ config('app.name') }}
</x-mail::message>
