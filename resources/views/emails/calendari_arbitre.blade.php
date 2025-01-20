<x-mail::message>
    # Calendari Anual de Partits per a l'Arbitre

    ## Partits Programats per a l'Any {{ \Carbon\Carbon::now()->year }}:
    @foreach($partits as $partit)
        - **{{ $partit->equipLocal->nom }}** vs **{{ $partit->equipVisitant->nom }}** ({{ $partit->data_partit }})
    @endforeach

    Gràcies per la vostra dedicació i ajuda!

    **{{ config('app.name') }}**
</x-mail::message>
