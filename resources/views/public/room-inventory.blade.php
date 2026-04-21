@extends('layouts.public')

@section('title', 'Penyimpanan Ruangan: ' . $room->name)

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ viewMode: 'grouped', photoModalOpen: false, photos: [], currentPhotoIndex: 0, currentPhotoName: '', openGallery(urls, name) { this.photos = urls; this.currentPhotoIndex = 0; this.currentPhotoName = name; this.photoModalOpen = true; }, prevPhoto() { this.currentPhotoIndex = (this.currentPhotoIndex - 1 + this.photos.length) % this.photos.length; }, nextPhoto() { this.currentPhotoIndex = (this.currentPhotoIndex + 1) % this.photos.length; } }">
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
    <div class="mb-4 py-2 flex flex-col sm:flex-row sm:items-center justify-between gap-4 px-2">
        <h3 class="text-xl font-bold text-slate-800 flex items-center gap-2">
            <i class="ph ph-package text-teal-600"></i> Daftar Inventaris
        </h3>
        
        <div class="bg-slate-100 p-1 rounded-xl inline-flex border border-slate-200">
            <button @click="viewMode = 'grouped'" :class="viewMode === 'grouped' ? 'bg-white shadow-sm text-teal-700' : 'text-slate-500 hover:text-slate-700'" class="px-4 py-1.5 rounded-lg text-sm font-bold flex items-center gap-2 transition-all">
                <i class="ph ph-squares-four text-lg"></i> Grup
            </button>
            <button @click="viewMode = 'detail'" :class="viewMode === 'detail' ? 'bg-white shadow-sm text-teal-700' : 'text-slate-500 hover:text-slate-700'" class="px-4 py-1.5 rounded-lg text-sm font-bold flex items-center gap-2 transition-all">
                <i class="ph ph-list-dashes text-lg"></i> Detail
            </button>
        </div>
    </div>

    @if($itemCount > 0)
        <!-- Grouped Mode View -->
        @php
            $groupedGoods = $room->goods->groupBy('id_bmn');
        @endphp
        
        <div x-show="viewMode === 'grouped'" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($groupedGoods as $id_bmn => $goods)
                @if($goods->count() === 1)
                    @php 
                        $good = $goods->first();
                        $conditionClass = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                        $icon = 'ph-check-circle';
                        if ($good->condition === 'Rusak Ringan') {
                            $conditionClass = 'bg-amber-50 text-amber-700 border-amber-200';
                            $icon = 'ph-warning';
                        } elseif ($good->condition === 'Rusak Berat') {
                            $conditionClass = 'bg-red-50 text-red-700 border-red-200';
                            $icon = 'ph-x-circle';
                        }
                        $allPhotos = [];
                        if (!empty($good->documentation) && is_array($good->documentation)) {
                            foreach ($good->documentation as $doc) {
                                if (\Illuminate\Support\Str::endsWith(strtolower($doc), ['.jpg', '.jpeg', '.png', '.webp'])) {
                                    $allPhotos[] = Storage::url($doc);
                                }
                            }
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
                            
                            <div class="flex items-center gap-2">
                                @if(count($allPhotos) > 0)
                                    <button @click.prevent="openGallery({{ json_encode($allPhotos) }}, '{{ str_replace("'", "\'", $good->name) }}')" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-colors border border-indigo-200 hover:border-indigo-600 text-xs font-bold shadow-sm" title="Lihat Foto">
                                        <i class="ph ph-camera text-base"></i> Foto{{ count($allPhotos) > 1 ? ' (' . count($allPhotos) . ')' : '' }}
                                    </button>
                                @endif
                                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-teal-50 group-hover:text-teal-600 transition-colors border border-slate-100">
                                    <i class="ph ph-arrow-right font-bold"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                @else
                    <div x-data="{ expanded: false }" class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col" :class="expanded ? 'border-teal-300 shadow-md' : ''">
                        <button @click="expanded = !expanded" class="w-full text-left p-5 focus:outline-none flex justify-between items-start gap-4 group">
                            <div class="flex-1">
                                <h4 class="font-bold text-slate-800 mb-1 group-hover:text-teal-700 transition-colors line-clamp-2">{{ $goods->first()->name }}</h4>
                                <p class="text-xs text-slate-500 font-medium flex items-center gap-1.5 mb-3">
                                    <i class="ph ph-tag"></i> {{ $goods->first()->brand ?: 'Tanpa Merek' }}
                                </p>
                                <span class="inline-block px-2.5 py-1 bg-slate-100 text-teal-700 text-xs font-mono font-bold rounded-lg border border-slate-200">
                                    <i class="ph ph-barcode mr-1"></i>{{ $id_bmn }}
                                </span>
                            </div>
                        </button>
                        <div class="px-5 pb-4 mt-auto border-t border-slate-100 flex items-center justify-between bg-white flex-wrap gap-3">
                            <div class="flex items-center gap-2 flex-wrap flex-1">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-teal-50 text-teal-700 border border-teal-200">
                                    <i class="ph ph-stack text-sm"></i> {{ $goods->count() }} Total
                                </span>
                                
                                @if($goods->where('condition', 'Baik')->count() > 0)
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-md text-[10px] sm:text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <i class="ph ph-check-circle"></i> {{ $goods->where('condition', 'Baik')->count() }} Baik
                                    </span>
                                @endif
                                @if($goods->where('condition', 'Rusak Ringan')->count() > 0)
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-md text-[10px] sm:text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        <i class="ph ph-warning"></i> {{ $goods->where('condition', 'Rusak Ringan')->count() }} Rusak Ringan
                                    </span>
                                @endif
                                @if($goods->where('condition', 'Rusak Berat')->count() > 0)
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-md text-[10px] sm:text-xs font-bold bg-red-50 text-red-700 border border-red-200">
                                        <i class="ph ph-x-circle"></i> {{ $goods->where('condition', 'Rusak Berat')->count() }} Rusak Berat
                                    </span>
                                @endif
                            </div>
                            
                            <button @click="expanded = !expanded" class="w-8 h-8 shrink-0 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 border border-slate-200 hover:bg-teal-50 hover:text-teal-600 transition-all duration-300" :class="expanded ? 'rotate-180 bg-teal-50 text-teal-600' : ''">
                                <i class="ph ph-caret-down font-bold"></i>
                            </button>
                        </div>                        <div x-show="expanded" x-cloak class="border-t border-slate-200 bg-slate-50/80 p-3">
                            <div class="flex flex-col gap-2 max-h-60 overflow-y-auto pr-1">
                                @foreach($goods as $good)
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
                                        $allPhotos = [];
                                        if (!empty($good->documentation) && is_array($good->documentation)) {
                                            foreach ($good->documentation as $doc) {
                                                if (\Illuminate\Support\Str::endsWith(strtolower($doc), ['.jpg', '.jpeg', '.png', '.webp'])) {
                                                    $allPhotos[] = Storage::url($doc);
                                                }
                                            }
                                        }
                                    @endphp
                                    <a href="{{ route('public.good.detail', $good) }}" class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-3 bg-white rounded-xl border border-slate-200 hover:border-teal-400 hover:shadow-md transition-all group/item">
                                        <div class="flex-1">
                                            <div class="flex flex-wrap items-center gap-2 mb-1.5">
                                                <span class="text-xs font-bold text-slate-700 group-hover/item:text-teal-700">NUP: {{ $good->nup }}</span>
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold border {{ $conditionClass }}">
                                                    <i class="ph {{ $icon }}"></i> {{ $good->condition }}
                                                </span>
                                            </div>
                                            
                                            <div class="flex flex-wrap items-center mt-1 text-[11px] text-slate-500 font-medium leading-relaxed">
                                                @if($good->brand)
                                                    <span class="inline-flex items-center"><i class="ph ph-tag mr-1"></i> {{ $good->brand }}</span>
                                                @endif
                                                
                                                @if($good->date)
                                                    @if($good->brand)
                                                        <span class="text-slate-300 mx-2">&bull;</span>
                                                    @endif
                                                    <span class="inline-flex items-center"><i class="ph ph-calendar-blank mr-1"></i> {{ \Carbon\Carbon::parse($good->date)->format('Y') }}</span>
                                                @endif
                                                
                                                @if($good->color)
                                                    @if($good->brand || $good->date)
                                                        <span class="text-slate-300 mx-2">&bull;</span>
                                                    @endif
                                                    <span class="inline-flex items-center"><i class="ph ph-palette mr-1"></i> {{ $good->color }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2 shrink-0">
                                            @if(count($allPhotos) > 0)
                                                <button @click.prevent="openGallery({{ json_encode($allPhotos) }}, '{{ str_replace("'", "\'", $good->name) }}')" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-colors border border-indigo-200 hover:border-indigo-600 text-xs font-bold shadow-sm" title="Lihat Foto">
                                                    <i class="ph ph-camera text-base"></i> Foto{{ count($allPhotos) > 1 ? ' (' . count($allPhotos) . ')' : '' }}
                                                </button>
                                            @endif
                                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-slate-400 border border-slate-100 group-hover/item:border-teal-200 group-hover/item:text-teal-600 group-hover/item:bg-teal-50 transition-colors hidden sm:flex">
                                                <i class="ph ph-arrow-right font-bold"></i>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Detail Mode View -->
        <div x-show="viewMode === 'detail'" x-cloak class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
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
                    $allPhotos = [];
                    if (!empty($good->documentation) && is_array($good->documentation)) {
                        foreach ($good->documentation as $doc) {
                            if (\Illuminate\Support\Str::endsWith(strtolower($doc), ['.jpg', '.jpeg', '.png', '.webp'])) {
                                $allPhotos[] = Storage::url($doc);
                            }
                        }
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
                        
                        <div class="flex items-center gap-2">
                            @if(count($allPhotos) > 0)
                                <button @click.prevent="openGallery({{ json_encode($allPhotos) }}, '{{ str_replace("'", "\'", $good->name) }}')" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-colors border border-indigo-200 hover:border-indigo-600 text-xs font-bold shadow-sm" title="Lihat Foto">
                                    <i class="ph ph-camera text-base"></i> Foto{{ count($allPhotos) > 1 ? ' (' . count($allPhotos) . ')' : '' }}
                                </button>
                            @endif
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-teal-50 group-hover:text-teal-600 transition-colors border border-slate-100">
                                <i class="ph ph-arrow-right font-bold"></i>
                            </div>
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

    <!-- Photo Gallery Modal via Alpine.js -->
    <div x-show="photoModalOpen" style="display: none;" class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" @keydown.left.window="if(photoModalOpen && photos.length > 1) prevPhoto()" @keydown.right.window="if(photoModalOpen && photos.length > 1) nextPhoto()" @keydown.escape.window="photoModalOpen = false">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div x-show="photoModalOpen" 
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm transition-opacity" @click="photoModalOpen = false" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal panel -->
            <div x-show="photoModalOpen"
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-100">
                 
                <div class="bg-white p-4 sm:p-6 relative">
                    <button @click="photoModalOpen = false" class="absolute top-4 right-4 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-slate-100/80 backdrop-blur-sm text-slate-500 hover:bg-slate-200 border border-slate-200 hover:text-slate-800 transition-colors">
                        <i class="ph ph-x font-bold"></i>
                    </button>
                    <div class="w-full">
                        <div class="flex items-center justify-between mb-4 pr-8 border-b border-slate-100 pb-3">
                            <h3 class="text-lg leading-6 font-bold text-slate-900" id="modal-title" x-text="currentPhotoName"></h3>
                            <span x-show="photos.length > 1" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-bold border border-slate-200 ml-3 shrink-0">
                                <i class="ph ph-images"></i>
                                <span x-text="(currentPhotoIndex + 1) + ' / ' + photos.length"></span>
                            </span>
                        </div>
                        <div class="w-full rounded-2xl overflow-hidden bg-slate-50 border border-slate-200 mt-2">
                            <template x-if="photos.length > 0">
                                <img :src="photos[currentPhotoIndex]" class="w-full h-auto max-h-[80vh] sm:max-h-[50vh] object-contain" alt="Foto Barang" @click="window.open(photos[currentPhotoIndex], '_blank')" style="cursor: zoom-in;">
                            </template>
                        </div>

                        <!-- Navigation bar (prev / dots / next) -->
                        <div x-show="photos.length > 1" class="flex items-center justify-center gap-4 mt-4">
                            <button @click="prevPhoto()" class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-teal-50 hover:text-teal-700 hover:border-teal-300 transition-all shrink-0">
                                <i class="ph ph-caret-left text-lg font-bold"></i>
                            </button>
                            <div class="flex items-center gap-2">
                                <template x-for="(photo, idx) in photos" :key="idx">
                                    <button @click="currentPhotoIndex = idx" class="w-2.5 h-2.5 rounded-full transition-all duration-200" :class="currentPhotoIndex === idx ? 'bg-teal-600 scale-125' : 'bg-slate-300 hover:bg-slate-400'"></button>
                                </template>
                            </div>
                            <button @click="nextPhoto()" class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-teal-50 hover:text-teal-700 hover:border-teal-300 transition-all shrink-0">
                                <i class="ph ph-caret-right text-lg font-bold"></i>
                            </button>
                        </div>

                        <p class="text-xs text-slate-400 mt-3 text-center select-none">
                            <i class="ph ph-info mr-1"></i> Klik gambar untuk melihat ukuran penuh.
                            <span x-show="photos.length > 1" class="ml-1">Gunakan <i class="ph ph-arrow-left"></i><i class="ph ph-arrow-right"></i> keyboard untuk navigasi.</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
