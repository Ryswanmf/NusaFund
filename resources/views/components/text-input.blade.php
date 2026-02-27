@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-zinc-200 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-300 focus:border-maroon-500 dark:focus:border-amber-500 focus:ring-maroon-500 dark:focus:ring-amber-500 rounded-xl shadow-sm transition-all duration-300']) }}>
