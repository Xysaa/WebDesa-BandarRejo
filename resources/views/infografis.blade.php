@extends('layouts.app')
@section('title', 'Infografis Desa')

@section('content')
<!-- Hero Section -->
<section class="bg-gray-100 py-4 px-8 md:px-12 lg:px-16">
    <div class="container mx-auto max-w-7xl">
        <!-- Judul Utama -->
        <h2 class="text-5xl md:text-6xl font-extrabold text-green-700 leading-tight mb-0 flex flex-col justify-center">
            <span>DATA INFOGRAFIS DESA</span>
            <span>BANDAR REJO</span>
        </h2>
        <div class="border-b-2 border-gray-300 mt-2 mb-4"></div>
    </div>
</section>

<!-- Demografi Section -->
<section class="bg-gray-100 pt-6 pb-12 px-8 md:px-12 lg:px-16">

  <!-- Bagian dengan background image -->
  <div class="relative max-w-7xl mx-auto rounded-lg overflow-hidden" style="background-image: url('{{ asset('images/aset infografis/background.jpg') }}'); background-size: cover; background-position: center;">

    <!-- Overlay gelap -->
    <div class="absolute inset-0 bg-black/40 pointer-events-none"></div>

    <!-- Konten utama dengan teks putih -->
    <div class="relative grid md:grid-cols-2 gap-8 items-center py-6 px-8 md:px-12 lg:px-16">
      <div>
        <h3 class="text-5xl font-bold text-white mb-4">DEMOGRAFI PENDUDUK</h3>
        <p class="text-xl text-white leading-relaxed">
          Memberikan informasi lengkap mengenai karakteristik demografi penduduk Desa Bandar Rejo.
          Data di bawah ini diambil secara langsung dari sistem administrasi kependudukan desa,
          meliputi jumlah penduduk, kepala keluarga, komposisi jenis kelamin, kelompok umur,
          tingkat pendidikan, pekerjaan, agama, serta status perkawinan.
        </p>
      </div>
      <div class="flex justify-end">
        <img src="{{ asset('images/aset infografis/Demografi.png') }}" alt="Demografi" class="w-full max-w-md relative z-10">
      </div>
    </div>
  </div>

  <!-- Bagian tanpa background image -->
  <div class="max-w-7xl mx-auto mt-12">
    <h4 class="text-4xl font-bold text-green-700 mb-6">Jumlah Penduduk dan Kepala Keluarga</h4>
    <div class="grid md:grid-cols-2 gap-6 mb-8">
      <div class="bg-white/50 backdrop-blur rounded-lg shadow p-6 flex items-center gap-6 transition-transform duration-200 hover:-translate-y-1 hover:shadow-md">
        <img src="{{ asset('images/aset infografis/Total Penduduk.png') }}" alt="Population" class="w-34 h-24">
        <div>
          <p class="text-2xl text-gray-700">TOTAL PENDUDUK</p>
          <p class="text-4xl">
            <span class="text-green-700 font-semibold counter" data-target="{{ $totalPenduduk }}">0</span>
            <span class="text-gray-700">Jiwa</span>
          </p>
        </div>
      </div>

      <div class="bg-white/50 backdrop-blur rounded-lg shadow p-6 flex items-center gap-6 transition-transform duration-200 hover:-translate-y-1 hover:shadow-md">
        <img src="{{ asset('images/aset infografis/Kepala Keluarga.png') }}" alt="Family" class="w-34 h-24">
        <div>
          <p class="text-2xl text-gray-700">KEPALA KELUARGA</p>
          <p class="text-4xl">
            <span class="text-green-700 font-semibold counter" data-target="{{ $kepalaKeluarga }}">0</span>
            <span class="text-gray-700">KK</span>
          </p>
        </div>
      </div>

      <div class="bg-white/50 backdrop-blur rounded-lg shadow p-6 flex items-center gap-6 transition-transform duration-200 hover:-translate-y-1 hover:shadow-md">
        <img src="{{ asset('images/aset infografis/Perempuan.png') }}" alt="Female" class="w-34 h-24">
        <div>
          <p class="text-2xl text-gray-700">PEREMPUAN</p>
          <p class="text-4xl">
            <span class="text-green-700 font-semibold counter" data-target="{{ $perempuan }}">0</span>
            <span class="text-gray-700">Jiwa</span>
          </p>
        </div>
      </div>

      <div class="bg-white/50 backdrop-blur rounded-lg shadow p-6 flex items-center gap-6 transition-transform duration-200 hover:-translate-y-1 hover:shadow-md">
        <img src="{{ asset('images/aset infografis/laki-laki.png') }}" alt="Male" class="w-34 h-24">
        <div>
          <p class="text-2xl text-gray-700">LAKI-LAKI</p>
          <p class="text-4xl">
            <span class="text-green-700 font-semibold counter" data-target="{{ $lakiLaki }}">0</span>
            <span class="text-gray-700">Jiwa</span>
          </p>
        </div>
      </div>
    </div>
  </div>

</section>

<!-- Chart Section - Berdasarkan Kelompok Umur -->
<section class="bg-gray-100 py-6 px-8 md:px-12 lg:px-16">
    <div class="container mx-auto max-w-7xl">
        <h4 class="text-4xl font-bold text-green-700 mb-4">Berdasarkan Kelompok Umur</h4>

        <!-- Chart -->
        <div class="bg-white/50 backdrop-blur rounded-lg shadow p-5 mb-5">
            <div class="h-[420px]">
                <canvas id="ageGroupChart"></canvas>
            </div>
        </div>

        <!-- Info Boxes (deskripsi dinamis sederhana) -->
        <div class="space-y-3">
            @if($ageSummary['male']['top_label'])
            <div class="bg-white/50 backdrop-blur rounded-lg shadow p-5 border-b-4 border-green-700">
                <p class="text-base md:text-lg text-gray-800 leading-relaxed">
                    Untuk jenis kelamin laki-laki, kelompok umur
                    <span class="font-bold">{{ $ageSummary['male']['top_label'] }}</span>
                    merupakan kelompok dengan jumlah tertinggi yaitu
                    <span class="font-bold">{{ $ageSummary['male']['top_value'] }} orang</span>.
                </p>
            </div>
            @endif

            @if($ageSummary['female']['top_label'])
            <div class="bg-white/50 backdrop-blur rounded-lg shadow p-5 border-b-4 border-orange-300">
                <p class="text-base md:text-lg text-gray-800 leading-relaxed">
                    Untuk jenis kelamin perempuan, kelompok umur
                    <span class="font-bold">{{ $ageSummary['female']['top_label'] }}</span>
                    merupakan kelompok dengan jumlah tertinggi yaitu
                    <span class="font-bold">{{ $ageSummary['female']['top_value'] }} orang</span>.
                </p>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- By Village Section - Berdasarkan Dusun -->
<section class="bg-gray-100 py-8 px-4 md:px-8 lg:px-12">
  <div class="container mx-auto max-w-7xl">
    <h4 class="text-3xl md:text-4xl font-bold text-green-700 mb-6">Berdasarkan Dusun</h4>
    <div class="grid md:grid-cols-5 gap-8 items-start">
      <!-- Chart -->
      <div class="md:col-span-3 flex justify-center">
        <div style="width: 100%; max-width: 550px; position: relative;">
          <canvas id="dusunChart"></canvas>
        </div>
      </div>
      <!-- Keterangan -->
      <div class="md:col-span-2 space-y-2 md:pl-4">
        <p class="text-xl font-bold text-gray-800 mb-4">Keterangan:</p>
        <div id="keteranganDusun" class="space-y-1">
          @foreach($dusunChart as $dusun)
            <p class="text-base text-gray-700">
              {{ $dusun['name'] }} : {{ $dusun['count'] }} Jiwa
            </p>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Occupation Section - Berdasarkan Pekerjaan -->
<section class="bg-gray-100 py-12 px-8 md:px-12 lg:px-16">
    <div class="container mx-auto max-w-7xl">
        <h4 class="text-4xl font-bold text-green-700 mb-6">Berdasarkan Pekerjaan (Top 6)</h4>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach($topPekerjaan as $job)
                <div class="bg-white/50 backdrop-blur rounded-lg shadow p-8 text-center transition-transform duration-200 hover:-translate-y-1 hover:shadow-md">
                    <p class="text-lg text-gray-700 font-semibold mb-2">{{ $job->nama }}</p>
                    <p class="text-4xl font-bold text-gray-700">{{ $job->total }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Education Section - Berdasarkan Pendidikan -->
<section class="bg-gray-100 py-6 px-8 md:px-12 lg:px-16">
    <div class="container mx-auto max-w-7xl">
        <h4 class="text-4xl font-bold text-green-700 mb-4">Berdasarkan Pendidikan</h4>
        <div class="bg-white/50 backdrop-blur rounded-lg shadow p-5">
            <div class="h-[550px]">
                <canvas id="educationChart"></canvas>
            </div>
        </div>
    </div>
</section>

<!-- Marital Status Section - Berdasarkan Perkawinan -->
<section class="bg-gray-100 py-12 px-8 md:px-12 lg:px-16">
    <div class="container mx-auto max-w-7xl">
        <h4 class="text-4xl font-bold text-green-700 mb-8">Berdasarkan Perkawinan</h4>

        @php
            $perkawinanIcons = [
                'Belum Kawin'            => 'images/aset infografis/belumkawin.png',
                'Kawin'                  => 'images/aset infografis/kawin.png',
                'Cerai Mati'             => 'images/aset infografis/mt.png',
                'Kawin Tercatat'         => 'images/aset infografis/kawintercatat.png',
                'Cerai Hidup'            => 'images/aset infografis/Cerai Hidup.png',
                'Kawin Tidak Tercatat'   => 'images/aset infografis/kawin tak tercatat.png',
            ];
        @endphp

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($perkawinanCounts as $status)
            <div class="bg-white/70 backdrop-blur rounded-lg shadow p-6 flex items-center gap-6 transition-transform duration-200 hover:-translate-y-1 hover:shadow-md">
                <div class="flex-shrink-0 w-20 h-20">
                    <img src="{{ asset($perkawinanIcons[$status->perkawinan] ?? 'images/kades-dummy.jpg') }}"
                         alt="{{ $status->perkawinan }}"
                         class="w-full h-full object-contain">
                </div>
                <div class="flex flex-col">
                    <p class="text-lg md:text-xl font-medium text-gray-700">{{ $status->perkawinan }}</p>
                    <p class="text-3xl md:text-4xl font-semibold text-emerald-600 leading-tight">{{ $status->total }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Religion Section - Berdasarkan Agama -->
<section class="bg-gray-100 py-12 px-8 md:px-12 lg:px-16">
    <div class="container mx-auto max-w-7xl">
        <h4 class="text-4xl font-bold text-green-700 mb-8">Berdasarkan Agama</h4>

        @php
            $agamaIcons = [
                'Islam'               => 'images/aset infografis/islam.png',
                'Katolik'             => 'images/aset infografis/katolik.png',
                'Hindu'               => 'images/aset infografis/hindu.png',
                'Budha'               => 'images/aset infografis/budha.png',
                'Konghucu'            => 'images/aset infografis/konghucu.png',
                'Kristen'             => 'images/aset infografis/kristen.png',
                'Kepercayaan Lainnya' => 'images/aset infografis/kepercayaan lain.png',
            ];
        @endphp

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 place-items-center">
            @foreach($agamaCounts as $agama)
            <div class="bg-white/70 backdrop-blur rounded-lg shadow p-6 flex items-center gap-6 w-full max-w-sm transition-transform duration-200 hover:-translate-y-1 hover:shadow-md">
                <div class="flex-shrink-0 w-20 h-20">
                    <img src="{{ asset($agamaIcons[$agama->agama] ?? 'images/kades-dummy.jpg') }}"
                         alt="{{ $agama->agama }}"
                         class="w-full h-full object-contain">
                </div>
                <div class="flex flex-col">
                    <p class="text-lg md:text-xl font-medium text-gray-700">{{ $agama->agama }}</p>
                    <p class="text-3xl md:text-4xl font-semibold text-emerald-600 leading-tight">{{ $agama->total }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Stunting, Bansos: sementara masih statis karena belum ada di tabel penduduks --}}
<!-- Stunting Section - Jumlah Stunting per Dusun -->
<section class="bg-gray-100 py-12 px-8 md:px-12 lg:px-16">
    <div class="container mx-auto max-w-7xl">
        <h4 class="text-4xl font-bold text-green-700 mb-8">Jumlah Stunting Per Dusun</h4>

        @php
        $stuntingDusun = [
            ['name' => 'Dusun 1', 'count' => 12, 'icon' => 'images/aset infografis/1.png'],
            ['name' => 'Dusun 2', 'count' => 8,  'icon' => 'images/aset infografis/3.png'],
            ['name' => 'Dusun 3', 'count' => 5,  'icon' => 'images/aset infografis/1.png'],
            ['name' => 'Dusun 4', 'count' => 9,  'icon' => 'images/aset infografis/3.png'],
            ['name' => 'Dusun 5', 'count' => 7,  'icon' => 'images/aset infografis/1.png'],
            ['name' => 'Dusun 6', 'count' => 3,  'icon' => 'images/aset infografis/3.png'],
            ['name' => 'Dusun 7', 'count' => 4,  'icon' => 'images/aset infografis/3.png'],
        ];
        @endphp

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 place-items-center">
            @foreach($stuntingDusun as $dusun)
            <div class="bg-white/70 backdrop-blur rounded-lg shadow p-6 flex items-center gap-6 w-full max-w-sm transition-transform duration-200 hover:-translate-y-1 hover:shadow-md">
                <div class="flex-shrink-0 w-20 h-20">
                    <img src="{{ asset($dusun['icon']) }}" alt="{{ $dusun['name'] }}" class="w-full h-full object-contain">
                </div>
                <div class="flex flex-col">
                    <p class="text-lg md:text-xl font-medium text-gray-700">{{ $dusun['name'] }}</p>
                    <p class="text-3xl md:text-4xl font-semibold text-emerald-600 leading-tight">{{ $dusun['count'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Bantuan Sosial Section - Jumlah Bantuan Sosial -->
<section class="bg-gray-100 py-12 px-8 md:px-12 lg:px-16">
  <div class="container mx-auto max-w-7xl">
    <h4 class="text-4xl font-bold text-green-700 mb-8">Jumlah Bantuan Sosial</h4>

    @php
    $bansosPrograms = [
      ['name' => 'Program Keluarga Harapan',          'count' => 120, 'icon' => 'images/aset infografis/pkh.png'],
      ['name' => 'Bantuan Pangan Non Tunai',         'count' => 98,  'icon' => 'images/aset infografis/bpnt.png'],
      ['name' => 'Program Indonesia Pintar',         'count' => 75,  'icon' => 'images/aset infografis/pip.png'],
      ['name' => 'Jaminan Kesehatan Nasional-KIS',   'count' => 150, 'icon' => 'images/aset infografis/jkn-kis.png'],
      ['name' => 'Bantuan Langsung Tunai',           'count' => 60,  'icon' => 'images/aset infografis/blt.png'],
    ];
    @endphp

    <div class="flex flex-wrap justify-evenly gap-6">
      @foreach($bansosPrograms as $program)
      <div class="bg-white/70 backdrop-blur rounded-lg shadow p-6 flex items-center gap-6 w-full sm:w-[48%] lg:w-[31%] transition-transform duration-200 hover:-translate-y-1 hover:shadow-md">
        <div class="flex-shrink-0 w-20 h-20">
          <img src="{{ asset($program['icon']) }}" alt="{{ $program['name'] }}" class="w-full h-full object-contain">
        </div>
        <div class="flex flex-col">
          <p class="text-lg md:text-xl font-medium text-gray-700">{{ $program['name'] }}</p>
          <p class="text-3xl md:text-4xl font-semibold text-emerald-600 leading-tight">{{ $program['count'] }}</p>
        </div>
      </div>
      @endforeach
    </div>

  </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===================== COUNTER ANIMATION =====================
    function animateCounter(element) {
        const target = parseInt(element.getAttribute('data-target') || '0');
        const duration = 2000;
        const increment = target / (duration / 16);
        let current = 0;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target;
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current);
            }
        }, 16);
    }

    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                entry.target.classList.add('animated');
                animateCounter(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.counter').forEach(counter => {
        observer.observe(counter);
    });

    // ===================== AGE GROUP BAR CHART =====================
    const ageLabels = @json($ageChart['labels']);
    const ageMale   = @json($ageChart['male']);
    const ageFemale = @json($ageChart['female']);

    const ageCtx = document.getElementById('ageGroupChart');
    if (ageCtx) {
        new Chart(ageCtx, {
            type: 'bar',
            data: {
                labels: ageLabels,
                datasets: [
                    {
                        label: 'Laki-laki',
                        data: ageMale,
                        backgroundColor: 'rgba(21, 128, 61, 0.8)',
                        borderColor: 'rgb(21, 128, 61)',
                        borderWidth: 1
                    },
                    {
                        label: 'Perempuan',
                        data: ageFemale,
                        backgroundColor: 'rgba(253, 186, 116, 0.8)',
                        borderColor: 'rgb(253, 186, 116)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 1500,
                    easing: 'easeOutQuart'
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) label += ': ';
                                label += context.parsed.y + ' orang';
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Penduduk'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Kelompok Umur'
                        }
                    }
                }
            }
        });
    }

    // ===================== DUSUN PIE CHART =====================
    const dusunData   = @json($dusunChart);
    const dusunLabels = dusunData.map(d => d.name);
    const dusunValues = dusunData.map(d => d.count);

    const dusunCtx = document.getElementById('dusunChart');
    if (dusunCtx) {
        new Chart(dusunCtx, {
            type: 'pie',
            data: {
                labels: dusunLabels,
                datasets: [{
                    data: dusunValues,
                    backgroundColor: [
                        '#6B8DE3', '#90D77F', '#F87171',
                        '#FF9A6C', '#60A5FA', '#34D399', '#FB923C'
                    ],
                    borderColor: '#ffffff',
                    borderWidth: 2,
                    hoverOffset: 10,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    },
                    tooltip: {
                        enabled: true,
                        displayColors: false,
                        callbacks: {
                            title: (ctx) => ctx[0].label,
                            label: (ctx) => {
                                const value = ctx.raw;
                                const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                const pct = total ? (value / total * 100).toFixed(2) : 0;
                                return `${value} Jiwa (${pct}%)`;
                            }
                        }
                    }
                },
                animation: {
                    animateRotate: true,
                    animateScale: true,
                    duration: 1000,
                    easing: 'easeOutCubic'
                }
            }
        });
    }

    // ===================== EDUCATION BAR CHART =====================
    const eduLabels = @json($pendidikanCounts->pluck('pendidikan'));
    const eduValues = @json($pendidikanCounts->pluck('total'));

    const educationCtx = document.getElementById('educationChart');
    if (educationCtx) {
        new Chart(educationCtx, {
            type: 'bar',
            data: {
                labels: eduLabels,
                datasets: [{
                    label: 'Jumlah Penduduk',
                    data: eduValues,
                    backgroundColor: 'rgba(21, 128, 61, 0.85)',
                    borderColor: 'rgb(21, 128, 61)',
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 1500,
                    easing: 'easeOutQuart'
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Jumlah: ' + context.parsed.y;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 20
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Penduduk'
                        }
                    },
                    x: {
                        ticks: {
                            autoSkip: false,
                            maxRotation: 0,
                            minRotation: 0,
                            callback: function(value, index) {
                                const label = this.getLabelForValue(value);
                                const words = label.split(/[\s/]+/);
                                const lines = [];
                                let currentLine = '';

                                words.forEach(word => {
                                    const testLine = currentLine + (currentLine ? ' ' : '') + word;
                                    if (testLine.length > 10 && currentLine) {
                                        lines.push(currentLine);
                                        currentLine = word;
                                    } else {
                                        currentLine = testLine;
                                    }
                                });
                                if (currentLine) lines.push(currentLine);

                                return lines;
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }
});
</script>
@endpush

