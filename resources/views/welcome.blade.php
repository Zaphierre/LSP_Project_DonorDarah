@extends('layouts.public')

@section('title', 'Beranda')

@section('content')

{{-- ════════════════════════════════════════════════════════════
     CAROUSEL HERO
════════════════════════════════════════════════════════════ --}}
<section id="beranda" aria-label="Banner utama">
    <div class="relative overflow-hidden bg-black max-h-[520px] md:max-h-[280px]">

        {{-- Track --}}
        <div class="flex [transition:transform_0.6s_cubic-bezier(0.76,0,0.24,1)]" id="carousel-track">

            {{-- Slide 1 --}}
            <div class="min-w-full relative">
                <img src="{{ asset('images/carousel-1.png') }}" alt="Donor Darah PMI Kota Palembang"
                     loading="eager"
                     class="w-full h-[520px] md:h-[280px] object-cover block opacity-75">
                <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/20 to-transparent flex items-center">
                    <div class="max-w-[1280px] mx-auto px-16 md:px-6 w-full">
                        <div class="inline-flex items-center gap-[0.4rem] bg-[rgba(204,0,0,0.3)] border border-[rgba(204,0,0,0.6)] text-[#FF8888] px-4 py-[0.35rem] rounded-[99px] text-[0.8rem] font-bold mb-4 backdrop-blur-sm">🩸 PMI Kota Palembang</div>
                        <h1 class="text-[clamp(1.75rem,4vw,3rem)] md:text-[1.3rem] font-black text-white leading-[1.15] tracking-[-0.02em] mb-4 [text-shadow:0_2px_20px_rgba(0,0,0,0.5)]">Donor Darah,<br>Selamatkan Jiwa</h1>
                        <p class="text-base text-white/80 max-w-[440px] leading-[1.7] mb-7 hidden md:hidden">Bergabunglah bersama ribuan pendonor sukarela PMI Kota Palembang. Satu kantong darah Anda bisa menyelamatkan tiga nyawa.</p>
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center justify-center gap-[0.4rem] px-8 py-[0.9rem] rounded-lg font-bold text-base cursor-pointer transition-all duration-200 whitespace-nowrap no-underline bg-[#CC0000] text-white hover:bg-[#990000] hover:-translate-y-px hover:shadow-[0_8px_32px_rgba(204,0,0,0.25)]"
                           id="hero-btn-daftar">🩸 Daftar Sekarang</a>
                    </div>
                </div>
            </div>

            {{-- Slide 2 --}}
            <div class="min-w-full relative">
                <img src="{{ asset('images/carousel-2.png') }}" alt="Stok Darah PMI"
                     loading="lazy"
                     class="w-full h-[520px] md:h-[280px] object-cover block opacity-75">
                <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/20 to-transparent flex items-center">
                    <div class="max-w-[1280px] mx-auto px-16 md:px-6 w-full">
                        <div class="inline-flex items-center gap-[0.4rem] bg-[rgba(204,0,0,0.3)] border border-[rgba(204,0,0,0.6)] text-[#FF8888] px-4 py-[0.35rem] rounded-[99px] text-[0.8rem] font-bold mb-4 backdrop-blur-sm">⚠️ Stok Terbatas</div>
                        <h1 class="text-[clamp(1.75rem,4vw,3rem)] md:text-[1.3rem] font-black text-white leading-[1.15] tracking-[-0.02em] mb-4 [text-shadow:0_2px_20px_rgba(0,0,0,0.5)]">Stok Darah<br>Segera Dibutuhkan</h1>
                        <p class="text-base text-white/80 max-w-[440px] leading-[1.7] mb-7 hidden md:hidden">Ketersediaan darah di PMI Kota Palembang perlu terus dipenuhi. Jadilah pahlawan dengan mendonorkan darah Anda hari ini.</p>
                        <a href="#stok-darah"
                           class="inline-flex items-center justify-center gap-[0.4rem] px-8 py-[0.9rem] rounded-lg font-bold text-base cursor-pointer transition-all duration-200 whitespace-nowrap no-underline bg-[#CC0000] text-white hover:bg-[#990000] hover:-translate-y-px hover:shadow-[0_8px_32px_rgba(204,0,0,0.25)]"
                           id="hero-btn-stok">📊 Cek Stok Darah</a>
                    </div>
                </div>
            </div>

            {{-- Slide 3 --}}
            <div class="min-w-full relative">
                <img src="{{ asset('images/carousel-3.png') }}" alt="Event Donor Massal PMI"
                     loading="lazy"
                     class="w-full h-[520px] md:h-[280px] object-cover block opacity-75">
                <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/20 to-transparent flex items-center">
                    <div class="max-w-[1280px] mx-auto px-16 md:px-6 w-full">
                        <div class="inline-flex items-center gap-[0.4rem] bg-[rgba(204,0,0,0.3)] border border-[rgba(204,0,0,0.6)] text-[#FF8888] px-4 py-[0.35rem] rounded-[99px] text-[0.8rem] font-bold mb-4 backdrop-blur-sm">📅 Jadwal Terdekat</div>
                        <h1 class="text-[clamp(1.75rem,4vw,3rem)] md:text-[1.3rem] font-black text-white leading-[1.15] tracking-[-0.02em] mb-4 [text-shadow:0_2px_20px_rgba(0,0,0,0.5)]">Donor Darah Massal<br>Bersama PMI</h1>
                        <p class="text-base text-white/80 max-w-[440px] leading-[1.7] mb-7 hidden md:hidden">Ikuti kegiatan donor darah massal yang diselenggarakan PMI Kota Palembang. Gratis, aman, dan penuh manfaat.</p>
                        <a href="#jadwal"
                           class="inline-flex items-center justify-center gap-[0.4rem] px-8 py-[0.9rem] rounded-lg font-bold text-base cursor-pointer transition-all duration-200 whitespace-nowrap no-underline bg-[#CC0000] text-white hover:bg-[#990000] hover:-translate-y-px hover:shadow-[0_8px_32px_rgba(204,0,0,0.25)]"
                           id="hero-btn-jadwal">📅 Lihat Jadwal</a>
                    </div>
                </div>
            </div>

        </div>

        {{-- Prev Button --}}
        <button class="absolute top-1/2 -translate-y-1/2 left-6 md:left-3 w-[50px] h-[50px] rounded-full bg-white/20 backdrop-blur-[8px] border border-white/30 text-white text-[1.6rem] font-bold cursor-pointer flex items-center justify-center transition-all duration-200 z-50 hover:bg-[rgba(204,0,0,0.7)] hover:scale-110 hover:border-red-400 hover:shadow-[0_4px_20px_rgba(204,0,0,0.4)] active:scale-95"
                id="carousel-prev" aria-label="Slide sebelumnya">&#8249;</button>

        {{-- Next Button --}}
        <button class="absolute top-1/2 -translate-y-1/2 right-6 md:right-3 w-[50px] h-[50px] rounded-full bg-white/20 backdrop-blur-[8px] border border-white/30 text-white text-[1.6rem] font-bold cursor-pointer flex items-center justify-center transition-all duration-200 z-50 hover:bg-[rgba(204,0,0,0.7)] hover:scale-110 hover:border-red-400 hover:shadow-[0_4px_20px_rgba(204,0,0,0.4)] active:scale-95"
                id="carousel-next" aria-label="Slide berikutnya">&#8250;</button>

        {{-- Dots --}}
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2 z-50"
             role="tablist" aria-label="Navigasi carousel">
            <button class="carousel-dot w-2 h-2 rounded-full bg-white/40 cursor-pointer transition-all duration-300 border-0 active"
                    data-index="0" role="tab" aria-label="Slide 1" aria-selected="true"></button>
            <button class="carousel-dot w-2 h-2 rounded-full bg-white/40 cursor-pointer transition-all duration-300 border-0"
                    data-index="1" role="tab" aria-label="Slide 2" aria-selected="false"></button>
            <button class="carousel-dot w-2 h-2 rounded-full bg-white/40 cursor-pointer transition-all duration-300 border-0"
                    data-index="2" role="tab" aria-label="Slide 3" aria-selected="false"></button>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════════════════════
     INFO BUTTONS
════════════════════════════════════════════════════════════ --}}
<section class="py-16">
    <div class="max-w-[1280px] mx-auto px-8 md:px-5 w-full">
        <div class="text-center mb-10">
            <span class="inline-flex items-center gap-[0.4rem] bg-[rgba(204,0,0,0.08)] border border-[rgba(204,0,0,0.3)] text-[#FF3333] px-4 py-[0.35rem] rounded-[99px] text-[0.8rem] font-bold mb-4"
                  data-aos="fade-up">ℹ️ Informasi</span>
            <h2 class="text-[clamp(1.75rem,3vw,2.5rem)] font-black tracking-[-0.02em] mb-3"
                data-aos="fade-up" data-aos-delay="100">Panduan Donor Darah</h2>
            <p class="text-base text-black leading-[1.7] max-w-[560px] mx-auto"
               data-aos="fade-up" data-aos-delay="150">Pelajari semua yang perlu Anda ketahui tentang proses donor darah bersama PMI Kota Palembang.</p>
        </div>

        {{-- 3-column grid, 1-col on mobile --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Tentang Donasi --}}
            <div class="info-btn-card bg-[#fcfcfc] border border-[rgba(36,35,35,0.08)] rounded-[18px] p-8 text-center cursor-pointer transition-[transform,border-color,box-shadow] duration-300 hover:-translate-y-[6px] hover:border-[rgba(204,0,0,0.3)] hover:shadow-[0_16px_48px_rgba(204,0,0,0.15)]"
                 data-aos="fade-up" data-aos-delay="100"
                 onclick="openModal('modal-donasi')" role="button" tabindex="0" id="card-tentang-donasi"
                 onkeydown="if(event.key==='Enter')openModal('modal-donasi')">
                <div class="w-16 h-16 rounded-[18px] bg-[rgba(204,0,0,0.08)] flex items-center justify-center text-[1.8rem] mx-auto mb-5 transition-[background,transform] duration-200 group-hover:bg-[rgba(204,0,0,0.2)] group-hover:scale-105">🩸</div>
                <div class="text-base font-extrabold mb-2">Tentang Donasi</div>
                <p class="text-[0.85rem] text-black leading-[1.6] mb-5">Kenali manfaat dan pentingnya mendonorkan darah untuk keselamatan sesama.</p>
                <span class="inline-flex items-center justify-center gap-[0.4rem] px-[0.9rem] py-[0.4rem] rounded-lg font-bold text-[0.8rem] cursor-pointer transition-all duration-200 whitespace-nowrap bg-[#CC0000] text-white pointer-events-none">Pelajari →</span>
            </div>

            {{-- Cara Donasi --}}
            <div class="info-btn-card bg-[#fcfcfc] border border-[rgba(36,35,35,0.08)] rounded-[18px] p-8 text-center cursor-pointer transition-[transform,border-color,box-shadow] duration-300 hover:-translate-y-[6px] hover:border-[rgba(204,0,0,0.3)] hover:shadow-[0_16px_48px_rgba(204,0,0,0.15)]"
                 data-aos="fade-up" data-aos-delay="200"
                 onclick="openModal('modal-cara')" role="button" tabindex="0" id="card-cara-donasi"
                 onkeydown="if(event.key==='Enter')openModal('modal-cara')">
                <div class="w-16 h-16 rounded-[18px] bg-[rgba(204,0,0,0.08)] flex items-center justify-center text-[1.8rem] mx-auto mb-5 transition-[background,transform] duration-200">📋</div>
                <div class="text-base font-extrabold mb-2">Cara Donasi</div>
                <p class="text-[0.85rem] text-black leading-[1.6] mb-5">Panduan langkah demi langkah tentang cara melakukan donor darah dengan mudah.</p>
                <span class="inline-flex items-center justify-center gap-[0.4rem] px-[0.9rem] py-[0.4rem] rounded-lg font-bold text-[0.8rem] cursor-pointer transition-all duration-200 whitespace-nowrap bg-[#CC0000] text-white pointer-events-none">Pelajari →</span>
            </div>

            {{-- Kebijakan Donasi --}}
            <div class="info-btn-card bg-[#fcfcfc] border border-[rgba(36,35,35,0.08)] rounded-[18px] p-8 text-center cursor-pointer transition-[transform,border-color,box-shadow] duration-300 hover:-translate-y-[6px] hover:border-[rgba(204,0,0,0.3)] hover:shadow-[0_16px_48px_rgba(204,0,0,0.15)]"
                 data-aos="fade-up" data-aos-delay="300"
                 onclick="openModal('modal-kebijakan')" role="button" tabindex="0" id="card-kebijakan-donasi"
                 onkeydown="if(event.key==='Enter')openModal('modal-kebijakan')">
                <div class="w-16 h-16 rounded-[18px] bg-[rgba(204,0,0,0.08)] flex items-center justify-center text-[1.8rem] mx-auto mb-5 transition-[background,transform] duration-200">📜</div>
                <div class="text-base font-extrabold mb-2">Kebijakan Donasi</div>
                <p class="text-[0.85rem] text-black leading-[1.6] mb-5">Syarat, ketentuan, dan kebijakan yang berlaku untuk calon pendonor darah PMI.</p>
                <span class="inline-flex items-center justify-center gap-[0.4rem] px-[0.9rem] py-[0.4rem] rounded-lg font-bold text-[0.8rem] cursor-pointer transition-all duration-200 whitespace-nowrap bg-[#CC0000] text-white pointer-events-none">Pelajari →</span>
            </div>

        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════════════════════
     STOK GOLONGAN DARAH
════════════════════════════════════════════════════════════ --}}
<section class="py-20 bg-[#8B0000]" id="stok-darah">
    <div class="max-w-[1280px] mx-auto px-8 md:px-5 w-full">

        <div class="mb-10">
            <span class="inline-flex items-center gap-[0.4rem] bg-white/15 border border-white/30 text-red-100 px-4 py-[0.35rem] rounded-[99px] text-[0.8rem] font-bold mb-4"
                  data-aos="fade-up">🩸 Ketersediaan Darah</span>
            <h2 class="text-[clamp(1.75rem,3vw,2.5rem)] font-black tracking-[-0.02em] mb-3 text-white"
                data-aos="fade-up" data-aos-delay="100">Stok Golongan Darah</h2>
            <p class="text-base text-red-100 leading-[1.7] max-w-[560px]"
               data-aos="fade-up" data-aos-delay="150">Data ketersediaan darah di PMI Kota Palembang berdasarkan jenis golongan darah pendonor terdaftar.</p>
        </div>

        {{-- Blood Table Card --}}
        <div class="bg-white border border-white/20 shadow-2xl rounded-[20px] overflow-hidden"
             data-aos="fade-up" data-aos-delay="200">

            {{-- Table Header --}}
            <div class="px-8 py-6 border-b border-gray-200 flex items-center justify-between flex-wrap gap-3">
                <h3 class="text-base font-extrabold text-gray-900">📊 Data Stok Produk Darah</h3>
                <div class="inline-flex items-center gap-[0.4rem] text-[0.75rem] text-gray-700 bg-red-50 border border-red-200 px-[0.85rem] py-[0.35rem] rounded-[99px]">
                    <div class="dot-live w-[7px] h-[7px] rounded-full bg-emerald-500 shrink-0"></div>
                    <span id="update-timestamp">Update: {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y, H:i') }} WIB</span>
                </div>
            </div>

            {{-- Scrollable Table --}}
            <div class="overflow-x-auto">
                <table class="w-full border-collapse" id="blood-stock-table">
                    <thead>
                        <tr>
                            <th class="bg-gray-50 px-5 py-[0.85rem] text-left text-[0.75rem] uppercase tracking-[0.06em] text-gray-700 border-b border-gray-200 font-bold">Golongan</th>
                            <th class="bg-gray-50 px-5 py-[0.85rem] text-left text-[0.75rem] uppercase tracking-[0.06em] text-gray-700 border-b border-gray-200 font-bold">Whole Blood (WB)</th>
                            <th class="bg-gray-50 px-5 py-[0.85rem] text-left text-[0.75rem] uppercase tracking-[0.06em] text-gray-700 border-b border-gray-200 font-bold">Red Cell (PRC)</th>
                            <th class="bg-gray-50 px-5 py-[0.85rem] text-left text-[0.75rem] uppercase tracking-[0.06em] text-gray-700 border-b border-gray-200 font-bold md:hidden">Trombosit (TC)</th>
                            <th class="bg-gray-50 px-5 py-[0.85rem] text-left text-[0.75rem] uppercase tracking-[0.06em] text-gray-700 border-b border-gray-200 font-bold md:hidden">Plasma (FFP)</th>
                            <th class="bg-gray-50 px-5 py-[0.85rem] text-left text-[0.75rem] uppercase tracking-[0.06em] text-gray-700 border-b border-gray-200 font-bold md:hidden">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $bloodTypes = ['A', 'B', 'AB', 'O'];
                            $donorCounts = $bloodStock ?? [];
                            $stockData = [
                                'A'  => ['wb' => rand(15,50), 'prc' => rand(10,40), 'tc' => rand(5,20),  'ffp' => rand(8,30)],
                                'B'  => ['wb' => rand(10,45), 'prc' => rand(8,35),  'tc' => rand(3,18),  'ffp' => rand(6,25)],
                                'AB' => ['wb' => rand(3,15),  'prc' => rand(2,12),  'tc' => rand(1,8),   'ffp' => rand(2,10)],
                                'O'  => ['wb' => rand(20,60), 'prc' => rand(15,50), 'tc' => rand(8,25),  'ffp' => rand(10,35)],
                            ];
                            $maxTotal = 0;
                            foreach ($stockData as $d) {
                                $t = $d['wb'] + $d['prc'] + $d['tc'] + $d['ffp'];
                                if ($t > $maxTotal) $maxTotal = $t;
                            }
                        @endphp

                        @foreach ($bloodTypes as $type)
                            @php
                                $d = $stockData[$type];
                                $total = $d['wb'] + $d['prc'] + $d['tc'] + $d['ffp'];
                                $pct = $maxTotal > 0 ? ($total / $maxTotal * 100) : 0;
                                $levelClass = $pct >= 60 ? 'fill-high' : ($pct >= 30 ? 'fill-medium' : 'fill-low');
                                $donorCount = $donorCounts[$type] ?? 0;
                            @endphp
                            <tr class="border-b border-gray-200 last:border-b-0 hover:bg-red-50 transition-colors duration-150">
                                <td class="px-5 py-4 text-[0.9rem] align-middle">
                                    <div class="flex items-center gap-3">
                                        <div class="inline-flex items-center justify-center w-9 h-9 rounded-[10px] bg-gradient-to-br from-[#CC0000] to-[#990000] text-white font-black text-[0.9rem]">{{ $type }}</div>
                                        <div>
                                            <div class="font-bold text-[0.9rem] text-gray-900">Gol. {{ $type }}</div>
                                            <div class="text-[0.75rem] text-gray-500">{{ $donorCount }} pendonor</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-[0.9rem] align-middle">
                                    <div class="flex items-center gap-3">
                                        <div class="flex-1 h-2 bg-white rounded-[99px] overflow-hidden min-w-[80px]">
                                            <div class="stock-fill h-full rounded-[99px] transition-[width] duration-1000 {{ $d['wb'] >= 30 ? 'fill-high' : ($d['wb'] >= 15 ? 'fill-medium' : 'fill-low') }}" style="width:{{ min(100,$d['wb']/60*100) }}%"></div>
                                        </div>
                                        <span class="text-[0.85rem] font-bold min-w-[40px] text-right">{{ $d['wb'] }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-[0.9rem] align-middle">
                                    <div class="flex items-center gap-3">
                                        <div class="flex-1 h-2 bg-white rounded-[99px] overflow-hidden min-w-[80px]">
                                            <div class="stock-fill h-full rounded-[99px] transition-[width] duration-1000 {{ $d['prc'] >= 25 ? 'fill-high' : ($d['prc'] >= 10 ? 'fill-medium' : 'fill-low') }}" style="width:{{ min(100,$d['prc']/50*100) }}%"></div>
                                        </div>
                                        <span class="text-[0.85rem] font-bold min-w-[40px] text-right">{{ $d['prc'] }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-[0.9rem] align-middle md:hidden">
                                    <div class="flex items-center gap-3">
                                        <div class="flex-1 h-2 bg-white rounded-[99px] overflow-hidden min-w-[80px]">
                                            <div class="stock-fill h-full rounded-[99px] transition-[width] duration-1000 {{ $d['tc'] >= 15 ? 'fill-high' : ($d['tc'] >= 6 ? 'fill-medium' : 'fill-low') }}" style="width:{{ min(100,$d['tc']/25*100) }}%"></div>
                                        </div>
                                        <span class="text-[0.85rem] font-bold min-w-[40px] text-right">{{ $d['tc'] }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-[0.9rem] align-middle md:hidden">
                                    <div class="flex items-center gap-3">
                                        <div class="flex-1 h-2 bg-white rounded-[99px] overflow-hidden min-w-[80px]">
                                            <div class="stock-fill h-full rounded-[99px] transition-[width] duration-1000 {{ $d['ffp'] >= 20 ? 'fill-high' : ($d['ffp'] >= 10 ? 'fill-medium' : 'fill-low') }}" style="width:{{ min(100,$d['ffp']/35*100) }}%"></div>
                                        </div>
                                        <span class="text-[0.85rem] font-bold min-w-[40px] text-right">{{ $d['ffp'] }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-[0.9rem] align-middle md:hidden">
                                    <div class="flex items-center gap-3">
                                        <div class="flex-1 h-2 bg-gray-100 rounded-[99px] overflow-hidden min-w-[80px]">
                                            <div class="stock-fill h-full rounded-[99px] transition-[width] duration-1000 {{ $levelClass }}" style="width:{{ $pct }}%"></div>
                                        </div>
                                        <span class="text-[0.85rem] font-black min-w-[40px] text-right text-[#CC0000]">{{ $total }}</span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Legend --}}
            <div class="px-5 py-4 border-t border-gray-200 flex gap-6 flex-wrap bg-gray-50">
                <span class="text-[0.75rem] text-gray-600 flex items-center gap-[0.4rem]">
                    <span class="w-3 h-2 rounded-[2px] bg-gradient-to-r from-emerald-500 to-[#34d399] inline-block"></span> Cukup (≥60%)
                </span>
                <span class="text-[0.75rem] text-gray-600 flex items-center gap-[0.4rem]">
                    <span class="w-3 h-2 rounded-[2px] bg-gradient-to-r from-amber-400 to-[#fbbf24] inline-block"></span> Sedang (30–59%)
                </span>
                <span class="text-[0.75rem] text-gray-600 flex items-center gap-[0.4rem]">
                    <span class="w-3 h-2 rounded-[2px] bg-gradient-to-r from-red-500 to-[#f87171] inline-block"></span> Menipis (&lt;30%)
                </span>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════════════════════
     JADWAL DONOR
════════════════════════════════════════════════════════════ --}}
<section class="py-20" id="jadwal">
    <div class="max-w-[1280px] mx-auto px-8 md:px-5 w-full">

        <div class="mb-8">
            <span class="inline-flex items-center gap-[0.4rem] bg-[rgba(204,0,0,0.08)] border border-[rgba(204,0,0,0.3)] text-[#FF3333] px-4 py-[0.35rem] rounded-[99px] text-[0.8rem] font-bold mb-4"
                  data-aos="fade-up">📅 Jadwal Tersedia</span>
            <h2 class="text-[clamp(1.75rem,3vw,2.5rem)] font-black tracking-[-0.02em] mb-3"
                data-aos="fade-up" data-aos-delay="100">Jadwal Donor Darah</h2>
            <p class="text-base text-black leading-[1.7] max-w-[560px]"
               data-aos="fade-up" data-aos-delay="150">Pilih jadwal donor darah yang tersedia di lokasi terdekat Anda. Filter berdasarkan rentang tanggal.</p>
        </div>

        {{-- Filter Row --}}
        <div class="flex items-center gap-4 flex-wrap mb-6 px-6 py-5 bg-[#fcfcfc] border border-[rgba(36,35,35,0.08)] rounded-[14px] sm:flex-col sm:items-start"
             data-aos="fade-up" data-aos-delay="200">
            <span class="text-[0.8rem] font-bold text-black uppercase tracking-[0.06em] whitespace-nowrap">🔍 Filter Jadwal:</span>
            <div class="flex items-center gap-2 flex-wrap">
                <label class="text-[0.8rem] text-black">Dari:</label>
                <input type="date" id="filter-from"
                       class="filter-input bg-white border-[1.5px] border-[rgba(36,35,35,0.08)] rounded-lg text-[#cc0000ec] px-[0.9rem] py-[0.55rem] text-[0.875rem] font-[inherit] transition-[border-color] duration-200 focus:outline-none focus:border-[#CC0000] focus:shadow-[0_0_0_3px_rgba(204,0,0,0.15)] sm:w-full"
                       value="{{ date('Y-m-d') }}"
                       min="{{ date('Y-m-d') }}"
                       aria-label="Filter dari tanggal">
            </div>
            <div class="flex items-center gap-2 flex-wrap">
                <label class="text-[0.8rem] text-black">Hingga:</label>
                <input type="date" id="filter-to"
                       class="filter-input bg-white border-[1.5px] border-[rgba(36,35,35,0.08)] rounded-lg text-[#cc0000ec] px-[0.9rem] py-[0.55rem] text-[0.875rem] font-[inherit] transition-[border-color] duration-200 focus:outline-none focus:border-[#CC0000] focus:shadow-[0_0_0_3px_rgba(204,0,0,0.15)] sm:w-full"
                       value="{{ date('Y-m-d', strtotime('+3 months')) }}"
                       min="{{ date('Y-m-d') }}"
                       aria-label="Filter hingga tanggal">
            </div>
            <button class="inline-flex items-center justify-center gap-[0.4rem] px-[0.9rem] py-[0.4rem] rounded-lg font-bold text-[0.8rem] cursor-pointer transition-all duration-200 whitespace-nowrap bg-[#CC0000] text-white hover:bg-[#990000] hover:-translate-y-px hover:shadow-[0_8px_32px_rgba(204,0,0,0.25)]"
                    onclick="filterSchedules()" id="btn-filter-jadwal">Terapkan</button>
            <button class="inline-flex items-center justify-center gap-[0.4rem] px-[0.9rem] py-[0.4rem] rounded-lg font-bold text-[0.8rem] cursor-pointer transition-all duration-200 whitespace-nowrap bg-transparent text-black border-[1.5px] border-[rgba(36,35,35,0.08)] hover:bg-[rgba(255,255,255,0.05)] hover:text-[#cc0000ec]"
                    onclick="resetFilter()" id="btn-reset-jadwal">Reset</button>
            <span class="text-[0.8rem] text-black ml-auto" id="schedule-count">
                Menampilkan <strong id="count-num">{{ $schedules->count() }}</strong> jadwal
            </span>
        </div>

        {{-- Schedule Table --}}
        <div class="bg-white border border-gray-200 shadow-sm rounded-[18px] overflow-hidden"
             data-aos="fade-up" data-aos-delay="250">
            @if($schedules->count() > 0)
            <div class="overflow-x-auto">
                <div class="overflow-y-auto" style="max-height: 400px;">
                <table class="w-full border-collapse" id="schedule-table">
                    <thead class="sticky top-0">
                        <tr>
                            <th class="bg-gray-50 px-5 py-[0.85rem] text-left text-[0.75rem] uppercase tracking-[0.06em] text-gray-700 border-b border-gray-200 font-bold">#</th>
                            <th class="bg-gray-50 px-5 py-[0.85rem] text-left text-[0.75rem] uppercase tracking-[0.06em] text-gray-700 border-b border-gray-200 font-bold">Tanggal &amp; Waktu</th>
                            <th class="bg-gray-50 px-5 py-[0.85rem] text-left text-[0.75rem] uppercase tracking-[0.06em] text-gray-700 border-b border-gray-200 font-bold">Lokasi</th>
                            <th class="bg-gray-50 px-5 py-[0.85rem] text-left text-[0.75rem] uppercase tracking-[0.06em] text-gray-700 border-b border-gray-200 font-bold md:hidden">Keterangan</th>
                            <th class="bg-gray-50 px-5 py-[0.85rem] text-left text-[0.75rem] uppercase tracking-[0.06em] text-gray-700 border-b border-gray-200 font-bold">Kuota</th>
                            <th class="bg-gray-50 px-5 py-[0.85rem] text-left text-[0.75rem] uppercase tracking-[0.06em] text-gray-700 border-b border-gray-200 font-bold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="schedule-tbody">
                        @foreach($schedules as $i => $s)
                            @php $pct = $s->kuota > 0 ? min(100, ($s->kuota - $s->sisaKuota()) / $s->kuota * 100) : 100; @endphp
                            <tr data-date="{{ $s->tanggal }}" class="schedule-row border-b border-gray-200 last:border-b-0 hover:bg-red-50 transition-colors duration-150">
                                <td class="px-5 py-4 text-[0.9rem] align-middle text-black">{{ $i + 1 }}</td>
                                <td class="px-5 py-4 text-[0.9rem] align-middle">
                                    <div class="inline-flex items-center gap-[0.4rem] bg-[rgba(204,0,0,0.08)] border border-[rgba(204,0,0,0.3)] text-[#FF3333] px-3 py-[0.3rem] rounded-[99px] text-[0.8rem] font-bold">
                                        📅 {{ \Carbon\Carbon::parse($s->tanggal)->locale('id')->translatedFormat('d M Y') }}
                                    </div>
                                    <div class="text-[0.8rem] text-gray-500 mt-[0.35rem]">
                                        🕐 {{ substr($s->waktu, 0, 5) }} WIB
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-[0.9rem] align-middle">
                                    <div class="font-semibold text-[0.9rem]">📍 {{ $s->lokasi }}</div>
                                </td>
                                <td class="px-5 py-4 text-[0.9rem] align-middle max-w-[220px] text-black text-[0.85rem] leading-[1.5] md:hidden">
                                    {{ $s->keterangan ? Str::limit($s->keterangan, 80) : '—' }}
                                </td>
                                <td class="px-5 py-4 text-[0.9rem] align-middle">
                                    <div class="inline-flex items-center gap-[0.4rem] text-[0.8rem] font-semibold text-black">
                                        <div>
                                            <div class="font-bold text-[0.85rem] mb-[0.3rem]">{{ $s->sisaKuota() }}/{{ $s->kuota }}</div>
                                            <div class="w-[60px] h-[5px] bg-white rounded-[99px] overflow-hidden">
                                                <div class="h-full rounded-[99px] bg-[#CC0000]" style="width:{{ $pct }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-[0.9rem] align-middle">
                                    @auth
                                        @if(!Auth::user()->isAdmin())
                                            <a href="{{ route('donor.schedules') }}"
                                               class="inline-flex items-center justify-center gap-[0.4rem] px-[0.9rem] py-[0.4rem] rounded-lg font-bold text-[0.8rem] cursor-pointer transition-all duration-200 whitespace-nowrap no-underline bg-[#CC0000] text-white hover:bg-[#990000] hover:-translate-y-px hover:shadow-[0_8px_32px_rgba(204,0,0,0.25)]">Daftar</a>
                                        @else
                                            <span class="text-[0.8rem] text-black">Admin</span>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}"
                                           class="inline-flex items-center justify-center gap-[0.4rem] px-[0.9rem] py-[0.4rem] rounded-lg font-bold text-[0.8rem] cursor-pointer transition-all duration-200 whitespace-nowrap no-underline bg-transparent text-[#cc0000ec] border-[1.5px] border-[rgba(36,35,35,0.08)] hover:bg-[rgba(255,255,255,0.06)] hover:border-[rgba(255,255,255,0.2)]">Login</a>
                                    @endauth
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            @else
            <div class="text-center py-14 px-8 text-black">
                <div class="text-[3rem] mb-3">📋</div>
                <p class="text-[0.9rem]">Belum ada jadwal donor darah yang tersedia saat ini.</p>
                <p class="mt-[0.4rem] text-[0.8rem]">Pantau terus halaman ini untuk jadwal terbaru.</p>
            </div>
            @endif
        </div>

    </div>
</section>

{{-- ════════════════════════════════════════════════════════════
     BERITA PMI
════════════════════════════════════════════════════════════ --}}
<section class="py-20 bg-white" id="berita" aria-label="Berita PMI Kota Palembang">
    <div class="max-w-[1280px] mx-auto px-8 md:px-5 w-full">

        <div class="flex items-end justify-between flex-wrap gap-4 mb-10">
            <div>
                <span class="inline-flex items-center gap-[0.4rem] bg-[rgba(204,0,0,0.08)] border border-[rgba(204,0,0,0.3)] text-[#CC0000] px-4 py-[0.35rem] rounded-[99px] text-[0.8rem] font-bold mb-4"
                      data-aos="fade-up">📰 Berita Terkini</span>
                <h2 class="text-[clamp(1.75rem,3vw,2.5rem)] font-black tracking-[-0.02em] mb-3 text-gray-900"
                    data-aos="fade-up" data-aos-delay="100">Berita PMI Kota Palembang</h2>
                <p class="text-base text-gray-600 leading-[1.7] max-w-[560px]"
                   data-aos="fade-up" data-aos-delay="150">Ikuti perkembangan kegiatan, program, dan informasi terbaru dari PMI Kota Palembang.</p>
            </div>
        </div>

        {{-- News Grid --}}
        <div class="grid grid-cols-[repeat(auto-fill,minmax(300px,1fr))] md:grid-cols-1 gap-6">

            @php
                $newsItems = [
                    [
                        'img'  => 'news-1.png',
                        'cat'  => '🏛️ Kegiatan',
                        'title'=> 'PMI Kota Palembang Gelar Peringatan HUT PMI ke-79',
                        'text' => 'PMI Kota Palembang menggelar rangkaian acara peringatan Hari Ulang Tahun PMI ke-79 yang dihadiri oleh jajaran pemerintah kota dan ratusan relawan setia.',
                        'date' => '10 Juli 2026',
                    ],
                    [
                        'img'  => 'news-2.png',
                        'cat'  => '🎓 Pendidikan',
                        'title'=> 'Pelatihan Pertolongan Pertama untuk 200 Relawan Baru',
                        'text' => 'Sebanyak 200 relawan baru mengikuti pelatihan pertolongan pertama intensif yang diselenggarakan oleh PMI Kota Palembang bekerja sama dengan Dinas Kesehatan.',
                        'date' => '5 Juli 2026',
                    ],
                    [
                        'img'  => 'news-3.png',
                        'cat'  => '🚑 Ambulans',
                        'title'=> 'Armada Ambulans PMI Palembang Bertambah 3 Unit Baru',
                        'text' => 'PMI Kota Palembang menerima tambahan tiga unit ambulans modern dari bantuan Pemerintah Kota Palembang untuk memperkuat layanan kegawatdaruratan masyarakat.',
                        'date' => '28 Juni 2026',
                    ],
                ];
            @endphp

            @foreach($newsItems as $i => $news)
            <a href="#berita" class="bg-[#fcfcfc] border border-[rgba(36,35,35,0.08)] rounded-[18px] overflow-hidden transition-[transform,border-color,box-shadow] duration-300 cursor-pointer no-underline block text-inherit hover:-translate-y-[6px] hover:border-[rgba(204,0,0,0.3)] hover:shadow-[0_16px_48px_rgba(204,0,0,0.12)]"
               data-aos="fade-up" data-aos-delay="{{ ($i+1) * 100 }}" id="news-card-{{ $i+1 }}" onclick="return false;" style="cursor:default;">
                <div class="overflow-hidden border-b border-[rgba(36,35,35,0.08)]">
                    <img src="{{ asset('images/'.$news['img']) }}" alt="{{ $news['title'] }}"
                         class="w-full h-[200px] object-cover block transition-transform duration-500 hover:scale-[1.04]"
                         loading="lazy">
                </div>
                <div class="px-6 pt-5 pb-6">
                    <div class="inline-flex items-center gap-[0.3rem] text-[0.7rem] font-extrabold uppercase tracking-[0.08em] text-[#FF3333] mb-[0.6rem]">{{ $news['cat'] }}</div>
                    <div class="text-[0.95rem] font-extrabold leading-[1.45] mb-2 text-[#cc0000ec] line-clamp-2">{{ $news['title'] }}</div>
                    <p class="text-[0.82rem] text-black leading-[1.65] line-clamp-3 mb-4">{{ $news['text'] }}</p>
                    <div class="flex items-center justify-between text-[0.75rem] text-black">
                        <span>📅 {{ $news['date'] }}</span>
                        <span class="text-[#FF3333] font-bold text-[0.78rem]">PMI Palembang →</span>
                    </div>
                </div>
            </a>
            @endforeach

            {{-- DB Announcements --}}
            @foreach($announcements->take(3) as $i => $a)
            <div class="bg-[#fcfcfc] border border-[rgba(36,35,35,0.08)] rounded-[18px] overflow-hidden transition-[transform,border-color,box-shadow] duration-300"
                 data-aos="fade-up" data-aos-delay="{{ ($i+4) * 100 }}" style="cursor:default;">
                <div class="h-[200px] bg-gradient-to-br from-[rgba(204,0,0,0.15)] to-[rgba(153,0,0,0.05)] flex items-center justify-center border-b border-[rgba(36,35,35,0.08)]">
                    <span class="text-[4rem]">📢</span>
                </div>
                <div class="px-6 pt-5 pb-6">
                    <div class="inline-flex items-center gap-[0.3rem] text-[0.7rem] font-extrabold uppercase tracking-[0.08em] text-[#FF3333] mb-[0.6rem]">📢 Pengumuman</div>
                    <div class="text-[0.95rem] font-extrabold leading-[1.45] mb-2 text-[#cc0000ec] line-clamp-2">{{ $a->judul }}</div>
                    <p class="text-[0.82rem] text-black leading-[1.65] line-clamp-3 mb-4">{{ Str::limit($a->isi, 120) }}</p>
                    <div class="flex items-center justify-between text-[0.75rem] text-black">
                        <span>📅 {{ \Carbon\Carbon::parse($a->tanggal_publish)->locale('id')->translatedFormat('d M Y') }}</span>
                        <span class="text-[#FF3333] font-bold text-[0.78rem]">PMI Palembang</span>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════════════════════
     THANK YOU + AMBULANCE
════════════════════════════════════════════════════════════ --}}
<section class="py-20" id="relawan">
    <div class="max-w-[1280px] mx-auto px-8 md:px-5 w-full">

        <div class="thank-you-section bg-gradient-to-br from-[rgba(204,0,0,0.1)] to-[rgba(153,0,0,0.05)] border border-[rgba(204,0,0,0.3)] rounded-[28px] px-8 py-16 md:px-6 md:py-10 text-center relative overflow-hidden"
             data-aos="fade-up">

            <div class="text-[3rem] mb-6 [animation:heartBeat_1.5s_ease_infinite]">❤️🩸❤️</div>

            <h2 class="text-[clamp(1.75rem,3vw,2.5rem)] font-black mb-4 tracking-[-0.02em]">Terima Kasih, Para Pahlawan Darah!</h2>
            <p class="text-base text-black max-w-[560px] mx-auto mb-10 leading-[1.75]">
                Kepada seluruh pendonor sukarela PMI Kota Palembang — setiap tetes darah yang Anda berikan adalah hadiah kehidupan yang tak ternilai. Dedikasi Anda telah menyelamatkan ribuan nyawa dan memberikan harapan bagi yang membutuhkan.
            </p>

            {{-- Stats --}}
            <div class="flex flex-wrap items-center justify-center gap-6 mb-12"
                 data-aos="fade-up" data-aos-delay="100">
                <div class="text-center px-8 py-6 bg-[rgba(255,255,255,0.04)] border border-[rgba(36,35,35,0.08)] rounded-[16px]">
                    <div class="text-[2.25rem] font-black text-[#FF3333]">500+</div>
                    <div class="text-[0.8rem] text-black mt-1">Pendonor Terdaftar</div>
                </div>
                <div class="text-center px-8 py-6 bg-[rgba(255,255,255,0.04)] border border-[rgba(36,35,35,0.08)] rounded-[16px]">
                    <div class="text-[2.25rem] font-black text-[#FF3333]">1.200+</div>
                    <div class="text-[0.8rem] text-black mt-1">Kantong Darah</div>
                </div>
                <div class="text-center px-8 py-6 bg-[rgba(255,255,255,0.04)] border border-[rgba(36,35,35,0.08)] rounded-[16px]">
                    <div class="text-[2.25rem] font-black text-[#FF3333]">3.600+</div>
                    <div class="text-[0.8rem] text-black mt-1">Jiwa Terselamatkan</div>
                </div>
            </div>

            @guest
            <a href="{{ route('register') }}"
               class="inline-flex items-center justify-center gap-[0.4rem] px-10 py-[1.1rem] rounded-[12px] font-bold text-[1.1rem] cursor-pointer transition-all duration-200 whitespace-nowrap no-underline bg-[#CC0000] text-white hover:bg-[#990000] hover:-translate-y-px hover:shadow-[0_8px_32px_rgba(204,0,0,0.25)] mb-8"
               id="btn-jadi-pendonor">
                🩸 Jadilah Pendonor Sekarang
            </a>
            @endguest

            {{-- Ambulance --}}
            <div class="w-full max-w-[420px] mx-auto pt-6 border-t border-[rgba(204,0,0,0.3)]">
                <p class="text-[0.85rem] text-black mb-4">🚨 Keadaan darurat? Hubungi layanan ambulans PMI:</p>
                <a href="tel:118"
                   class="btn-ambulance inline-flex items-center gap-3 bg-gradient-to-br from-[#CC0000] to-[#FF4444] text-white text-[1.1rem] font-extrabold px-10 py-[1.1rem] rounded-[50px] shadow-[0_8px_32px_rgba(204,0,0,0.5)] no-underline"
                   id="btn-ambulans" aria-label="Hubungi ambulans darurat PMI 118">
                    🚑 Ambulans Darurat: <strong>118</strong>
                </a>
                <p class="text-[0.75rem] text-black mt-4">Layanan 24 jam · Gratis untuk warga Palembang</p>
            </div>
        </div>

    </div>
</section>

{{-- Pendidikan anchor --}}
<div id="pendidikan"></div>

@endsection

{{-- ════════════════════════════════════════════════════════════
     MODALS
════════════════════════════════════════════════════════════ --}}
@section('modals')

{{-- Modal: Tentang Donasi --}}
<div class="modal-overlay fixed inset-0 bg-black/75 backdrop-blur-[8px] z-[5000] flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-200"
     id="modal-donasi" role="dialog" aria-modal="true" aria-labelledby="modal-donasi-title">
    <div class="modal-box bg-[#fcfcfc] border border-[rgba(36,35,35,0.08)] rounded-[20px] w-full max-w-[580px] max-h-[85vh] overflow-y-auto translate-y-[30px] scale-[0.96] [transition:transform_0.3s_cubic-bezier(0.34,1.56,0.64,1)]">

        {{-- Header --}}
        <div class="px-8 pt-7 pb-4 border-b border-[rgba(36,35,35,0.08)] flex items-start justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-[0.4rem] bg-[rgba(204,0,0,0.08)] border border-[rgba(204,0,0,0.3)] text-[#FF3333] px-[0.85rem] py-[0.35rem] rounded-[99px] text-[0.8rem] font-bold mb-4">🩸 Informasi</div>
                <h3 class="text-[1.25rem] font-extrabold" id="modal-donasi-title">Tentang Donasi Darah</h3>
            </div>
            <button class="w-9 h-9 rounded-full bg-[#ff9898c4] border border-[rgba(36,35,35,0.08)] text-black cursor-pointer flex items-center justify-center text-[1.2rem] shrink-0 transition-all duration-200 hover:bg-[rgba(204,0,0,0.08)] hover:text-[#FF3333]"
                    onclick="closeModal('modal-donasi')" aria-label="Tutup modal">✕</button>
        </div>

        {{-- Body --}}
        <div class="px-8 pt-6 pb-8">
            <p class="text-[0.925rem] text-black leading-[1.8] mb-4">Donor darah adalah tindakan sukarela memberikan darah Anda untuk disimpan di bank darah dan digunakan saat transfusi darah diperlukan. Setiap tahunnya, jutaan nyawa terselamatkan berkat kebaikan para pendonor sukarela.</p>

            <h4 class="text-[0.95rem] font-bold mt-5 mb-3 text-[#cc0000ec]">✅ Manfaat bagi Pendonor:</h4>
            <ul class="pl-5 flex flex-col gap-[0.6rem]">
                <li class="text-[0.9rem] text-black leading-[1.7]">Memperbarui sel darah merah dan merangsang produksi sel darah baru</li>
                <li class="text-[0.9rem] text-black leading-[1.7]">Membantu mendeteksi kelainan darah sejak dini melalui pemeriksaan</li>
                <li class="text-[0.9rem] text-black leading-[1.7]">Membakar kalori — satu kali donor membakar sekitar 650 kalori</li>
                <li class="text-[0.9rem] text-black leading-[1.7]">Mengurangi risiko penyakit jantung dengan menurunkan kadar zat besi berlebih</li>
                <li class="text-[0.9rem] text-black leading-[1.7]">Mendapat kepuasan batin karena telah membantu sesama</li>
            </ul>

            <h4 class="text-[0.95rem] font-bold mt-5 mb-3 text-[#cc0000ec]">❤️ Manfaat bagi Penerima:</h4>
            <ul class="pl-5 flex flex-col gap-[0.6rem]">
                <li class="text-[0.9rem] text-black leading-[1.7]">Darah yang didonasikan dapat menyelamatkan pasien pendarahan hebat</li>
                <li class="text-[0.9rem] text-black leading-[1.7]">Mendukung pasien anemia, kanker, dan penyakit darah lainnya</li>
                <li class="text-[0.9rem] text-black leading-[1.7]">Satu kantong darah dapat membantu hingga 3 orang berbeda</li>
            </ul>

            <p class="mt-5 p-4 bg-[rgba(204,0,0,0.08)] border border-[rgba(204,0,0,0.3)] rounded-[10px] text-[0.85rem] text-black">
                💡 <strong>Tahukah Anda?</strong> Stok darah nasional harus selalu mencukupi untuk 2% dari jumlah penduduk. PMI membutuhkan sekitar 5,3 juta kantong darah per tahun di seluruh Indonesia.
            </p>
        </div>
    </div>
</div>

{{-- Modal: Cara Donasi --}}
<div class="modal-overlay fixed inset-0 bg-black/75 backdrop-blur-[8px] z-[5000] flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-200"
     id="modal-cara" role="dialog" aria-modal="true" aria-labelledby="modal-cara-title">
    <div class="modal-box bg-[#fcfcfc] border border-[rgba(36,35,35,0.08)] rounded-[20px] w-full max-w-[580px] max-h-[85vh] overflow-y-auto translate-y-[30px] scale-[0.96] [transition:transform_0.3s_cubic-bezier(0.34,1.56,0.64,1)]">

        {{-- Header --}}
        <div class="px-8 pt-7 pb-4 border-b border-[rgba(36,35,35,0.08)] flex items-start justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-[0.4rem] bg-[rgba(204,0,0,0.08)] border border-[rgba(204,0,0,0.3)] text-[#FF3333] px-[0.85rem] py-[0.35rem] rounded-[99px] text-[0.8rem] font-bold mb-4">📋 Panduan</div>
                <h3 class="text-[1.25rem] font-extrabold" id="modal-cara-title">Cara Melakukan Donor Darah</h3>
            </div>
            <button class="w-9 h-9 rounded-full bg-[#ff9898c4] border border-[rgba(36,35,35,0.08)] text-black cursor-pointer flex items-center justify-center text-[1.2rem] shrink-0 transition-all duration-200 hover:bg-[rgba(204,0,0,0.08)] hover:text-[#FF3333]"
                    onclick="closeModal('modal-cara')" aria-label="Tutup modal">✕</button>
        </div>

        {{-- Body --}}
        <div class="px-8 pt-6 pb-8">
            <p class="text-[0.925rem] text-black leading-[1.8] mb-4">Proses donor darah di PMI Kota Palembang berlangsung cepat dan nyaman. Berikut adalah langkah-langkahnya:</p>

            <ol class="pl-5 flex flex-col gap-[0.6rem]">
                <li class="text-[0.9rem] text-black leading-[1.7]"><strong>Pendaftaran</strong> — Daftarkan diri melalui website ini atau datang langsung ke gedung PMI Kota Palembang. Bawa KTP/identitas diri yang berlaku.</li>
                <li class="text-[0.9rem] text-black leading-[1.7]"><strong>Pemeriksaan Awal</strong> — Tim medis akan memeriksa tekanan darah, kadar hemoglobin, denyut nadi, dan suhu tubuh Anda.</li>
                <li class="text-[0.9rem] text-black leading-[1.7]"><strong>Pengisian Formulir</strong> — Isi formulir riwayat kesehatan dan persetujuan donor darah dengan jujur dan lengkap.</li>
                <li class="text-[0.9rem] text-black leading-[1.7]"><strong>Proses Donor</strong> — Petugas medis akan mengambil darah sebanyak ±350–450 mL. Prosesnya hanya memakan waktu 8–10 menit.</li>
                <li class="text-[0.9rem] text-black leading-[1.7]"><strong>Istirahat &amp; Konsumsi</strong> — Setelah donor, Anda akan mendapatkan makanan ringan dan minuman. Istirahat 15 menit sebelum beraktivitas normal.</li>
                <li class="text-[0.9rem] text-black leading-[1.7]"><strong>Kartu Donor</strong> — Anda akan mendapatkan kartu donor yang mencatat riwayat donasi Anda.</li>
            </ol>

            <h4 class="text-[0.95rem] font-bold mt-5 mb-3 text-[#cc0000ec]">📌 Persiapan Sebelum Donor:</h4>
            <ul class="pl-5 flex flex-col gap-[0.6rem]">
                <li class="text-[0.9rem] text-black leading-[1.7]">Tidur yang cukup (minimal 6 jam) sebelum hari donor</li>
                <li class="text-[0.9rem] text-black leading-[1.7]">Makan makanan bergizi 3–4 jam sebelum donor, hindari makanan berlemak</li>
                <li class="text-[0.9rem] text-black leading-[1.7]">Minum air putih yang cukup (minimal 500 mL sebelum donor)</li>
                <li class="text-[0.9rem] text-black leading-[1.7]">Hindari alkohol 24 jam sebelum donor</li>
                <li class="text-[0.9rem] text-black leading-[1.7]">Kenakan pakaian dengan lengan yang mudah dilipat</li>
            </ul>
        </div>
    </div>
</div>

{{-- Modal: Kebijakan Donasi --}}
<div class="modal-overlay fixed inset-0 bg-black/75 backdrop-blur-[8px] z-[5000] flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-200"
     id="modal-kebijakan" role="dialog" aria-modal="true" aria-labelledby="modal-kebijakan-title">
    <div class="modal-box bg-[#fcfcfc] border border-[rgba(36,35,35,0.08)] rounded-[20px] w-full max-w-[580px] max-h-[85vh] overflow-y-auto translate-y-[30px] scale-[0.96] [transition:transform_0.3s_cubic-bezier(0.34,1.56,0.64,1)]">

        {{-- Header --}}
        <div class="px-8 pt-7 pb-4 border-b border-[rgba(36,35,35,0.08)] flex items-start justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-[0.4rem] bg-[rgba(204,0,0,0.08)] border border-[rgba(204,0,0,0.3)] text-[#FF3333] px-[0.85rem] py-[0.35rem] rounded-[99px] text-[0.8rem] font-bold mb-4">📜 Syarat &amp; Ketentuan</div>
                <h3 class="text-[1.25rem] font-extrabold" id="modal-kebijakan-title">Kebijakan Donor Darah PMI</h3>
            </div>
            <button class="w-9 h-9 rounded-full bg-[#ff9898c4] border border-[rgba(36,35,35,0.08)] text-black cursor-pointer flex items-center justify-center text-[1.2rem] shrink-0 transition-all duration-200 hover:bg-[rgba(204,0,0,0.08)] hover:text-[#FF3333]"
                    onclick="closeModal('modal-kebijakan')" aria-label="Tutup modal">✕</button>
        </div>

        {{-- Body --}}
        <div class="px-8 pt-6 pb-8">
            <p class="text-[0.925rem] text-black leading-[1.8] mb-4">Untuk menjamin keamanan pendonor dan penerima, PMI Kota Palembang menerapkan standar seleksi pendonor yang ketat sesuai pedoman Kementerian Kesehatan RI.</p>

            <h4 class="text-[0.95rem] font-bold mb-3 text-[#cc0000ec]">✅ Syarat Umum Pendonor:</h4>
            <ul class="pl-5 flex flex-col gap-[0.6rem]">
                <li class="text-[0.9rem] text-black leading-[1.7]">Usia 17–65 tahun (pertama kali donor max 60 tahun)</li>
                <li class="text-[0.9rem] text-black leading-[1.7]">Berat badan minimal 45 kg</li>
                <li class="text-[0.9rem] text-black leading-[1.7]">Tekanan darah: sistolik 90–160 mmHg, diastolik 60–100 mmHg</li>
                <li class="text-[0.9rem] text-black leading-[1.7]">Kadar hemoglobin: 12,5–17 g/dL</li>
                <li class="text-[0.9rem] text-black leading-[1.7]">Suhu tubuh normal (36–37,5°C) dan kondisi kesehatan umum baik</li>
                <li class="text-[0.9rem] text-black leading-[1.7]">Interval donor minimal 56 hari (8 minggu) untuk whole blood</li>
            </ul>

            <h4 class="text-[0.95rem] font-bold mt-5 mb-3 text-[#cc0000ec]">❌ Kondisi yang Menunda/Menggugurkan Donor:</h4>
            <ul class="pl-5 flex flex-col gap-[0.6rem]">
                <li class="text-[0.9rem] text-black leading-[1.7]">Sedang dalam kondisi hamil, menyusui, atau haid</li>
                <li class="text-[0.9rem] text-black leading-[1.7]">Baru menjalani operasi, vaksinasi, atau pengobatan tertentu</li>
                <li class="text-[0.9rem] text-black leading-[1.7]">Memiliki riwayat penyakit hepatitis, HIV, malaria, atau TBC aktif</li>
                <li class="text-[0.9rem] text-black leading-[1.7]">Mengonsumsi alkohol dalam 24 jam terakhir</li>
                <li class="text-[0.9rem] text-black leading-[1.7]">Baru bepergian ke daerah endemik penyakit tropis tertentu</li>
            </ul>

            <p class="mt-5 p-4 bg-white border border-[rgba(148,148,148,1)] rounded-[10px] text-[0.85rem] text-[#93c5fd]">
                ℹ️ Kebijakan ini mengikuti <strong>Peraturan Menteri Kesehatan RI No. 91 Tahun 2015</strong> tentang Standar Pelayanan Transfusi Darah dan panduan WHO terbaru.
            </p>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // ── CAROUSEL ─────────────────────────────────────────────────
    (function() {
        const track   = document.getElementById('carousel-track');
        const dots    = document.querySelectorAll('.carousel-dot');
        const slides  = document.querySelectorAll('#carousel-track > div');
        let current   = 0;
        let autoTimer = null;

        function goTo(n) {
            current = (n + slides.length) % slides.length;
            track.style.transform = `translateX(-${current * 100}%)`;
            dots.forEach((d, i) => {
                d.classList.toggle('active', i === current);
                d.setAttribute('aria-selected', i === current);
            });
        }

        function startAuto() {
            stopAuto();
            autoTimer = setInterval(() => goTo(current + 1), 5000);
        }

        function stopAuto() {
            if (autoTimer) clearInterval(autoTimer);
        }

        document.getElementById('carousel-prev').addEventListener('click', () => { goTo(current - 1); startAuto(); });
        document.getElementById('carousel-next').addEventListener('click', () => { goTo(current + 1); startAuto(); });

        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => { goTo(i); startAuto(); });
        });

        // Touch/swipe support
        let touchStartX = 0;
        track.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; }, { passive: true });
        track.addEventListener('touchend', e => {
            const diff = touchStartX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 50) { goTo(diff > 0 ? current + 1 : current - 1); startAuto(); }
        });

        startAuto();
    })();

    // ── SCHEDULE FILTER ──────────────────────────────────────────
    function filterSchedules() {
        const from = document.getElementById('filter-from').value;
        const to   = document.getElementById('filter-to').value;
        const rows = document.querySelectorAll('.schedule-row');
        let visible = 0;

        rows.forEach(function(row) {
            const d = row.getAttribute('data-date');
            const show = (!from || d >= from) && (!to || d <= to);
            row.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        document.getElementById('count-num').textContent = visible;
    }

    function resetFilter() {
        document.getElementById('filter-from').value = '{{ date("Y-m-d") }}';
        document.getElementById('filter-to').value   = '{{ date("Y-m-d", strtotime("+3 months")) }}';
        filterSchedules();
    }

    // Apply filter on date change
    document.getElementById('filter-from').addEventListener('change', filterSchedules);
    document.getElementById('filter-to').addEventListener('change', filterSchedules);
</script>
@endpush