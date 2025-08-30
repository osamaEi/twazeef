@props(['class' => ''])

@php
    $currentLocale = app()->getLocale();
    $languages = [
        'ar' => [
            'name' => 'العربية',
            'flag' => '🇸🇦',
            'route' => route('language.switch', 'ar')
        ],
        'en' => [
            'name' => 'English',
            'flag' => '🇺🇸',
            'route' => route('language.switch', 'en')
        ]
    ];
@endphp

<div class="language-switcher {{ $class }}" id="languageSwitcher">
    <button class="header-btn language-btn" title="{{ __('topnav.change_language') }}">
        <i class="fas fa-globe"></i>
        <span class="current-lang">
            {{ $languages[$currentLocale]['name'] }}
        </span>
    </button>
    
    <div class="language-dropdown" id="languageDropdown">
        @foreach($languages as $locale => $lang)
            <a href="{{ $lang['route'] }}" 
               class="language-option {{ $currentLocale === $locale ? 'active' : '' }}">
                <span class="flag">{{ $lang['flag'] }}</span>
                <span>{{ $lang['name'] }}</span>
            </a>
        @endforeach
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const languageSwitcher = document.getElementById('languageSwitcher');
    
    if (languageSwitcher) {
        // Toggle language dropdown
        languageSwitcher.addEventListener('click', (e) => {
            e.stopPropagation();
            languageSwitcher.classList.toggle('active');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!languageSwitcher.contains(e.target)) {
                languageSwitcher.classList.remove('active');
            }
        });
        
        // Close dropdown on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                languageSwitcher.classList.remove('active');
            }
        });
    }
});
</script>
