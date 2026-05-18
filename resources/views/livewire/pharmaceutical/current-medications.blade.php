<div class="min-h-screen bg-white flex flex-col font-sans">
    <div class="py-6 px-4 sm:px-6 lg:px-8 w-full max-w-3xl mx-auto">
                <!-- Logo -->
        <div class="flex justify-center mb-4">
            <x-vitalia-logo class="scale-[0.45] sm:scale-[0.55]" />
        </div>

        <!-- Header -->
        <div class="flex items-center mb-8">
            <a href="{{ route('pharmaceutical.patients.list') }}" class="text-gray-700 hover:text-gray-900 transition mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 sm:w-7 sm:h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">Medicamentos Actuales</h1>
        </div>
        
        <!-- List -->
        <main class="space-y-4 mb-24">
            <!-- Card 1 -->
            <div class="bg-[#f4f4f5] rounded-2xl p-4 sm:p-5 relative">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h2 class="text-[17px] sm:text-lg font-bold text-black">Ibuprofeno</h2>
                    </div>
                    <a href="{{ route('pharmaceutical.medications.stock') }}" class="text-[#0b67c2] hover:text-blue-800 transition ml-2 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </a>
                </div>
                
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-black text-sm sm:text-base">Dosis:</span>
                        <span class="text-gray-400 font-semibold text-sm sm:text-base">400 mg</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-black text-sm sm:text-base">Stock actual:</span>
                        <span class="text-gray-400 font-semibold text-sm sm:text-base">25 pastillas</span>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-[#f4f4f5] rounded-2xl p-4 sm:p-5 relative">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h2 class="text-[17px] sm:text-lg font-bold text-black">Naproxeno</h2>
                        <span class="inline-flex items-center gap-1 bg-[#ff8a8a] text-black text-[10px] font-bold px-2 py-0.5 rounded-full mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3">
                                <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                            </svg>
                            Stock bajo
                        </span>
                    </div>
                    <a href="{{ route('pharmaceutical.medications.stock') }}" class="text-[#0b67c2] hover:text-blue-800 transition ml-2 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </a>
                </div>
                
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-black text-sm sm:text-base">Dosis:</span>
                        <span class="text-gray-400 font-semibold text-sm sm:text-base">250 mg</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-black text-sm sm:text-base">Stock actual:</span>
                        <span class="text-gray-400 font-semibold text-sm sm:text-base">3 pastillas</span>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-[#f4f4f5] rounded-2xl p-4 sm:p-5 relative">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h2 class="text-[17px] sm:text-lg font-bold text-black">Prednisona</h2>
                    </div>
                    <a href="{{ route('pharmaceutical.medications.stock') }}" class="text-[#0b67c2] hover:text-blue-800 transition ml-2 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </a>
                </div>
                
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-black text-sm sm:text-base">Dosis:</span>
                        <span class="text-gray-400 font-semibold text-sm sm:text-base">5 mg</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-black text-sm sm:text-base">Stock actual:</span>
                        <span class="text-gray-400 font-semibold text-sm sm:text-base">20 pastillas</span>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-[#f4f4f5] rounded-2xl p-4 sm:p-5 relative">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h2 class="text-[17px] sm:text-lg font-bold text-black">Dextrometrofano</h2>
                        <span class="inline-flex items-center gap-1 bg-[#ff8a8a] text-black text-[10px] font-bold px-2 py-0.5 rounded-full mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3">
                                <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                            </svg>
                            Stock bajo
                        </span>
                    </div>
                    <a href="{{ route('pharmaceutical.medications.stock') }}" class="text-[#0b67c2] hover:text-blue-800 transition ml-2 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </a>
                </div>
                
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-black text-sm sm:text-base">Dosis:</span>
                        <span class="text-gray-400 font-semibold text-sm sm:text-base">15 mg</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-black text-sm sm:text-base">Stock actual:</span>
                        <span class="text-gray-400 font-semibold text-sm sm:text-base">2 pastillas</span>
                    </div>
                </div>
            </div>
        </main>
    </div>
        <x-vitalia-bottom-nav active="home" />
</div>
