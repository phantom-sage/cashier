<div x-data="{ 
    darkMode: localStorage.getItem('darkMode') === 'true' || (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches),
    toggle() {
        this.darkMode = !this.darkMode;
        localStorage.setItem('darkMode', this.darkMode);
        this.updateTheme();
    },
    updateTheme() {
        if (this.darkMode) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
}" 
x-init="updateTheme()" 
class="flex items-center">
    <button 
        @click="toggle()" 
        class="relative inline-flex items-center justify-center w-10 h-6 bg-gray-200 dark:bg-gray-700 rounded-full transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 hover:bg-gray-300 dark:hover:bg-gray-600"
        :class="{ 'bg-blue-600 hover:bg-blue-700': darkMode, 'bg-gray-200 hover:bg-gray-300': !darkMode }"
        :title="darkMode ? 'Switch to light mode' : 'Switch to dark mode'"
    >
        <!-- Toggle Circle -->
        <span 
            class="absolute left-1 inline-block w-4 h-4 bg-white rounded-full shadow transform transition-transform duration-200 ease-in-out"
            :class="{ 'translate-x-4': darkMode, 'translate-x-0': !darkMode }"
        ></span>
        
        <!-- Sun Icon (Light Mode) -->
        <svg 
            x-show="!darkMode" 
            x-transition:enter="transition-opacity duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute left-1.5 w-3 h-3 text-yellow-500" 
            fill="currentColor" 
            viewBox="0 0 20 20"
        >
            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
        </svg>
        
        <!-- Moon Icon (Dark Mode) -->
        <svg 
            x-show="darkMode" 
            x-transition:enter="transition-opacity duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute right-1.5 w-3 h-3 text-blue-300" 
            fill="currentColor" 
            viewBox="0 0 20 20"
        >
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
        </svg>
    </button>
</div>