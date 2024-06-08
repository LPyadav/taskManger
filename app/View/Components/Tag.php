<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tag extends Component
{
    /**
     * Create a new component instance.
     */
    public $type;
    public $text;

    public function __construct($type = 'info', $text)
    {
        $this->type = $type;
        $this->text = $text;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tag');
    }
}
