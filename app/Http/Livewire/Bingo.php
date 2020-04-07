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
        $this->inicializar();                
    }    

    public function nuevaJugada()
    {        
        if(!$this->hemosTerminado())
        {
            $encontrado = false;            

            do
            {                
                $numero = \random_int(1, 90);
                
                if($this->resultados[$numero] == 0)
                {
                    $encontrado = true;
                }

            }while($encontrado == false);

            $this->ultimoNumero = $numero;
            $this->resultados[$numero] = 1;
            
            $this->audio = $numero;        
            $this->emit("nuevoAudio", $numero);
            
            // El primer valor es en segundos 
            //(acepta decimales ej: 0.5 para medio segundo)

            usleep(1 * 1000000);
        }
        else
        {
            // Se ha finalizado
            $this->inicializar();
            
            $this->audio = "final";        
            $this->emit("finalizado", "final");

            usleep(1 * 1000000);
        }
                    
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

    private function hemosTerminado()
    {
        $finalizado = true;
        foreach($this->resultados as $resultado)
        {
            if($resultado == 0)
            {
                $finalizado = false;
                break;
            }
        }
        return $finalizado;
    }

    private function inicializar()
    {
        $this->resultados = [];
        for ($i=0; $i <= 90; $i++) 
        { 
            $this->resultados[] = 0;                        
        }
        unset($this->resultados[0]);

        $this->ultimoNumero = 0;
    }

    public function render()
    {
        return view('livewire.bingo');
    }
}
