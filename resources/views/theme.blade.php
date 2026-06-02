<style>
    :root {
        --bg: #020617;
        --sidebar: #0F172A;
        --card: rgba(15, 23, 42, 0.88);
        --text: #FFFFFF;
        --muted: #94A3B8;
        --border: #334155;
        --input: rgba(2, 6, 23, 0.85);
        --accent: #10B981;
        --accent-soft: rgba(16, 185, 129, .14);
    }

    [data-theme="light"] {
        --bg: #F8F5F0;
        --sidebar: #FFFFFF;
        --card: rgba(255, 255, 255, 0.94);
        --text: #111827;
        --muted: #6B7280;
        --border: #E5E7EB;
        --input: #FFFFFF;
        --accent: #059669;
        --accent-soft: rgba(5, 150, 105, .12);
    }

    body {
        background: var(--bg) !important;
        color: var(--text) !important;
        transition: background .25s ease, color .25s ease;
    }

    aside,
    .theme-sidebar {
        background: var(--sidebar) !important;
        border-color: var(--border) !important;
    }

    .theme-card {
        background: var(--card) !important;
        border: 1px solid var(--border) !important;
        color: var(--text) !important;
    }

    .theme-title {
        color: var(--text) !important;
    }

    .theme-muted {
        color: var(--muted) !important;
    }

    .theme-input {
        background: var(--input) !important;
        border: 1px solid var(--border) !important;
        color: var(--text) !important;
    }

    .theme-soft {
        background: var(--accent-soft) !important;
        color: var(--accent) !important;
        border-color: rgba(16, 185, 129, .30) !important;
    }

    [data-theme="light"] .bg-slate-950,
    [data-theme="light"] .bg-slate-950\/60,
    [data-theme="light"] .bg-slate-950\/70,
    [data-theme="light"] .bg-slate-950\/80 {
        background-color: #F8F5F0 !important;
    }

    [data-theme="light"] .bg-slate-900,
    [data-theme="light"] .bg-slate-900\/80,
    [data-theme="light"] .bg-slate-800,
    [data-theme="light"] .bg-slate-800\/80 {
        background-color: rgba(255, 255, 255, .94) !important;
    }

    [data-theme="light"] .border-slate-700,
    [data-theme="light"] .border-slate-800 {
        border-color: #E5E7EB !important;
    }

    [data-theme="light"] .text-white,
    [data-theme="light"] .text-slate-200,
    [data-theme="light"] .text-slate-300 {
        color: #111827 !important;
    }

    [data-theme="light"] .text-slate-400,
    [data-theme="light"] .text-slate-500 {
        color: #6B7280 !important;
    }

    [data-theme="light"] input,
    [data-theme="light"] select {
        background-color: #FFFFFF !important;
        color: #111827 !important;
        border-color: #E5E7EB !important;
    }

    [data-theme="light"] thead {
        background-color: #F3F4F6 !important;
    }

    [data-theme="light"] tr:hover {
        background-color: #F9FAFB !important;
    }
</style>

<script>
    function applyTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('smaresting-theme', theme);

        const selector = document.getElementById('themeSelector');
        if (selector) {
            selector.value = theme;
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const savedTheme = localStorage.getItem('smaresting-theme') || 'dark';
        applyTheme(savedTheme);

        const selector = document.getElementById('themeSelector');

        if (selector) {
            selector.addEventListener('change', function () {
                applyTheme(this.value);
            });
        }
    });
</script>