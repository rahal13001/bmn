@extends('layouts.public')

@section('title', 'Penyimpanan Ruangan: ' . $room->name)

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Room Info Card -->
    <div class="bg-white/90 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-white overflow-hidden backdrop-blur-xl mb-8 relative group">
        <!-- Decorative Top line -->
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-teal-400 via-emerald-400 to-blue-500"></div>
        
        <div class="p-8 sm:p-10">
            <div class="flex flex-col md:flex-row justify-between items-start gap-6">
                <div class="flex items-start gap-5 whitespace-nowrap">
                    <div class="shrink-0 w-14 h-14 rounded-2xl bg-teal-50 flex items-center justify-center text-teal-600 border border-teal-100 group-hover:scale-110 group-hover:bg-teal-600 group-hover:text-white transition-all duration-300 shadow-sm">
                        <i class="ph ph-door text-3xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight mb-2">{{ $room->name }}</h2>
                        <div class="flex flex-wrap items-center gap-2">
                            @if((bool) $room->status)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-200">
                                    <i class="ph ph-check-circle text-sm"></i> Ruangan Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 text-red-700 text-xs font-bold border border-red-200">
                                    <i class="ph ph-x-circle text-sm"></i> Tidak Aktif
                                </span>
                            @endif
                            
                            @if($room->dimension)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-bold border border-slate-200">
                                    <i class="ph ph-ruler text-sm"></i> {{ $room->dimension }}
                                </span>
                            @endif

                            @php
                                $itemCount = $room->goods->count();
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-teal-50 text-teal-700 text-xs font-bold border border-teal-200">
                                <i class="ph ph-cube text-sm"></i> {{ $itemCount }} Barang
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            @if($room->note)
                <div class="w-full h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent my-6"></div>
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2 mb-2">
                        <i class="ph ph-file-text"></i> Catatan Ruangan
                    </span>
                    <p class="text-slate-700 text-sm leading-relaxed font-medium">{{ $room->note }}</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Inventory Section -->
    <div class="mb-4 flex items-center gap-3 px-2">
        <h3 class="text-xl font-bold text-slate-800 flex items-center gap-2">
            <i class="ph ph-package text-teal-600"></i> Daftar Inventaris
        </h3>
        <div class="h-px bg-slate-200 flex-1 ml-4"></div>
    </div>

    @if($itemCount > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($room->goods as $good)
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
                <a href="{{ route('public.good.detail', $good) }}" class="group block bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:shadow-xl hover:border-teal-300 hover:-translate-y-1 transition-all duration-300">
                    <div class="flex justify-between items-start gap-4 mb-4">
                        <div class="flex-1">
                            <h4 class="font-bold text-slate-800 mb-1 group-hover:text-teal-700 transition-colors line-clamp-2">{{ $good->name }}</h4>
                            <p class="text-xs text-slate-500 font-medium flex items-center gap-1.5 mb-3">
                                <i class="ph ph-tag"></i> {{ $good->brand ?: 'Tanpa Merek' }}
                            </p>
                            <span class="inline-block px-2.5 py-1 bg-slate-100 text-teal-700 text-xs font-mono font-bold rounded-lg border border-slate-200">
                                <i class="ph ph-barcode mr-1"></i>{{ $good->id_bmn }} &bull; NUP: {{ $good->nup }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="pt-4 mt-auto border-t border-slate-100 flex items-center justify-between">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold border {{ $conditionClass }}">
                            <i class="ph {{ $icon }} text-sm"></i> {{ $good->condition }}
                        </span>
                        
                        <span class="text-xs text-slate-400 font-medium flex items-center gap-1">
                            <i class="ph ph-calendar-blank"></i> <span class="text-slate-600 font-bold">{{ $good->date ? \Carbon\Carbon::parse($good->date)->format('Y') : '-' }}</span>
                        </span>
                        
                        <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-teal-50 group-hover:text-teal-600 transition-colors">
                            <i class="ph ph-arrow-right font-bold"></i>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="bg-white/50 backdrop-blur-sm border-2 border-dashed border-slate-200 rounded-[2rem] p-12 text-center flex flex-col items-center justify-center">
            <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-6">
                <i class="ph ph-package text-4xl text-slate-300"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-700 mb-2">Ruangan Kosong</h3>
            <p class="text-slate-500 font-medium max-w-sm">Tidak ada barang atau aset yang saat ini ditempatkan di ruangan ini.</p>
        </div>
    @endif
</div>
@endsection
