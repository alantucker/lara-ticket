<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PriorityBadge extends Component
{
    public int $number;
    /**
     * Create a new component instance.
     */
    public function __construct(int $number)
    {
        $this->number = $number;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.priority-badge');
    }


    /**
     * Determine the badge name based on the number.
     *
     * @return string
     */
    public function badgeName(): string
    {
        $nameLookup = [
            1 => 'low',
            2 => 'medium',
            3 => 'high',
            4 => 'urgent',
        ];

        return $nameLookup[$this->number] ?? 'Low';
    }
}
