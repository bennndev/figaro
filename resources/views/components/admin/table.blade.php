<div class="overflow-x-auto rounded-xl border border-gray-700 transition-transform duration-300 hover:scale-[1.01]">
    <table class="min-w-full table-auto text-left border-separate border-spacing-0 bg-[#1E1E1E] text-white rounded-xl overflow-hidden">
        <thead class="bg-[#2A2A2A] text-white">
            {{ $head }}
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>

<style>
    table {
        border-collapse: separate !important;
        border-spacing: 0 !important;
    }

    th:first-child {
        border-top-left-radius: 0.75rem;
    }

    th:last-child {
        border-top-right-radius: 0.75rem;
    }
</style>
