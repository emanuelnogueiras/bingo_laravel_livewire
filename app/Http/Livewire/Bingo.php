<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Bingo extends Component
{
    public $resultados;
    public $ultimoNumero;
    public $audio;

    public function mount()
    {
        $this->resultados = [];
        for ($i=0; $i <= 90; $i++) { 
            $this->resultados[] = 0;
        }
        unset($this->resultados[0]);

        $this->ultimoNumero = 0;
        
        $this->audio = "intro";        
        $this->emit("nuevoAudio");
    }

    public function nuevaJugada()
    {        
        $encontrado = false;
        $veces = 0;

        do
        {
            $veces++;
            $numero = \random_int(1, 90);
            
            if($this->resultados[$numero] == 0 || $veces > 300)
            {
                $encontrado = true;
            }

        }while($encontrado == false);


        $this->ultimoNumero = $numero;
        $this->resultados[$numero] = 1;
        
        $this->audio = $numero;        
        $this->emit("nuevoAudio", $numero);

        sleep(1);
                    
    }    

    public function iniciar()
    {
        $this->audio = $numero;        
        $this->emit("nuevoAudio", "into");
    }

    private function noHaSalido($cual)
    {
        if($this->resultados[$cual] == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function render()
    {
        return view('livewire.bingo');
    }
}
