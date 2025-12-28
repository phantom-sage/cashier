<div class="flex items-center">
    <button 
        wire:click="switchLanguage('{{ $currentLocale === 'en' ? 'ar' : 'en' }}')"
        class="relative inline-flex items-center justify-center w-12 h-6 bg-gray-200 dark:bg-gray-700 rounded-full transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 hover:bg-gray-300 dark:hover:bg-gray-600"
        :title="$currentLocale === 'en' ? 'Switch to Arabic' : 'Switch to English'"
    >
        <!-- Toggle Circle -->
        <span 
            class="absolute {{ $currentLocale === 'ar' ? 'translate-x-6' : 'translate-x-0' }} inline-block w-5 h-5 bg-white rounded-full shadow transform transition-transform duration-200 ease-in-out {{ $currentLocale === 'ar' ? 'left-1' : 'left-1' }}"
        ></span>
        
        <!-- English Text (LTR) -->
        <span 
            class="absolute left-1.5 text-xs font-medium text-gray-600 transition-opacity duration-200 {{ $currentLocale === 'en' ? 'opacity-100' : 'opacity-0' }}"
        >
            EN
        </span>
        
        <!-- Arabic Text (RTL) -->
        <span 
            class="absolute right-1.5 text-xs font-medium text-gray-600 transition-opacity duration-200 {{ $currentLocale === 'ar' ? 'opacity-100' : 'opacity-0' }}"
        >
            ع
        </span>
    </button>
    
    <!-- Language Label -->
    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400 {{ $currentLocale === 'ar' ? 'mr-2 ml-0' : '' }}">
        {{ $currentLocale === 'en' ? 'EN' : 'العربية' }}
    </span>
</div>