@extends("layout")
@section("content")

    <div class="container pt-3">
        <h4 class="text-danger mb-0"><strong>Bienvenidos al Bingo</strong></h4>
        <h1 class="text-primary"><strong>#yomequedoencasa</strong></h1>
        <hr>

        @livewire("bingo")
        
    </div>

@endsection