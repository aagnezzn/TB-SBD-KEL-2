<!DOCTYPE html>
<html>
<head>
    <title>FAQ Page</title>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-10">

    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-6">Pertanyaan yang sering diajukan</h2>
        
        <div class="divide-y divide-gray-200">
            @foreach($faqs as $faq)
                <div x-data="{ open: false }" class="py-4">
                    <button @click="open = !open" class="flex justify-between items-center w-full text-left font-semibold text-gray-800">
                        <span>{{ $faq->question }}</span>
                        <svg class="w-5 h-5 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div x-show="open" x-cloak class="mt-3 text-gray-600 leading-relaxed">
                        {{ $faq->answer }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>