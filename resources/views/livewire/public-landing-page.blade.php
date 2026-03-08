<div class="min-h-screen bg-slate-100 relative selection:bg-teal-500 selection:text-white font-sans text-slate-900 overflow-x-hidden" x-data="{ pageLoaded: false }" x-init="setTimeout(() => pageLoaded = true, 50)">

    <!-- Dynamic Background -->
    <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-[40%] -left-[20%] w-[80%] h-[80%] rounded-full bg-teal-100/50 blur-[120px] mix-blend-multiply opacity-70 animate-blob"></div>
        <div class="absolute top-[20%] -right-[20%] w-[60%] h-[60%] rounded-full bg-blue-100/50 blur-[100px] mix-blend-multiply opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-[20%] left-[20%] w-[70%] h-[70%] rounded-full bg-indigo-100/40 blur-[100px] mix-blend-multiply opacity-70 animate-blob animation-delay-4000"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMTQ4LCAxNjMsIDE4NCwgMC4xKSIvPjwvc3ZnPg==')] opacity-60"></div>
    </div>

    <!-- Header / Hero Section -->
    <div class="bg-white/80 backdrop-blur-md border-b border-white/50 relative z-10 shadow-sm"
         x-show="pageLoaded" 
         x-transition:enter="transition-all ease-out duration-700"
         x-transition:enter-start="-translate-y-full opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100">
        
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-10 md:py-14 flex flex-col md:flex-row items-center gap-6 md:gap-8 justify-center text-center md:text-left">
                <!-- Logo -->
                <div class="shrink-0 transition-all duration-500 hover:scale-110 hover:rotate-3 shadow-lg rounded-2xl bg-white border border-slate-100 p-3 group">
                    <img src="{{ asset('img/logokkp.jpg') }}" alt="Logo KKP" class="h-24 md:h-28 w-auto object-contain transition-transform duration-500 group-hover:scale-105">
                </div>
                
                <!-- Title -->
                <div class="flex-1">
                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-extrabold text-slate-800 tracking-tight leading-tight">
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-teal-700 to-blue-800">Loka Penataan Ruang Laut,</span> <br class="hidden md:block"/> 
                        <span class="text-slate-700">Direktorat Jenderal Penataan Ruang Laut,</span> <br class="hidden md:block"/> 
                        <span class="text-slate-600 font-bold">Kementerian Kelautan dan Perikanan</span>
                    </h1>
                    <div class="mt-5 inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-gradient-to-r from-teal-50 to-emerald-50 text-teal-800 text-sm font-bold shadow-sm border border-teal-200/60 ring-1 ring-teal-900/5 hover:shadow-md transition-shadow">
                        <div class="p-1.5 rounded-full bg-teal-100 text-teal-600">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9C9.5 7.62 10.62 6.5 12 6.5C13.38 6.5 14.5 7.62 14.5 9C14.5 10.38 13.38 11.5 12 11.5Z"/></svg>
                        </div>
                        Layanan Peminjaman Barang Milik Negara (BMN)
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="py-10 md:py-16 relative z-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Integrity Zone Banner -->
            <div x-show="pageLoaded" 
                 x-transition:enter="transition-all ease-out duration-1000 delay-300"
                 x-transition:enter-start="opacity-0 translate-y-12 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 class="mb-10 group cursor-default">
                <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-teal-600 via-teal-700 to-blue-800 p-6 shadow-2xl sm:p-8 flex flex-col sm:flex-row items-center sm:items-start gap-6 border border-teal-500/30 transition-transform duration-500 hover:-translate-y-1">
                    
                    <!-- Decorative elements -->
                    <div class="absolute -right-10 -top-10 opacity-20 blur-2xl mix-blend-overlay transition-opacity duration-500 group-hover:opacity-40">
                        <svg class="h-64 w-64 text-teal-200" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgc3Ryb2tlPSJyZ2JhKDI1NSwyNTUsMjU1LDAuMDUpIiBzdHJva2Utd2lkdGg9IjIiPjxwYXRoIGQ9Ik0wIDE0bDMyLTMybTI4IDZsLTMyIDMyIi8+PC9nPjwvc3ZnPg==')] opacity-30"></div>

                    <!-- Icon -->
                    <div class="shrink-0 bg-white/10 p-4 rounded-2xl backdrop-blur-md border border-white/20 text-teal-100 shadow-[0_0_15px_rgba(255,255,255,0.1)] relative z-10 hidden sm:flex items-center justify-center transition-transform duration-500 group-hover:rotate-12 group-hover:scale-110">
                        <svg class="w-12 h-12 drop-shadow-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><path d="M9 12l2 2 4-4"></path></svg>
                    </div>
                    
                    <!-- Text Content -->
                    <div class="relative z-10 text-white text-center sm:text-left flex-1">
                        <h2 class="text-xl md:text-2xl font-black tracking-tight mb-3 flex flex-col sm:flex-row items-center gap-3 drop-shadow-sm">
                            <span class="sm:hidden bg-white/10 p-3 rounded-2xl backdrop-blur-md border border-white/20 inline-flex shadow-inner">
                                <svg class="w-8 h-8 text-teal-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><path d="M9 12l2 2 4-4"></path></svg>
                            </span>
                            <span class="bg-gradient-to-r from-white to-teal-100 bg-clip-text text-transparent">Zona Integritas (WBK)</span>
                        </h2>
                        <div class="h-1 w-16 bg-gradient-to-r from-teal-300 to-blue-400 rounded-full mb-4 mx-auto sm:mx-0 opacity-80"></div>
                        <p class="text-teal-50 text-sm md:text-base leading-relaxed font-medium md:leading-loose text-shadow-sm">
                            Layanan administrasi Peminjaman BMN ini dilaksanakan secara <strong class="text-white font-bold bg-white/10 px-2 py-0.5 rounded">profesional, transparan, dan tanpa biaya (GRATIS)</strong>. 
                            Kami <span class="bg-red-500/80 text-white px-2 py-0.5 rounded font-bold tracking-wider inline-block transform -rotate-1 shadow-sm border border-red-400/50 mt-1 sm:mt-0">MENOLAK SEGALA BENTUK GRATIFIKASI</span> demi mewujudkan tata kelola pemerintahan yang bersih dan akuntabel.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Main Form Card -->
            <div x-show="pageLoaded" 
                 x-transition:enter="transition-all ease-out duration-1000 delay-500"
                 x-transition:enter-start="opacity-0 translate-y-16"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="bg-white/90 rounded-[2rem] shadow-2xl shadow-slate-200/60 border border-white overflow-hidden backdrop-blur-xl backdrop-filter relative mb-12">
                
                <!-- Decorative Top line -->
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-teal-400 via-emerald-400 to-blue-500"></div>

                <div class="p-8 sm:p-12">
                    <div class="mb-10 text-center sm:text-left">
                        <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Formulir Permohonan</h2>
                        <p class="mt-4 text-slate-500 leading-relaxed max-w-2xl font-medium text-base">Silakan lengkapi formulir di bawah ini untuk mengajukan permohonan peminjaman. Sistem akan melakukan pengecekan ketersediaan barang secara realtime sesuai tanggal yang dipilih.</p>
                    </div>

                    @if (session()->has('message'))
                        <div class="mb-10 p-5 rounded-2xl bg-gradient-to-br from-emerald-50 to-teal-50 border border-emerald-200/60 flex items-start gap-5 shadow-sm animate-[pulse_2s_ease-in-out_1]">
                            <div class="bg-emerald-100 p-2 rounded-full shrink-0 mt-0.5 ring-4 ring-emerald-50">
                                <svg class="w-6 h-6 text-emerald-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM11.0026 16L18.0737 8.92893L16.6595 7.51472L11.0026 13.1716L8.17421 10.3431L6.76001 11.7574L11.0026 16Z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-emerald-800 text-lg">Permohonan Berhasil!</h3>
                                <p class="text-emerald-700 mt-1 font-medium">{{ session('message') }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Form -->
                    <form wire:submit="submit" class="space-y-12" enctype="multipart/form-data" 
                          x-on:borrow-success.window="
                            Swal.fire({
                                title: 'Berhasil!',
                                text: $event.detail[0].message,
                                icon: 'success',
                                confirmButtonText: 'Tutup',
                                confirmButtonColor: '#0d9488',
                                background: '#f8fafc',
                                borderRadius: '1rem',
                                customClass: {
                                    confirmButton: 'px-6 py-2 rounded-xl text-sm font-bold shadow-md'
                                }
                            });
                          ">
                        
                        <!-- Data Peminjam -->
                        <div class="group">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center text-teal-600 border border-teal-100 group-hover:scale-110 group-hover:bg-teal-600 group-hover:text-white transition-all duration-300 shadow-sm">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-slate-800">Data Peminjam</h3>
                                    <p class="text-sm text-slate-500 font-medium">Informasi diri pemohon (individu / instansi).</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-8 bg-slate-50/50 p-6 sm:p-8 rounded-[1.5rem] border border-slate-100">
                                <div class="relative">
                                    <label for="borrower" class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" id="borrower" wire:model="borrower" class="w-full rounded-xl border-slate-200 bg-white shadow-sm focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20 sm:text-sm text-slate-800 transition-all duration-300 border py-3 px-4 hover:border-teal-300 placeholder-slate-400" placeholder="Masukkan nama lengkap pemohon">
                                    @error('borrower') <span class="text-red-500 text-sm mt-1.5 font-medium block flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> {{ $message }}</span> @enderror
                                </div>
                                
                                <div class="relative">
                                    <label for="borrower_phone" class="block text-sm font-bold text-slate-700 mb-2">No. Telepon/WhatsApp <span class="text-red-500">*</span></label>
                                    <input type="tel" id="borrower_phone" wire:model="borrower_phone" class="w-full rounded-xl border-slate-200 bg-white shadow-sm focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20 sm:text-sm text-slate-800 transition-all duration-300 border py-3 px-4 hover:border-teal-300 placeholder-slate-400" placeholder="Contoh: 08123456789">
                                    @error('borrower_phone') <span class="text-red-500 text-sm mt-1.5 font-medium block flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> {{ $message }}</span> @enderror
                                </div>
                                
                                <div class="md:col-span-2 relative">
                                    <label for="borrower_email" class="block text-sm font-bold text-slate-700 mb-2">Email <span class="text-red-500">*</span></label>
                                    <input type="email" id="borrower_email" wire:model="borrower_email" class="w-full rounded-xl border-slate-200 bg-white shadow-sm focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20 sm:text-sm text-slate-800 transition-all duration-300 border py-3 px-4 hover:border-teal-300 placeholder-slate-400" placeholder="email@instansi.go.id">
                                    @error('borrower_email') <span class="text-red-500 text-sm mt-1.5 font-medium block flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> {{ $message }}</span> @enderror
                                </div>
                                
                                <div class="md:col-span-2 relative">
                                    <label for="borrower_address" class="block text-sm font-bold text-slate-700 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                                    <textarea id="borrower_address" wire:model="borrower_address" rows="3" class="w-full rounded-xl border-slate-200 bg-white shadow-sm focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20 sm:text-sm text-slate-800 transition-all duration-300 border py-3 px-4 hover:border-teal-300 placeholder-slate-400" placeholder="Alamat lengkap instansi/lembaga/rumah yang akan menjadi penanggung jawab"></textarea>
                                    @error('borrower_address') <span class="text-red-500 text-sm mt-1.5 font-medium block flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> {{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Detail Peminjaman -->
                        <div class="group">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 border border-blue-100 group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 shadow-sm">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-slate-800">Detail Peminjaman</h3>
                                    <p class="text-sm text-slate-500 font-medium">Informasi mengenai kegiatan dan periode waktu.</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-8 bg-slate-50/50 p-6 sm:p-8 rounded-[1.5rem] border border-slate-100">
                                <div class="md:col-span-2 relative">
                                    <label for="need" class="block text-sm font-bold text-slate-700 mb-2">Keperluan / Kegiatan <span class="text-red-500">*</span></label>
                                    <input type="text" id="need" wire:model="need" class="w-full rounded-xl border-slate-200 bg-white shadow-sm focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20 sm:text-sm text-slate-800 transition-all duration-300 border py-3 px-4 hover:border-teal-300 placeholder-slate-400" placeholder="Contoh: Kegiatan survei pemetaan laut di perairan Sorong">
                                    @error('need') <span class="text-red-500 text-sm mt-1.5 font-medium block flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> {{ $message }}</span> @enderror
                                </div>

                                <div class="relative">
                                    <label for="borrow_date" class="block text-sm font-bold text-slate-700 mb-2">Tanggal Mulai Pinjam <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <input type="date" id="borrow_date" wire:model.live="borrow_date" class="w-full rounded-xl border-slate-200 bg-white shadow-sm focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20 sm:text-sm text-slate-800 transition-all duration-300 border py-3 px-4 pl-10 hover:border-teal-300">
                                    </div>
                                    @error('borrow_date') <span class="text-red-500 text-sm mt-1.5 font-medium block flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> {{ $message }}</span> @enderror
                                </div>

                                <div class="relative">
                                    <label for="return_date" class="block text-sm font-bold text-slate-700 mb-2">Tanggal Rencana Kembali <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <input type="date" id="return_date" wire:model.live="return_date" class="w-full rounded-xl border-slate-200 bg-white shadow-sm focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20 sm:text-sm text-slate-800 transition-all duration-300 border py-3 px-4 pl-10 hover:border-teal-300">
                                    </div>
                                    @error('return_date') <span class="text-red-500 text-sm mt-1.5 font-medium block flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> {{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Daftar Barang -->
                        <div class="group">
                            <div class="flex items-center justify-between pb-2 mb-4 border-b border-slate-200/60">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 border border-emerald-100 group-hover:scale-110 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300 shadow-sm">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-slate-800">Barang BMN</h3>
                                        <p class="text-sm text-slate-500 font-medium">Pilih barang yang ingin dipinjam.</p>
                                    </div>
                                </div>
                                <button type="button" wire:click="addGood" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-700 border border-emerald-200 font-semibold text-sm rounded-xl hover:bg-emerald-600 hover:text-white hover:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 transition-all duration-300 shadow-sm ml-auto">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    Tambah Item
                                </button>
                            </div>
                            
                            @error('borrowGoods') 
                            <div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-200 flex items-start gap-3">
                                <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="text-sm font-semibold text-red-800">{{ $message }}</span>
                            </div> 
                            @enderror

                            <div class="space-y-4">
                                @foreach($borrowGoods as $index => $item)
                                    <div class="flex flex-col sm:flex-row items-start gap-4 p-5 bg-white border border-slate-200 rounded-2xl shadow-sm hover:shadow-md transition-shadow shrink-0 w-full" x-data="{ expanded: true }"
                                         x-transition:enter="transition ease-out duration-300"
                                         x-transition:enter-start="opacity-0 scale-95"
                                         x-transition:enter-end="opacity-100 scale-100">
                                        <div class="flex-grow w-full relative">
                                            <label class="block text-sm font-bold text-slate-700 mb-2">Barang #{{ $index + 1 }} <span class="text-red-500">*</span></label>
                                            <div class="relative w-full" 
                                                 x-data="{
                                                    open: false,
                                                    search: '',
                                                    selected: $wire.entangle('borrowGoods.{{ $index }}.good_id'),
                                                    options: {{ json_encode($availableGoods->map(function ($data, $id) { return ['id' => $id, 'label' => $data['label'], 'disabled' => $data['disabled']]; })->values()->all()) }},
                                                    get filteredOptions() {
                                                        if (this.search === '') return this.options;
                                                        return this.options.filter(opt => opt.label.toLowerCase().includes(this.search.toLowerCase()));
                                                    },
                                                    get selectedLabel() {
                                                        if (!this.selected) return '-- Silakan Pilih Barang --';
                                                        let opt = this.options.find(o => o.id == this.selected);
                                                        return opt ? opt.label : '-- Silakan Pilih Barang --';
                                                    }
                                                 }" 
                                                 x-effect="if(open) $nextTick(() => $refs.searchInput.focus())"
                                                 @click.away="open = false; search = ''" 
                                                 @keydown.escape="open = false; search = ''">
                                                 
                                                <div @click="open = !open" 
                                                     class="w-full rounded-xl appearance-none border border-slate-200 shadow-sm focus-within:border-teal-500 focus-within:ring-4 focus-within:ring-teal-500/20 sm:text-sm transition-all duration-300 py-3 px-4 hover:border-teal-300 cursor-pointer flex items-center justify-between"
                                                     :class="open ? 'border-teal-500 ring-4 ring-teal-500/20 bg-slate-50' : 'bg-slate-50'">
                                                     <span x-text="selectedLabel" :class="selectedLabel === '-- Silakan Pilih Barang --' ? 'text-slate-500 font-medium' : 'text-slate-800 font-bold'"></span>
                                                     <svg class="h-4 w-4 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                </div>

                                                <!-- Dropdown Menu -->
                                                <div x-cloak x-show="open" 
                                                     x-transition:enter="transition ease-out duration-200" 
                                                     x-transition:enter-start="opacity-0 translate-y-2 scale-95" 
                                                     x-transition:enter-end="opacity-100 translate-y-0 scale-100" 
                                                     x-transition:leave="transition ease-in duration-150" 
                                                     x-transition:leave-start="opacity-100 translate-y-0 scale-100" 
                                                     x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                                                     class="absolute z-50 w-full mt-2 bg-white rounded-xl shadow-[0_10px_40px_-5px_rgba(0,0,0,0.1)] border border-slate-200/60 overflow-hidden flex flex-col max-h-80 ring-1 ring-slate-900/5 origin-top">
                                                     
                                                    <!-- Search Input -->
                                                    <div class="p-2 border-b border-slate-100 bg-slate-50/80 backdrop-blur sticky top-0 z-10 w-full">
                                                        <div class="relative w-full">
                                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                                            </div>
                                                            <input type="text" x-model="search" x-ref="searchInput" placeholder="Cari nama atau kode barang..." 
                                                                   class="w-full pl-9 pr-3 py-2.5 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-500/30 shadow-sm transition-all text-slate-700 placeholder-slate-400 font-medium"
                                                                   @keydown.enter.prevent="
                                                                       if(filteredOptions.length > 0 && !filteredOptions[0].disabled) { 
                                                                           selected = filteredOptions[0].id; 
                                                                           open = false; 
                                                                           search = ''; 
                                                                       }
                                                                   ">
                                                        </div>
                                                    </div>

                                                    <!-- Options List -->
                                                    <ul class="overflow-y-auto flex-1 p-1.5 w-full">
                                                        <template x-for="option in filteredOptions" :key="option.id">
                                                            <li>
                                                                <!-- Selectable option -->
                                                                <button type="button" x-show="!option.disabled || selected == option.id"
                                                                        @click="selected = option.id; open = false; search = '';" 
                                                                        class="w-full text-left px-4 py-3 rounded-lg text-sm flex items-start gap-3 transition-colors mb-0.5 group/opt"
                                                                        :class="selected == option.id ? 'bg-teal-50/80 text-teal-800 font-bold border border-teal-100/50' : 'text-slate-700 hover:bg-slate-50 font-medium border border-transparent'">
                                                                    <div class="flex-1 leading-relaxed" x-text="option.label"></div>
                                                                    <svg x-show="selected == option.id" class="w-5 h-5 text-teal-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                                                </button>
                                                                
                                                                <!-- Disabled option -->
                                                                <div x-show="option.disabled && selected != option.id" class="w-full text-left px-4 py-3 rounded-lg text-sm flex items-start gap-3 text-slate-400 bg-slate-50/40 mb-0.5 cursor-not-allowed border border-transparent">
                                                                     <div class="flex-1 leading-relaxed" x-text="option.label"></div>
                                                                     <svg class="w-5 h-5 text-slate-300 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                                                </div>
                                                            </li>
                                                        </template>
                                                        <li x-show="filteredOptions.length === 0" class="px-4 py-10 text-center flex flex-col items-center justify-center">
                                                            <div class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                                                                <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                            </div>
                                                            <p class="text-sm font-medium text-slate-500">Pencarian "<span x-text="search" class="font-bold text-slate-700"></span>"</p>
                                                            <p class="text-xs text-slate-400 mt-1">Tidak menemukan barang yang cocok.</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @error('borrowGoods.'.$index.'.good_id') <span class="text-red-500 text-sm mt-1.5 font-medium block flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> {{ $message }}</span> @enderror
                                        </div>
                                        
                                        @if(count($borrowGoods) > 1)
                                        <div class="pt-2 sm:pt-7 w-full sm:w-auto flex justify-end">
                                            <button type="button" wire:click="removeGood({{ $index }})" title="Hapus Barang" class="inline-flex items-center gap-2 sm:gap-0 px-4 py-2 sm:p-3 text-red-500 bg-red-50/50 hover:text-white hover:bg-red-500 border border-red-100 rounded-xl transition-all duration-300 focus:ring-4 focus:ring-red-500/20 shadow-sm font-semibold text-sm">
                                                <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                <span class="sm:hidden">Hapus</span>
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" wire:click="addGood" class="sm:hidden mt-4 w-full inline-flex justify-center items-center gap-2 px-4 py-3 bg-emerald-50 text-emerald-700 border border-emerald-200 font-semibold text-sm rounded-xl hover:bg-emerald-600 hover:text-white hover:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 transition-all duration-300 shadow-sm">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                Tambah Item BMN Lain
                            </button>
                        </div>

                        <!-- Dokumentasi -->
                        <div class="group">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 border border-indigo-100 group-hover:scale-110 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 shadow-sm">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-slate-800">Dokumen Pendukung</h3>
                                    <p class="text-sm text-slate-500 font-medium">Surat permohonan resmi peminjaman BMN.</p>
                                </div>
                            </div>
                            
                            <div class="mt-1 flex justify-center px-6 pt-8 pb-8 border-2 border-slate-200 border-dashed rounded-[1.5rem] bg-slate-50/50 hover:bg-white focus-within:ring-4 focus-within:ring-teal-500/20 focus-within:border-teal-500 transition-all duration-300 cursor-pointer relative group/dropzone overflow-hidden" 
                                x-data="{ isUploading: false, progress: 0 }" 
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                
                                <div class="absolute inset-0 bg-teal-50 opacity-0 group-hover/dropzone:opacity-100 transition-opacity duration-300 pointer-events-none"></div>

                                <div class="space-y-3 text-center relative z-10 w-full">
                                    <div class="inline-flex p-4 rounded-full bg-slate-100 text-slate-400 group-hover/dropzone:bg-teal-100 group-hover/dropzone:text-teal-600 transition-colors duration-300 mb-2">
                                        <svg class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div class="flex text-sm text-slate-600 justify-center flex-col items-center">
                                        <label for="application_letter" class="relative cursor-pointer rounded-md font-bold text-teal-600 hover:text-teal-700 focus-within:outline-none bg-white px-4 py-2 border border-teal-200 shadow-sm transition hover:shadow">
                                            <span class="flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg> Pilih File PDF</span>
                                            <input id="application_letter" name="application_letter" wire:model="application_letter" type="file" class="sr-only" accept=".pdf">
                                        </label>
                                        <p class="mt-3 text-slate-500 font-medium">atau tarik dan lepas dile di area ini</p>
                                    </div>
                                    <p class="text-xs text-slate-400 font-semibold bg-slate-100 inline-block px-2 py-1 rounded-md">Maksimal ukuran file: 10MB</p>
                                </div>
                                
                                <!-- Upload Progress Overlay -->
                                <div x-show="isUploading" class="absolute inset-0 bg-white/95 backdrop-blur-sm z-20 flex items-center justify-center p-6 h-full w-full" x-transition>
                                    <div class="w-full max-w-sm">
                                        <div class="mb-3 flex justify-between text-sm font-bold text-teal-800">
                                            <span class="flex items-center gap-2">
                                                <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                                Mengunggah Dokumen...
                                            </span>
                                            <span x-text="progress + '%'"></span>
                                        </div>
                                        <div class="overflow-hidden h-3 mb-4 text-xs flex rounded-full bg-teal-100 shadow-inner">
                                            <div :style="`width: ${progress}%`" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-gradient-to-r from-teal-400 to-teal-600 transition-all duration-300"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @if ($application_letter)
                                <div class="mt-4 flex items-center justify-between p-4 bg-teal-50 border border-teal-200 rounded-xl shadow-sm animate-[fadeIn_0.5s_ease-out]">
                                    <div class="flex items-center gap-4 truncate">
                                        <div class="p-2 bg-white rounded-lg shadow-sm border border-teal-100 shrink-0">
                                            <svg class="w-6 h-6 text-teal-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                        </div>
                                        <div class="flex flex-col truncate">
                                            <span class="text-sm font-bold text-teal-900 truncate">{{ $application_letter->getClientOriginalName() }}</span>
                                            <span class="text-xs font-semibold text-teal-600 mt-0.5 flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Siap Diunggah
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @error('application_letter') 
                                <span class="text-red-500 text-sm mt-3 font-medium block flex items-start gap-1 p-3 bg-red-50 rounded-lg border border-red-100"><svg class="w-4 h-4 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> {{ $message }}</span> 
                            @enderror
                        </div>
                        
                        <!-- Submit Action -->
                        <div class="pt-10 mt-10 border-t border-slate-100 flex justify-end">
                            <button type="submit" wire:loading.attr="disabled" class="w-full sm:w-auto inline-flex justify-center items-center rounded-xl bg-gradient-to-r from-teal-600 to-teal-500 hover:from-teal-500 hover:to-teal-400 px-10 py-4 text-base font-bold text-white shadow-lg shadow-teal-500/30 hover:shadow-teal-500/40 focus:outline-none focus:ring-4 focus:ring-teal-500/30 transition-all duration-300 disabled:opacity-70 disabled:cursor-not-allowed transform hover:-translate-y-0.5 active:translate-y-0 active:scale-95">
                                <span wire:loading.remove wire:target="submit" class="flex items-center gap-3">
                                    <svg class="w-5 h-5 -ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                    Kirim Permohonan Sekarang
                                </span>
                                <span wire:loading wire:target="submit" class="flex items-center gap-3">
                                    <svg class="animate-spin h-5 w-5 text-white -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Sistem Sedang Memproses...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer info -->
            <div x-show="pageLoaded" 
                 x-transition:enter="transition-all ease-out duration-1000 delay-700"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 class="mt-12 mb-8 text-center">
                <p class="text-sm font-medium text-slate-500 drop-shadow-sm">
                    &copy; {{ date('Y') }} Loka Penataan Ruang Laut Sorong. Hak cipta dilindungi.
                </p>
                <p class="text-xs text-slate-400 mt-1">Sistem Informasi Manajemen Barang Milik Negara (BMN)</p>
            </div>
            
        </div>
    </main>

    <!-- Global Keyframes for Animations -->
    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 20s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</div>
