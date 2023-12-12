<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EmptyDataComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $dynamicData;


    public function __construct($dynamicData)
    {
        $this->dynamicData = $dynamicData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.empty-data-component');
    }
}
