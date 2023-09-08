<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $label;
    public $type;
    public $placeholder;
    public $name;
    public $id;
    public $required;
    public $default;
    /**
     * Create a new component instance.
     */
    public function __construct($type,$name,$placeholder="",$id="null",$required="false",$label="",$default="")
    {
        $this->label=$label;
        $this->type=$type;
        $this->placeholder=$placeholder;
        $this->name=$name;
        $this->id=$id;
        $this->required=$required;
        $this->default=$default;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
