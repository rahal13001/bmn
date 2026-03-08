@extends('layouts.public')

@section('title', 'Detail BMN: ' . $good->id_bmn)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Hero Banner Card -->
    <div class="bg-gradient-to-r from-teal-600 via-teal-700 to-blue-800 rounded-[2rem] shadow-2xl overflow-hidden relative mb-8 group transition-transform duration-500 hover:-translate-y-1">
        <!-- Abstract Decoration -->
        <div class="absolute -right-10 -top-10 opacity-20 blur-2xl mix-blend-overlay transition-opacity duration-500 group-hover:opacity-40">
            <svg class="h-64 w-64 text-teal-200" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
        </div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgc3Ryb2tlPSJyZ2JhKDI1NSwyNTUsMjU1LDAuMDUpIiBzdHJva2Utd2lkdGg9IjIiPjxwYXRoIGQ9Ik0wIDE0bDMyLTMybTI4IDZsLTMyIDMyIi8+PC9nPjwvc3ZnPg==')] opacity-30"></div>

        <div class="p-8 sm:p-12 text-center sm:text-left relative z-10 flex flex-col sm:flex-row items-center gap-6">
            <div class="shrink-0 bg-white/10 p-5 rounded-2xl backdrop-blur-md border border-white/20 text-teal-100 shadow-[0_0_15px_rgba(255,255,255,0.1)] flex items-center justify-center transition-transform duration-500 group-hover:-rotate-6 group-hover:scale-110">
                <i class="ph ph-box-arrow-down text-5xl drop-shadow-md"></i>
            </div>
            
            <div class="text-white flex-1">
                <h2 class="text-2xl md:text-3xl font-black tracking-tight mb-2 drop-shadow-sm text-center sm:text-left">{{ $good->name }}</h2>
                <div class="h-1 w-16 bg-gradient-to-r from-teal-300 to-blue-400 rounded-full mb-4 mx-auto sm:mx-0 opacity-80"></div>
                <p class="text-teal-50 text-sm md:text-base font-medium flex items-center justify-center sm:justify-start gap-2">
                    <i class="ph ph-tag"></i> 
                    {{ $good->brand ?: 'Tanpa Merek' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Main Detail Card -->
    <div class="bg-white/95 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-white overflow-hidden backdrop-blur-xl relative mb-12">
        <div class="p-8 sm:p-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-8">
                
                <div class="flex flex-col gap-2 bg-slate-50/50 p-4 rounded-2xl border border-slate-100">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2">
                        <i class="ph ph-barcode text-teal-600"></i> ID BMN
                    </span>
                    <span class="font-mono text-lg font-bold text-teal-700 bg-teal-50 px-3 py-1.5 rounded-lg border border-teal-200/60 inline-block w-fit">
                        {{ $good->id_bmn }}
                    </span>
                </div>

                <div class="flex flex-col gap-2 bg-slate-50/50 p-4 rounded-2xl border border-slate-100">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2">
                        <i class="ph ph-hash text-indigo-600"></i> NUP
                    </span>
                    <span class="font-mono text-lg font-bold text-indigo-700 bg-indigo-50 px-3 py-1.5 rounded-lg border border-indigo-200/60 inline-block w-fit">
                        {{ $good->nup }}
                    </span>
                </div>
                
                <div class="flex flex-col gap-2">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2">
                        <i class="ph ph-activity text-slate-500"></i> Kondisi Fisik
                    </span>
                    @php
                        $conditionClass = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                        $icon = 'ph-check-circle';
                        if ($good->condition === 'Rusak Ringan') {
                            $conditionClass = 'bg-amber-50 text-amber-700 border-amber-200';
                            $icon = 'ph-warning';
                        } elseif ($good->condition === 'Rusak Berat') {
                            $conditionClass = 'bg-red-50 text-red-700 border-red-200';
                            $icon = 'ph-x-circle';
                        }
                    @endphp
                    <div>
                        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl border {{ $conditionClass }} text-sm font-bold shadow-sm">
                            <i class="ph {{ $icon }}"></i> {{ $good->condition }}
                        </span>
                    </div>
                </div>
                
                <div class="flex flex-col gap-2">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2">
                        <i class="ph ph-calendar-blank text-slate-500"></i> Tahun Perolehan
                    </span>
                    <span class="text-slate-800 font-bold text-lg">
                        {{ $good->date ? \Carbon\Carbon::parse($good->date)->format('Y') : '-' }}
                    </span>
                </div>

                @if($good->color)
                <div class="flex flex-col gap-2">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2">
                        <i class="ph ph-palette text-slate-500"></i> Warna Barang
                    </span>
                    <span class="text-slate-700 font-medium">
                        {{ $good->color }}
                    </span>
                </div>
                @endif

                @if($good->ownership_label)
                <div class="flex flex-col gap-2">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2">
                        <i class="ph ph-bank text-slate-500"></i> Status Penguasaan
                    </span>
                    <span class="bg-slate-50 px-4 py-3 rounded-xl border border-slate-200 text-sm font-medium text-slate-700">
                        {{ $good->ownership_label }}
                    </span>
                </div>
                @endif

                @if($isLoggedIn)
                    <div class="flex flex-col gap-2 md:col-span-2 mt-4 pt-6 border-t border-slate-100">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2">
                            <i class="ph ph-door text-teal-600"></i> Lokasi Penyimpanan Saat Ini
                        </span>
                        @if($good->room)
                            <a href="{{ route('public.room.inventory', $good->room) }}" class="group inline-flex items-center gap-3 bg-teal-50 hover:bg-teal-600 text-teal-800 hover:text-white border border-teal-200 hover:border-teal-600 px-6 py-4 rounded-xl transition-all duration-300 w-fit shadow-sm max-w-full">
                                <div class="w-10 h-10 rounded-full bg-white text-teal-600 group-hover:bg-teal-500 group-hover:text-white flex flex-shrink-0 items-center justify-center transition-colors">
                                    <i class="ph ph-map-pin text-xl"></i>
                                </div>
                                <div class="truncate pr-2">
                                    <span class="block font-extrabold text-lg truncate">{{ $good->room->name }}</span>
                                    <span class="block text-xs font-medium opacity-80 mt-0.5 group-hover:text-teal-100">Klik untuk melihat seluruh inventaris di ruangan ini</span>
                                </div>
                                <i class="ph ph-arrow-up-right text-xl ml-2 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform border-l border-teal-200/50 group-hover:border-teal-400/50 pl-4 h-full"></i>
                            </a>
                        @else
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-slate-50 text-slate-500 rounded-lg border border-slate-200 text-sm font-medium w-fit">
                                <i class="ph ph-question"></i> Belum Ditentukan
                            </span>
                        @endif
                    </div>
                @endif

                @if(!empty($good->documentation) && is_array($good->documentation) && count($good->documentation) > 0)
                <div class="md:col-span-2 pt-8 mt-4 border-t border-slate-100">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2 mb-4">
                        <i class="ph ph-image text-slate-500"></i> Dokumentasi Foto & Berkas
                    </span>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach($good->documentation as $photo)
                            @if(Str::endsWith(strtolower($photo), ['.jpg', '.jpeg', '.png', '.webp']))
                                <a href="{{ Storage::url($photo) }}" target="_blank" class="group aspect-square rounded-2xl overflow-hidden border border-slate-200 relative block bg-slate-100 shadow-sm">
                                    <img src="{{ Storage::url($photo) }}" alt="Foto {{ $good->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity duration-300">
                                        <i class="ph ph-magnifying-glass-plus text-white text-3xl"></i>
                                    </div>
                                </a>
                            @else
                                <a href="{{ Storage::url($photo) }}" target="_blank" class="aspect-square flex flex-col items-center justify-center bg-indigo-50/50 hover:bg-indigo-50 border border-indigo-100 rounded-2xl text-indigo-700 transition-colors duration-300 shadow-sm group p-4 text-center">
                                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm mb-3 group-hover:scale-110 transition-transform">
                                        <i class="ph ph-file-pdf text-2xl text-red-500"></i>
                                    </div>
                                    <span class="text-xs font-bold">Buka Dokumen</span>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            @if($isLoggedIn)
                <div class="mt-10 pt-10 border-t border-slate-200">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-slate-800 text-white flex items-center justify-center shadow-sm">
                            <i class="ph ph-lock-key text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-800">Detail Internal Admin</h3>
                            <p class="text-xs text-slate-500 font-medium">Informasi ini tidak terlihat oleh publik.</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 bg-slate-50/80 p-6 md:p-8 rounded-2xl border border-slate-200">
                        <div class="flex flex-col gap-1.5">
                            <span class="text-xs font-bold text-slate-500 uppercase flex items-center gap-1.5">
                                <i class="ph ph-money text-emerald-600"></i> Harga Perolehan
                            </span>
                            <span class="font-bold text-slate-800 text-lg">
                                Rp {{ number_format((float) $good->acquisition_price, 0, ',', '.') }}
                            </span>
                        </div>
                        
                        @if($good->current_price)
                        <div class="flex flex-col gap-1.5">
                            <span class="text-xs font-bold text-slate-500 uppercase flex items-center gap-1.5">
                                <i class="ph ph-trend-up text-blue-600"></i> Nilai Tercatat Saat Ini
                            </span>
                            <span class="font-bold text-slate-800 text-lg">
                                Rp {{ number_format((float) $good->current_price, 0, ',', '.') }}
                            </span>
                        </div>
                        @endif
                        
                        @if($good->note)
                        <div class="flex flex-col gap-2 md:col-span-2 pt-4 border-t border-slate-200/60 mt-2">
                            <span class="text-xs font-bold text-slate-500 uppercase flex items-center gap-1.5">
                                <i class="ph ph-article"></i> Catatan Internal
                            </span>
                            <p class="text-slate-700 bg-white p-4 rounded-xl border border-slate-200 text-sm leading-relaxed font-medium">
                                {{ $good->note }}
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
