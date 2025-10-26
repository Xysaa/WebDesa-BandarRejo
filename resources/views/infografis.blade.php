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
          Memberikan informasi lengkap mengenai karakteristik demografi penduduk suatu wilayah. 
          Mulai dari jumlah penduduk, usia, jenis kelamin, tingkat pendidikan, pekerjaan, agama, 
          dan aspek penting lainnya yang menggambarkan komposisi populasi secara rinci.
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
            <span class="text-green-700 font-semibold counter" data-target="{{ $totalPenduduk ?? 904 }}">0</span> 
            <span class="text-gray-700">Jiwa</span>
          </p>
        </div>
      </div>

      <div class="bg-white/50 backdrop-blur rounded-lg shadow p-6 flex items-center gap-6 transition-transform duration-200 hover:-translate-y-1 hover:shadow-md">
        <img src="{{ asset('images/aset infografis/Kepala Keluarga.png') }}" alt="Family" class="w-34 h-24">
        <div>
          <p class="text-2xl text-gray-700">KEPALA KELUARGA</p>
          <p class="text-4xl">
            <span class="text-green-700 font-semibold counter" data-target="{{ $kepalaKeluarga ?? 223 }}">0</span> 
            <span class="text-gray-700">Jiwa</span>
          </p>
        </div>
      </div>

      <div class="bg-white/50 backdrop-blur rounded-lg shadow p-6 flex items-center gap-6 transition-transform duration-200 hover:-translate-y-1 hover:shadow-md">
        <img src="{{ asset('images/aset infografis/Perempuan.png') }}" alt="Female" class="w-34 h-24">
        <div>
          <p class="text-2xl text-gray-700">PEREMPUAN</p>
          <p class="text-4xl">
            <span class="text-green-700 font-semibold counter" data-target="{{ $perempuan ?? 448 }}">0</span> 
            <span class="text-gray-700">Jiwa</span>
          </p>
        </div>
      </div>

      <div class="bg-white/50 backdrop-blur rounded-lg shadow p-6 flex items-center gap-6 transition-transform duration-200 hover:-translate-y-1 hover:shadow-md">
        <img src="{{ asset('images/aset infografis/laki-laki.png') }}" alt="Male" class="w-34 h-24">
        <div>
          <p class="text-2xl text-gray-700">LAKI-LAKI</p>
          <p class="text-4xl">
            <span class="text-green-700 font-semibold counter" data-target="{{ $lakiLaki ?? 456 }}">0</span> 
            <span class="text-gray-700">Jiwa</span>
          </p>
        </div>
      </div>
    </div>
  </div>

</section>


<!-- Chart Section - Berdasarkan Kelompok Umur -->
<!-- Chart Section - Berdasarkan Kelompok Umur -->
<section class="bg-gray-100 py-6 px-8 md:px-12 lg:px-16">
    <div class="container mx-auto max-w-7xl">
        <h4 class="text-4xl font-bold text-green-700 mb-4">Berdasarkan Kelompok Umur</h4>

        <!-- Gambar + Chart -->
        <div class="bg-white/50 backdrop-blur rounded-lg shadow p-5 mb-5">
            <div class="h-[420px]">
                <canvas id="ageGroupChart"></canvas>
            </div>
        </div>

        <!-- Info Boxes -->
        <div class="space-y-3">
            <div class="bg-white/50 backdrop-blur rounded-lg shadow p-5 border-b-4 border-green-700">
                <p class="text-base md:text-lg text-gray-800 leading-relaxed">
                    Untuk jenis kelamin laki-laki, kelompok umur <span class="font-bold">15-19</span> adalah kelompok umur tertinggi 
                    dengan jumlah <span class="font-bold">56 orang</span> atau <span class="font-bold">12.28%</span>. 
                    Sedangkan, kelompok umur <span class="font-bold">85+ dan 80-84 tahun</span> adalah yang terendah 
                    dengan masing-masing berjumlah <span class="font-bold">1 orang</span> atau <span class="font-bold">0.22%</span>.
                </p>
            </div>

            <div class="bg-white/50 backdrop-blur rounded-lg shadow p-5 border-b-4 border-orange-300">
                <p class="text-base md:text-lg text-gray-800 leading-relaxed">
                    Untuk jenis kelamin perempuan, kelompok umur <span class="font-bold">20-24</span> adalah kelompok umur tertinggi 
                    dengan jumlah <span class="font-bold">54 orang</span> atau <span class="font-bold">12.05%</span>. 
                    Sedangkan, kelompok umur <span class="font-bold">85+</span> adalah yang terendah dengan jumlah 
                    <span class="font-bold">1 orang</span> atau <span class="font-bold">0.22%</span>.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Script Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Data berdasarkan informasi Anda
const ageGroupData = {
    labels: ['0-4', '5-9', '10-14', '15-19', '20-24', '25-29', '30-34', '35-39', 
             '40-44', '45-49', '50-54', '55-59', '60-64', '65-69', '70-74', 
             '75-79', '80-84', '85+'],
    datasets: [{
        label: 'Laki-laki',
        data: [45, 48, 52, 56, 50, 42, 38, 35, 30, 28, 25, 20, 15, 10, 5, 3, 1, 1],
        backgroundColor: 'rgba(21, 128, 61, 0.8)', // green-700
        borderColor: 'rgb(21, 128, 61)',
        borderWidth: 1
    }, {
        label: 'Perempuan',
        data: [42, 46, 50, 52, 54, 48, 40, 36, 32, 26, 22, 18, 14, 9, 6, 3, 2, 1],
        backgroundColor: 'rgba(253, 186, 116, 0.8)', // orange-300
        borderColor: 'rgb(253, 186, 116)',
        borderWidth: 1
    }]
};

// Konfigurasi Chart dengan Animasi
const config = {
    type: 'bar',
    data: ageGroupData,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
            duration: 2000, // Durasi animasi 2 detik
            easing: 'easeOutQuart', // Efek easing untuk animasi smooth
            delay: (context) => {
                let delay = 0;
                if (context.type === 'data' && context.mode === 'default') {
                    delay = context.dataIndex * 50; // Delay 50ms per bar
                }
                return delay;
            }
        },
        plugins: {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    font: {
                        size: 14,
                        family: 'system-ui'
                    },
                    padding: 15
                }
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                padding: 12,
                titleFont: {
                    size: 14
                },
                bodyFont: {
                    size: 13
                },
                callbacks: {
                    label: function(context) {
                        let label = context.dataset.label || '';
                        if (label) {
                            label += ': ';
                        }
                        label += context.parsed.y + ' orang';
                        return label;
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    font: {
                        size: 12
                    }
                },
                title: {
                    display: true,
                    text: 'Jumlah Penduduk',
                    font: {
                        size: 14,
                        weight: 'bold'
                    }
                }
            },
            x: {
                ticks: {
                    font: {
                        size: 11
                    }
                },
                title: {
                    display: true,
                    text: 'Kelompok Umur',
                    font: {
                        size: 14,
                        weight: 'bold'
                    }
                }
            }
        }
    }
};

// Render Chart saat halaman selesai dimuat
window.addEventListener('load', function() {
    const ctx = document.getElementById('ageGroupChart').getContext('2d');
    const ageGroupChart = new Chart(ctx, config);
});
</script>


<!-- By Village Section - Berdasarkan Dusun -->
<!-- Pie Chart Section -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Berdasarkan Dusun</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
  <section class="bg-gray-100 py-8 px-4 md:px-8 lg:px-12">
    <div class="container mx-auto max-w-7xl">
      <h4 class="text-3xl md:text-4xl font-bold text-green-700 mb-6">Berdasarkan Dusun</h4>
      <div class="grid md:grid-cols-5 gap-8 items-start">
        <!-- Chart - lebih lebar -->
        <div class="md:col-span-3 flex justify-center">
          <div style="width: 100%; max-width: 550px; position: relative;">
            <canvas id="dusunChart"></canvas>
          </div>
        </div>
        <!-- Keterangan - lebih sempit -->
        <div class="md:col-span-2 space-y-2 md:pl-4">
          <p class="text-xl font-bold text-gray-800 mb-4">Keterangan:</p>
          <div id="keterangan" class="space-y-1"></div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>
  <script>
    const dusunData = [
      { nama: 'Labulawang', jumlah: 583 },
      { nama: 'Mangali-Ali', jumlah: 633 },
      { nama: 'Senga Selatan', jumlah: 0 },
      { nama: 'Taddette', jumlah: 876 },
      { nama: 'Walenna Barat', jumlah: 322 },
      { nama: 'Walenna Timur', jumlah: 184 },
      { nama: 'Kalobang', jumlah: 1096 },
    ];

    // Render keterangan di kanan
    const ket = document.getElementById('keterangan');
    ket.innerHTML = dusunData
      .map(d => `<p class="text-base text-gray-700">${d.nama} : ${d.jumlah} Jiwa</p>`)
      .join('');

    const dusunLabels = dusunData.map(d => d.nama);
    const dusunValues = dusunData.map(d => d.jumlah);

    const ctx = document.getElementById('dusunChart').getContext('2d');
    Chart.register(ChartDataLabels);

    // Plugin custom untuk leader lines (garis penghubung label ke slice)
    const leaderLinePlugin = {
      id: 'leaderLinePlugin',
      afterDraw(chart) {
        const ctx = chart.ctx;
        const dataset = chart.data.datasets[0];
        const meta = chart.getDatasetMeta(0);
        ctx.save();
        ctx.strokeStyle = '#999';
        ctx.lineWidth = 1;
        
        meta.data.forEach((arc, i) => {
          if (dataset.data[i] === 0) return;
          
          const angle = (arc.startAngle + arc.endAngle) / 2;
          const r = arc.outerRadius;
          
          // Titik awal di tepi pie
          const x0 = arc.x + Math.cos(angle) * r;
          const y0 = arc.y + Math.sin(angle) * r;
          
          // Titik akhir untuk garis
          const lineLength = 25;
          const x1 = arc.x + Math.cos(angle) * (r + lineLength);
          const y1 = arc.y + Math.sin(angle) * (r + lineLength);
          
          ctx.beginPath();
          ctx.moveTo(x0, y0);
          ctx.lineTo(x1, y1);
          ctx.stroke();
        });
        
        ctx.restore();
      }
    };

    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: dusunLabels,
        datasets: [{
          data: dusunValues,
          backgroundColor: ['#6B8DE3', '#90D77F', '#F87171', '#FF9A6C', '#60A5FA', '#34D399', '#FB923C'],
          borderColor: '#fff',
          borderWidth: 3,
          hoverOffset: 10,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        layout: {
          padding: {
            top: 80,
            bottom: 80,
            left: 110,
            right: 110
          }
        },
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            enabled: true,
            displayColors: false,
            backgroundColor: 'rgba(0, 0, 0, 0.8)',
            padding: 12,
            titleFont: {
              size: 14,
              weight: 'bold'
            },
            bodyFont: {
              size: 13
            },
            callbacks: {
              title: (ctx) => {
                return ctx[0].label;
              },
              label: (ctx) => {
                const value = ctx.raw;
                const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                const pct = total ? (value / total * 100).toFixed(2) : 0;
                return [`${value} Jiwa`, `${pct}%`];
              }
            }
          },
          datalabels: {
            display: ctx => ctx.dataset.data[ctx.dataIndex] > 0,
            anchor: 'end',
            align: 'end',
            offset: 28,
            backgroundColor: 'rgba(255,255,255,0.95)',
            borderColor: '#ddd',
            borderWidth: 1,
            borderRadius: 4,
            color: '#1f2937',
            font: { 
              weight: '600', 
              size: 10,
              lineHeight: 1.3
            },
            padding: { 
              top: 5, 
              right: 7, 
              bottom: 5, 
              left: 7 
            },
            formatter: (value, ctx) => {
              const label = ctx.chart.data.labels[ctx.dataIndex];
              const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
              const pct = total ? (value / total * 100).toFixed(1) : 0;
              return `${label}\n${pct}%`;
            },
            textAlign: 'center'
          }
        },
        animation: {
          animateRotate: true,
          animateScale: true,
          duration: 1000,
          easing: 'easeOutCubic'
        },
      },
      plugins: [ChartDataLabels, leaderLinePlugin]
    });
  </script>
</body>
</html>

<!-- Education Section - Berdasarkan Pendidikan -->
<section class="bg-gray-100 py-6 px-8 md:px-12 lg:px-16">
    <div class="container mx-auto max-w-7xl">
        <h4 class="text-4xl font-bold text-green-700 mb-4">Berdasarkan Pendidikan</h4>
        <!-- Chart -->
        <div class="bg-white/50 backdrop-blur rounded-lg shadow p-5">
            <div class="h-[550px]">
                <canvas id="educationChart"></canvas>
            </div>
        </div>
    </div>
</section>

<!-- Script Chart.js untuk Pendidikan -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
<script>
// Data Pendidikan
const educationData = {
    labels: [
        'Tidak/Belum Sekolah', 
        'Belum Tamat SD/Sederajat', 
        'Tamat SD/Sederajat', 
        'SLTP/Sederajat', 
        'SLTA/Sederajat', 
        'Diploma I/II', 
        'Diploma III/Sarjana Muda', 
        'Diploma IV/Strata I', 
        'Strata II', 
        'Strata III'
    ],
    datasets: [{
        label: 'Jumlah Penduduk',
        data: [167, 105, 220, 153, 202, 5, 9, 43, 0, 0],
        backgroundColor: 'rgba(21, 128, 61, 0.85)',
        borderColor: 'rgb(21, 128, 61)',
        borderWidth: 2,
        borderRadius: 8,
        borderSkipped: false
    }]
};

// Konfigurasi Chart dengan Animasi dan Data Labels
const educationConfig = {
    type: 'bar',
    data: educationData,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
            duration: 1500,
            easing: 'easeOutQuart',
            delay: (context) => {
                let delay = 0;
                if (context.type === 'data' && context.mode === 'default') {
                    delay = context.dataIndex * 80;
                }
                return delay;
            }
        },
        layout: {
            padding: {
                top: 40,
                bottom: 20,
                left: 10,
                right: 10
            }
        },
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                padding: 12,
                titleFont: {
                    size: 13,
                    weight: 'bold'
                },
                bodyFont: {
                    size: 12
                },
                displayColors: false,
                callbacks: {
                    title: function(context) {
                        return context[0].label;
                    },
                    label: function(context) {
                        return 'Jumlah: ' + context.parsed.y;
                    }
                }
            },
            datalabels: {
                anchor: 'end',
                align: 'end',
                color: '#1e3a8a',
                font: {
                    weight: 'bold',
                    size: 12
                },
                offset: 5,
                formatter: function(value) {
                    return value;
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                max: 250,
                ticks: {
                    stepSize: 50,
                    font: {
                        size: 12
                    }
                },
                grid: {
                    color: 'rgba(0, 0, 0, 0.1)',
                    drawBorder: false
                }
            },
            x: {
                ticks: {
                    font: {
                        size: 9
                    },
                    maxRotation: 0,
                    minRotation: 0,
                    autoSkip: false,
                    padding: 10,
                    callback: function(value, index) {
                        const label = this.getLabelForValue(value);
                        // Pecah label jadi beberapa baris
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
    },
    plugins: [ChartDataLabels]
};

// Render Chart saat halaman selesai dimuat
window.addEventListener('load', function() {
    const ctx = document.getElementById('educationChart');
    if (ctx) {
        const educationChart = new Chart(ctx.getContext('2d'), educationConfig);

        // Tambahkan interaksi hover untuk ubah warna
        ctx.addEventListener('mousemove', (e) => {
            const points = educationChart.getElementsAtEventForMode(e, 'nearest', { intersect: true }, true);
            
            if (points.length) {
                const dataIndex = points[0].index;
                const newColors = educationData.datasets[0].data.map((_, index) => {
                    if (index === dataIndex) {
                        return 'rgba(110, 231, 183, 0.9)'; // Hijau terang
                    }
                    return 'rgba(21, 128, 61, 0.85)'; // Hijau tua default
                });
                
                educationChart.data.datasets[0].backgroundColor = newColors;
                educationChart.update('none');
            } else {
                educationChart.data.datasets[0].backgroundColor = 'rgba(21, 128, 61, 0.85)';
                educationChart.update('none');
            }
        });

        ctx.addEventListener('mouseleave', () => {
            educationChart.data.datasets[0].backgroundColor = 'rgba(21, 128, 61, 0.85)';
            educationChart.update('none');
        });
    }
});
</script>

<!-- Occupation Section - Berdasarkan Pekerjaan -->
<section class="bg-gray-100 py-12 px-8 md:px-12 lg:px-16">
    <div class="container mx-auto max-w-7xl">
        <h4 class="text-4xl font-bold text-green-700 mb-6">Berdasarkan Pekerjaan</h4>
        
        <div class="grid md:grid-cols-3 gap-6 items-stretch">
            <div class="bg-white/50 backdrop-blur rounded-lg shadow overflow-hidden">
                <img src="{{ asset('images/aset infografis/Pekerjaan.png') }}" alt="Tabel Pekerjaan" class="w-full h-full object-contain">
            </div>

            <!-- Top Occupations Cards -->
            <div class="md:col-span-2 grid md:grid-cols-2 gap-6">
                <div class="bg-white/50 backdrop-blur rounded-lg shadow p-8 text-center transition-transform duration-200 hover:-translate-y-1 hover:shadow-md">
                    <p class="text-lg text-gray-700 font-semibold mb-2">Pelajar/Mahasiswa</p>
                    <p class="text-4xl font-bold text-gray-700">241</p>
                </div>
                <div class="bg-white/50 backdrop-blur rounded-lg shadow p-8 text-center transition-transform duration-200 hover:-translate-y-1 hover:shadow-md">
                    <p class="text-lg text-gray-700 font-semibold mb-2">Belum/Tidak Bekerja</p>
                    <p class="text-4xl font-bold text-gray-700">230</p>
                </div>
                <div class="bg-white/50 backdrop-blur rounded-lg shadow p-8 text-center transition-transform duration-200 hover:-translate-y-1 hover:shadow-md">
                    <p class="text-lg text-gray-700 font-semibold mb-2">Mengurus Rumah Tangga</p>
                    <p class="text-4xl font-bold text-gray-700">194</p>
                </div>
                <div class="bg-white/50 backdrop-blur rounded-lg shadow p-8 text-center transition-transform duration-200 hover:-translate-y-1 hover:shadow-md">
                    <p class="text-lg text-gray-700 font-semibold mb-2">Petani/Pekebun</p>
                    <p class="text-4xl font-bold text-gray-700">109</p>
                </div>
                <div class="bg-white/50 backdrop-blur rounded-lg shadow p-8 text-center transition-transform duration-200 hover:-translate-y-1 hover:shadow-md">
                    <p class="text-lg text-gray-700 font-semibold mb-2">Wiraswasta</p>
                    <p class="text-4xl font-bold text-gray-700">53</p>
                </div>
                <div class="bg-white/50 backdrop-blur rounded-lg shadow p-8 text-center transition-transform duration-200 hover:-translate-y-1 hover:shadow-md">
                    <p class="text-lg text-gray-700 font-semibold mb-2">Nelayan/Perikanan</p>
                    <p class="text-4xl font-bold text-gray-700">34</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Marital Status Section - Berdasarkan Perkawinan -->
<section class="bg-gray-100 py-12 px-8 md:px-12 lg:px-16">
    <div class="container mx-auto max-w-7xl">
        <h4 class="text-4xl font-bold text-green-700 mb-8">Berdasarkan Perkawinan</h4>

        @php
        $maritalStatuses = [
            ['name' => 'Belum Kawin', 'count' => 724, 'icon' => 'images/aset infografis/belumkawin.png'],
            ['name' => 'Kawin', 'count' => 88, 'icon' => 'images/aset infografis/kawin.png'],
            ['name' => 'Cerai Mati', 'count' => 38, 'icon' => 'images/aset infografis/mt.png'],
            ['name' => 'Kawin Tercatat', 'count' => 31, 'icon' => 'images/aset infografis/kawintercatat.png'],
            ['name' => 'Cerai Hidup', 'count' => 14, 'icon' => 'images/aset infografis/Cerai Hidup.png'],
            ['name' => 'Kawin Tidak Tercatat', 'count' => 9, 'icon' => 'images/aset infografis/kawin tak tercatat.png'],
        ];
        @endphp

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($maritalStatuses as $status)
            <div class="bg-white/70 backdrop-blur rounded-lg shadow p-6 flex items-center gap-6 transition-transform duration-200 hover:-translate-y-1 hover:shadow-md">
                <div class="flex-shrink-0 w-20 h-20">
                    <img src="{{ asset($status['icon']) }}" alt="{{ $status['name'] }}" class="w-full h-full object-contain">
                </div>
                <div class="flex flex-col">
                    <p class="text-lg md:text-xl font-medium text-gray-700">{{ $status['name'] }}</p>
                    <p class="text-3xl md:text-4xl font-semibold text-emerald-600 leading-tight">{{ $status['count'] }}</p>
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
        $religions = [
            ['name' => 'Islam', 'count' => 904, 'icon' => 'images/aset infografis/islam.png'],
            ['name' => 'Katolik', 'count' => 0, 'icon' => 'images/aset infografis/katolik.png'],
            ['name' => 'Hindu', 'count' => 0, 'icon' => 'images/aset infografis/hindu.png'],
            ['name' => 'Buddha', 'count' => 0, 'icon' => 'images/aset infografis/budha.png'],
            ['name' => 'Konghucu', 'count' => 0, 'icon' => 'images/aset infografis/konghucu.png'],
            ['name' => 'Kristen', 'count' => 0, 'icon' => 'images/aset infografis/kristen.png'],
            ['name' => 'Kepercayaan Lainnya', 'count' => 0, 'icon' => 'images/aset infografis/kepercayaan lain.png'],
        ];
        @endphp

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 place-items-center">
            @foreach($religions as $religion)
            <div class="bg-white/70 backdrop-blur rounded-lg shadow p-6 flex items-center gap-6 w-full max-w-sm transition-transform duration-200 hover:-translate-y-1 hover:shadow-md {{ $loop->last ? 'lg:col-span-3 justify-self-center' : '' }}">
                <div class="flex-shrink-0 w-20 h-20">
                    <img src="{{ asset($religion['icon']) }}" alt="{{ $religion['name'] }}" class="w-full h-full object-contain">
                </div>
                <div class="flex flex-col">
                    <p class="text-lg md:text-xl font-medium text-gray-700">{{ $religion['name'] }}</p>
                    <p class="text-3xl md:text-4xl font-semibold text-emerald-600 leading-tight">{{ $religion['count'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
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
        // Jika hanya 1 data, misal: ['name' => 'Dusun 1', 'count' => 12, ...]
        ];
        @endphp

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 place-items-center">
            @foreach($stuntingDusun as $dusun)
            <div class="bg-white/70 backdrop-blur rounded-lg shadow p-6 flex items-center gap-6 w-full max-w-sm transition-transform duration-200 hover:-translate-y-1 hover:shadow-md {{ $loop->last ? 'lg:col-span-3 justify-self-center' : '' }}">
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

<!-- Bantuan Sosial Section - Jumlah Bantuan Sosial per Program -->
<section class="bg-gray-100 py-12 px-8 md:px-12 lg:px-16">
  <div class="container mx-auto max-w-7xl">
    <h4 class="text-4xl font-bold text-green-700 mb-8">Jumlah Bantuan Sosial</h4>

    @php
    $bansosPrograms = [
      ['name' => 'Program Keluarga Harapan',      'count' => 120, 'icon' => 'images/aset infografis/pkh.png'],
      ['name' => 'Bantuan Pangan Non Tunai',     'count' => 98,  'icon' => 'images/aset infografis/bpnt.png'],
      ['name' => 'Program Indonesia Pintar',      'count' => 75,  'icon' => 'images/aset infografis/pip.png'],
      ['name' => 'Jaminan Kesehatan Nasional-KIS',  'count' => 150, 'icon' => 'images/aset infografis/jkn-kis.png'],
      ['name' => ' Bantuan Langsung Tunai',      'count' => 60,  'icon' => 'images/aset infografis/blt.png'],
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Counter Animation Function
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-target'));
            const duration = 2000; // 2 detik
            const increment = target / (duration / 16); // 50fps
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

        // Intersection Observer untuk trigger animasi saat scroll
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

        // Observe semua elemen dengan class 'counter'
        document.querySelectorAll('.counter').forEach(counter => {
            observer.observe(counter);
        });

        // Age Group Chart
        const ageCtx = document.getElementById('ageGroupChart');
        if (ageCtx) {
            new Chart(ageCtx, {
                type: 'bar',
                data: {
                    labels: ['0-4', '5-9', '10-14', '15-19', '20-24', '25-29', '30-34', '35-39', '40-44', '45-49', '50-54', '55-59', '60-64', '65-69', '70-74', '75-79', '80-84', '85+'],
                    datasets: [{
                        label: 'Laki-laki',
                        data: [35, 45, 48, 56, 52, 38, 32, 28, 24, 22, 18, 16, 14, 12, 8, 4, 1, 1],
                        backgroundColor: '#16a34a'
                    }, {
                        label: 'Perempuan',
                        data: [32, 42, 46, 52, 54, 36, 30, 26, 22, 20, 16, 14, 12, 10, 6, 3, 2, 1],
                        backgroundColor: '#fb923c'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
@endsection