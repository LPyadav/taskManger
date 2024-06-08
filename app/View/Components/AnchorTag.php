<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AnchorTag extends Component
{
    /**
     * Create a new component instance.
     */
    public $href;
    public $text;
    public $class;

    public function __construct($href, $text, $class = '')
    {
        $this->href = $href;
        $this->text = $text;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.anchor-tag');
    }


}
