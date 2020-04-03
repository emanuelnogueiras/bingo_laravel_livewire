<div>
    <div class="row">
        <div class="col-md-8">

            {{-- Los resultados que van saliendo --}}
            <div class="row">
                @foreach($resultados as $clave => $valor)
                    @if($valor == 0)
                        <div class="col-1-10 resultado" style="min-width: 10%; min-height: 50px; text-align: center;">                                                    
                            <span class="badge badge-secondary" style="font-size: 24px;">{{ str_pad($clave, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    @else
                        @if($clave == $ultimoNumero)
                            <div class="col-1-10 resulado" style="min-width: 10%; min-height: 50px; text-align: center;">
                                <span class="badge badge-danger" style="font-size: 24px;">{{ str_pad($clave, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        @else
                            <div class="col-1-10 resultado" style="min-width: 10%; min-height: 50px; text-align: center;">
                                <span class="badge badge-success" style="font-size: 24px;">{{ str_pad($clave, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>

        </div>

        <div class="col-md-4">
            {{-- El juego --}}
            <div class="text-center">
                <div wire:loading.remove class="text-danger">
                    <h1 style="font-size: 100px;"><strong>{{ $ultimoNumero }}</strong></h1>
                </div>
                <div wire:loading>
                    <img src="/img/loading-naranja.gif" style="width: 120px;">
                </div>                
            </div>
            <div class="text-center mt-3">
                <button 
                    id="botonJugar"
                    wire:click="nuevaJugada" 
                    wire:loading.remove                                        
                    class="btn btn-primary">Jugar</button>
            </div>
            <div class="text-center mt-3">
                <button wire:loading.remove
                    class="btn btn-info" 
                    onClick="iniciarAutomatico()">Automatico</button>

            </div>

        </div>

    </div>
    
    {{-- Sonidos --}}
    <audio id="myAudio">        
        <source src="/audio/{{$audio}}.wav" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>    

</div>

<script>
    var automatico = false;

    function playSound(sonido)
    {
        /*var x = document.getElementById("myAudio"); 
                
        x.src = "/audio/hasalido.wav";
        x.load();
        x.play();
        
        x.src = "/audio/" + sonido + ".wav";
        x.load();
        x.play();
        */

        var audio1 = new Audio("/audio/hasalido.wav");
        audio1.play();

        var audio2 = new Audio("/audio/" + sonido + ".wav");        
        setTimeout(() => { audio2.play(); }, 1500);

        
    }

    window.livewire.on('nuevoAudio', sonido => {            
        playSound(sonido);
    });

    function iniciarAutmatico()
    {
        automatico = true;
    }

    function iniciarAutomatico()
    {        
        if(automatico == true)
        {
            automatico = false;
            console.log("Se ha desactivado automatico");
        }
        else
        {
            automatico = true;
            console.log("Se ha activado automatico");
        }
    }

    setInterval(jugar, 5000);

    function jugar()
    {
        if(automatico == true)
        {
            document.getElementById('botonJugar').click();
        }
        
    }

</script>
