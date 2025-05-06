<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppBrand extends Component
    {
    public function render(): View|Closure|string
    {
        return <<<'HTML'
            <div>
                <div {{ $attributes->class(["flex items-center gap-3"]) }}>
                    <img src="{{asset('images/ncst.png')}}" alt="NCST Logo" class="w-10 h-10 object-contain">
                    <div class="flex flex-col">
                        <span class="font-bold text-lg leading-tight">NCST</span>
                        <span class="text-sm">Research Department</span>
                    </div>
                </div>
            </div>
        HTML;
    }
}
