<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TablaEncabezado extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public array $encabezados)
    {
    }
    public function render(): View|Closure|string
    {
        return view('components.tabla-encabezado',['encabezados'=>$this->encabezados]);
    }
}
