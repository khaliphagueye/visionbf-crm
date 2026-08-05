<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class StatCard extends Component
{
    public string $icon;
    public string $title;
    public $value;
    public string $color;

    public function __construct(
        string $icon,
        string $title,
        $value,
        string $color = 'blue'
    ) {
        $this->icon = $icon;
        $this->title = $title;
        $this->value = $value;
        $this->color = $color;
    }

    public function render(): View
    {
        return view('components.stat-card');
    }
}