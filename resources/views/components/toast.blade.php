<div x-data="{ 
        show: false, 
        message: '', 
        type: 'success',
        timer: null,
        init() {
            @if(session('success'))
                this.pop('{{ session('success') }}', 'success');
            @endif
            @if(session('error'))
                this.pop('{{ session('error') }}', 'error');
            @endif
            
            window.addEventListener('toast', (e) => {
                this.pop(e.detail.message, e.detail.type || 'success');
            });
        },
        pop(msg, type) {
            this.message = msg;
            this.type = type;
            this.show = true;
            if(this.timer) clearTimeout(this.timer);
            this.timer = setTimeout(() => this.show = false, 5000);
        }
     }"
     x-show="show"
     x-transition:enter="transition ease-out duration-500"
     x-transition:enter-start="opacity-0 translate-y-10 scale-95"
     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
     x-transition:leave-end="opacity-0 translate-y-4 scale-95"
     x-cloak
     class="fixed bottom-10 right-6 md:right-10 z-[100] max-w-sm w-full">
    
    <div class="relative overflow-hidden p-6 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.15)] border backdrop-blur-xl flex items-center gap-5 group"
         :class="type === 'success' ? 'bg-white/90 border-green-100' : 'bg-white/90 border-red-100'">
        
        <!-- Icon -->
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-inner"
             :class="type === 'success' ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600'">
            <template x-if="type === 'success'">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
            </template>
            <template x-if="type === 'error'">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
            </template>
        </div>

        <!-- Content -->
        <div class="flex-1 min-w-0">
            <p class="text-[10px] font-black uppercase tracking-[0.2em] mb-1"
               :class="type === 'success' ? 'text-green-400' : 'text-red-400'"
               x-text="type === 'success' ? 'Sistem Sukses' : 'Perhatian'"></p>
            <p class="text-sm font-black text-zinc-900 leading-snug" x-text="message"></p>
        </div>

        <!-- Close Button -->
        <button @click="show = false" class="text-zinc-300 hover:text-zinc-500 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <!-- Progress Timer Bar -->
        <div class="absolute bottom-0 left-0 h-1 bg-gradient-to-r transition-all duration-[5000ms] linear"
             :class="type === 'success' ? 'from-green-400 to-green-600' : 'from-red-400 to-red-600'"
             :style="show ? 'width: 100%' : 'width: 0%'"></div>
    </div>
</div>
