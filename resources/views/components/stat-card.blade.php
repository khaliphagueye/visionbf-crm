@php

$colors = [

'blue'=>[
'bg'=>'bg-blue-100 dark:bg-blue-900/30',
'text'=>'text-blue-600'
],

'green'=>[
'bg'=>'bg-green-100 dark:bg-green-900/30',
'text'=>'text-green-600'
],

'amber'=>[
'bg'=>'bg-amber-100 dark:bg-amber-900/30',
'text'=>'text-amber-600'
],

'orange'=>[
'bg'=>'bg-orange-100 dark:bg-orange-900/30',
'text'=>'text-orange-600'
],

'purple'=>[
'bg'=>'bg-purple-100 dark:bg-purple-900/30',
'text'=>'text-purple-600'
],

'pink'=>[
'bg'=>'bg-pink-100 dark:bg-pink-900/30',
'text'=>'text-pink-600'
],

'cyan'=>[
'bg'=>'bg-cyan-100 dark:bg-cyan-900/30',
'text'=>'text-cyan-600'
],

'red'=>[
'bg'=>'bg-red-100 dark:bg-red-900/30',
'text'=>'text-red-600'
],

'violet'=>[
'bg'=>'bg-violet-100 dark:bg-violet-900/30',
'text'=>'text-violet-600'
],

'indigo'=>[
'bg'=>'bg-indigo-100 dark:bg-indigo-900/30',
'text'=>'text-indigo-600'
],

'emerald'=>[
'bg'=>'bg-emerald-100 dark:bg-emerald-900/30',
'text'=>'text-emerald-600'
],

'yellow'=>[
'bg'=>'bg-yellow-100 dark:bg-yellow-900/30',
'text'=>'text-yellow-600'
],

];

$c=$colors[$color];

@endphp

<div
class="group relative overflow-hidden rounded-3xl border border-slate-200 dark:border-slate-700 bg-white/90 dark:bg-slate-900/90 shadow-xl p-6 transition duration-500 hover:-translate-y-2 hover:shadow-2xl">

    <div
        class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-500 bg-gradient-to-br from-transparent via-white/5 to-white/20">
    </div>

    <div class="relative flex justify-between items-start">

        <div>

            <p class="text-sm text-slate-500 dark:text-slate-400">

                {{ $title }}

            </p>

            <h2
                class="counter mt-4 text-4xl font-extrabold {{ $c['text'] }}"
                data-value="{{ $value }}">

                {{ $value }}

            </h2>

        </div>

        <div
            class="w-16 h-16 rounded-2xl flex items-center justify-center {{ $c['bg'] }}">

            <i class="{{ $icon }} text-2xl {{ $c['text'] }}"></i>

        </div>

    </div>

    <div class="mt-5 h-1 rounded-full bg-slate-200 dark:bg-slate-700 overflow-hidden">

        <div
            class="h-full {{ $c['text'] }} bg-current w-0 group-hover:w-full transition-all duration-1000">
        </div>

    </div>

</div>