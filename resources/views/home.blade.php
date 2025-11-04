@extends('welcome')

@section('title', 'Beranda Desa')

@section('content')
    <div class="relative w-full h-screen bg-cover bg-center flex items-center justify-center text-center"
        style="background-image: url('{{ asset('images/container.png') }}');">

        <!-- Overlay (opsional) -->
        <div class="absolute inset-0 bg-black/40"></div>

        <!-- Konten teks -->
        <div class="relative z-10 px-6">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Selamat Datang di Website Resmi Desa Bandar Rejo
            </h1>
            <p class="text-white leading-relaxed max-w-2xl mx-auto">
                Website Resmi Pemerintah Desa Bandar Rejo, Kecamatan Natar, Kabupaten Lampung Selatan.
                Dapatkan informasi terbaru seputar desa, layanan publik, dan kegiatan masyarakat.
            </p>
        </div>
    </div>

    <section class="bg-gray-100">
    <div class="py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <div class="space-y-4">
                <h2 class="text-3xl md:text-4xl font-bold text-[#2C7961] leading-tight">
                    JELAJAHI DESA
                </h2>
                <p class="text-gray-700 text-sm md:text-base leading-relaxed">
                    Melalui website ini Anda dapat menjelajahi segala hal yang terkait dengan desa. Aspek pemerintahan, penduduk, demografi, potensi desa, dan juga berita tentang desa.
                </p>
            </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <a href="{{ url('/profil-desa') }}" 
        class="group relative w-full h-[227px] bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center opacity-5 group-hover:opacity-10 transition-opacity"
                style="background-image: url('{{ asset('images/Component11.png') }}');"></div>
                <div class="relative flex flex-col items-center justify-center h-full p-6">
                <div class="mb-6">
                <img src="{{ asset('images/Component11.png') }}" alt="Profil Desa" class="w-16 h-16 object-contain">
            </div>
            <h3 class="text-sm font-bold text-[#2C7961] tracking-wider uppercase">
                PROFIL DESA
            </h3>
    </div>
    <div class="absolute inset-0 border-2 border-transparent group-hover:border-[#2C7961] rounded-2xl transition-colors"></div></a>
        <a href="{{ url('/infografis') }}" 
        class="group relative w-full h-[227px] bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-5 group-hover:opacity-10 transition-opacity"
    style="background-image: url('{{ asset('images/Other.png') }}');"></div>
        <div class="relative flex flex-col items-center justify-center h-full p-6">
        <div class="mb-6">
        <img src="{{ asset('images/Other.png') }}" alt="Infografis" class="w-16 h-16 object-contain">
    </div>
        <h3 class="text-sm font-bold text-[#2C7961] tracking-wider uppercase">
            INFOGRAFIS
        </h3>
    </div>
    <div class="absolute inset-0 border-2 border-transparent group-hover:border-[#2C7961] rounded-2xl transition-colors"></div></a>
    </div>
    </div>
    </div>
    </div>
</section>

    <section class="w-full bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <a href="{{ url('/berita') }}"
                class="inline-block bg-[#2C7961] hover:bg-[#256952] text-white font-medium px-6 py-3 rounded-md transition">
                Lihat Berita Terbaru
            </a>
        </div>
    </section>

<section class="max-w-7xl mx-auto px-6 py-12">
  <div class="grid gap-8 md:grid-cols-12 items-center">
    <div class="md:col-span-4 flex justify-center md:justify-start">
      <div class="w-56 h-56 md:w-64 md:h-64 rounded-full bg-gray-200 overflow-hidden">
        <img src="{{ asset('images/kades-dummy.jpg') }}"
             alt="Kepala Desa"
             class="w-full h-full object-cover">
      </div>
    </div>

    {{-- Teks sambutan --}}
    <div class="md:col-span-8">
      <h3 class="text-2xl md:text-3xl font-extrabold text-[#2C7961]">
        Sambutan Kepala Desa Data
      </h3>
      <div class="mt-1">
        <p class="text-xs font-extrabold tracking-wide text-black">SULARTO</p>
        <p class="text-[11px] uppercase tracking-wide text-black/60">KEPALA DESA DATA</p>
      </div>
      <p class="mt-4 text-sm md:text-base leading-relaxed text-black/80 text-justify">
        Selamat datang di Website Resmi Pemerintah Desa Bandar Rejo, Kecamatan Natar, Kabupaten Lampung Selatan.
        Website ini hadir sebagai sarana informasi yang bertujuan untuk memberikan pelayanan yang lebih baik dan
        lebih cepat kepada seluruh masyarakat Desa Data. Dengan kemajuan teknologi yang semakin pesat, kami berharap
        platform ini dapat menjadi jembatan yang menghubungkan antara pemerintah desa dengan warga.
        Melalui website ini, masyarakat dapat dengan mudah mengakses berbagai informasi penting terkait program,
        kegiatan, dan kebijakan yang dilaksanakan oleh Pemerintah Desa Bandar Rejo.
      </p>
    </div>
  </div>
</section>

{{-- ===== SOTK ===== --}}
<section class="bg-gray-100 py-10">
  <div class="max-w-7xl mx-auto px-4 md:px-6">
    <h2 class="text-2xl md:text-3xl font-extrabold text-[#2C7961]">SOTK</h2>
    <p class="text-sm md:text-base text-black/80 mt-1">
      Struktur Organisasi dan Tata Kerja Desa Data
    </p>

    @php
      $pejabat = [
        ['nama' => 'A.NAJAMUDDIN','jabatan' => 'Kepala Desa','foto' => asset('images/pejabat-1.jpg')],
        ['nama' => 'ILVA ISTI','jabatan' => 'Sekretaris Desa','foto' => asset('images/pejabat-2.jpg')],
        ['nama' => 'SAIFUL NURHIDAYAT','jabatan' => 'Bendahar Desa','foto' => asset('images/pejabat-3.jpg')],
        ['nama' => 'FITRIANI','jabatan' => 'Koordinasi Umum dan Perencanaan','foto' => asset('images/pejabat-4.jpg')],
      ];
      $placeholder = asset('images/kades-dummy.jpg'); 
    @endphp

    <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
      @foreach ($pejabat as $p)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
          <div class="h-56 bg-gradient-to-b from-gray-200 to-gray-100 flex items-end justify-center">
            <img
              src="{{ $p['foto'] ?: $placeholder }}"
              alt="{{ $p['nama'] }}"
              class="w-40 h-48 object-contain drop-shadow"
              onerror="this.src='{{ $placeholder }}'"
            >
          </div>

          <div class="bg-[#2C7961] px-4 py-3 text-white">
            <div class="text-white text-[13px] font-extrabold tracking-wide uppercase leading-tight">
              {{ $p['nama'] }}
            </div>
            <div class="text-white/90 text-[11px] leading-tight">
              {{ $p['jabatan'] }}
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="mt-4 flex justify-end">
      <a href="{{ url('/struktur-organisasi') }}"
         class="inline-flex items-center gap-2 text-[13px] font-extrabold tracking-wide text-black hover:text-[#2C7961] transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
          <path d="M4 4h16v2H4V4zm0 4h10v2H4V8zm0 4h16v2H4v-2zm0 4h10v2H4v-2z"/>
        </svg>
        LIHAT STRUKTUR LEBIH LENGKAP
      </a>
    </div>
  </div>
</section>

{{-- ================== ADMINISTRASI PENDUDUK + APB DESA ================== --}}
<section class="bg-gray-100 py-10">
  <div class="max-w-7xl mx-auto px-4 md:px-6 font-poppins">
    <h2 class="text-2xl md:text-3xl font-extrabold text-[#2C7961]">Administrasi Penduduk</h2>
    <p class="text-sm md:text-base text-black/80 mt-1">
      Sistem digital yang berfungsi mempermudah pengelolaan data dan informasi terkait dengan kependudukan
      dan pendayagunaannya untuk pelayanan publik yang efektif dan efisien
    </p>
    {{-- Angka-angka statistik --}}
    @php
      // Dummy data; bisa diganti dari controller
      $statKiri = [
        ['angka' => 904, 'label' => 'Penduduk'],
        ['angka' => 223, 'label' => 'Kepala Keluarga'],
        ['angka' => 0,   'label' => 'Penduduk Sementara'],
      ];
      $statKanan = [
        ['angka' => 456, 'label' => 'Laki-Laki'],
        ['angka' => 448, 'label' => 'Perempuan'],
        ['angka' => 35,  'label' => 'Mutasi Penduduk'],
      ];
    @endphp

    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="space-y-3">
        @foreach ($statKiri as $row)
          <div class="grid grid-cols-12 gap-3">
            <div class="col-span-4 md:col-span-3 rounded-md bg-gradient-to-r from-[#2C7961] to-[#2C7961]/70
                        text-white flex items-center justify-center h-12 md:h-14 shadow">
              <span class="text-xl md:text-2xl font-extrabold">{{ number_format($row['angka'],0,',','.') }}</span>
            </div>
            <div class="col-span-8 md:col-span-9 rounded-md bg-white border border-gray-200
                        flex items-center h-12 md:h-14 px-4 text-black font-semibold shadow-sm">
              {{ $row['label'] }}
            </div>
          </div>
        @endforeach
      </div>
      <div class="space-y-3">
        @foreach ($statKanan as $row)
          <div class="grid grid-cols-12 gap-3">
            <div class="col-span-4 md:col-span-3 rounded-md bg-gradient-to-r from-[#2C7961] to-[#2C7961]/70
                        text-white flex items-center justify-center h-12 md:h-14 shadow">
              <span class="text-xl md:text-2xl font-extrabold">{{ number_format($row['angka'],0,',','.') }}</span>
            </div>
            <div class="col-span-8 md:col-span-9 rounded-md bg-white border border-gray-200
                        flex items-center h-12 md:h-14 px-4 text-black font-semibold shadow-sm">
              {{ $row['label'] }}
            </div>
          </div>
        @endforeach
      </div>
    </div>

</section>

{{-- ================= POTENSI DESA ================= --}}
<section class="bg-white py-10">
  <div class="max-w-7xl mx-auto px-4 md:px-6 font-poppins">

    {{-- Header + CTA kanan --}}
    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
      <div>
        <h2 class="text-2xl md:text-3xl font-extrabold text-[#2C7961]">POTENSI DESA</h2>
        <p class="mt-1 text-sm md:text-base text-black/80 max-w-lg">
          Informasi tentang potensi dan kemajuan desa di berbagai bidang seperti ekonomi, pariwisata,
          pertanian, industri kreatif, dan kelestarian lingkungan.
        </p>
      </div>

      <a href="{{ url('/potensi') }}"
         class="hidden md:inline-flex items-center gap-2 text-[13px] md:text-sm font-extrabold tracking-wide
                text-black hover:text-[#2C7961] transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
          <path d="M4 4h16v2H4zM4 8h10v2H4zM4 12h16v2H4zM4 16h10v2H4z"/>
        </svg>
        LIHAT POTENSI LEBIH BANYAK
      </a>
    </div>

    <div class="mt-6 flex flex-col md:flex-row">
      <div class="flex flex-col items-start">
        <div class="w-56 h-56 md:w-64 md:h-64 rounded-full overflow-hidden">
          <img src="{{ asset('images/tani.png') }}"
               alt="Potensi Pertanian"
               class="w-full h-full object-cover">
        </div>

        <p class="mt-4 text-[12px] md:text-sm font-extrabold uppercase text-black leading-tight text-center">
          POTENSI PERTANIAN <br> DESA BANDAR REJO LAMPUNG SELATAN
        </p>
      </div>
    </div>

  </div>
</section>

{{-- ================= GALERI DESA ================= --}}
<section class="bg-white py-10 font-poppins">
  <div class="max-w-7xl mx-auto px-4 md:px-6">

    {{-- Header --}}
    <div>
      <h2 class="text-2xl md:text-3xl font-extrabold text-[#2C7961]">GALERI DESA</h2>
      <p class="text-sm md:text-base text-black/80 mt-1">
        Menampilkan kegiatan-kegiatan yang berlangsung di desa
      </p>
    </div>

    @php
      $galeri = [
        asset('images/ksi.jpg'),
        asset('images/ksi.jpg'),
        asset('images/ksi.jpg'),
        asset('images/ksi.jpg'),
        asset('images/ksi.jpg'),
        asset('images/ksi.jpg'),
        asset('images/ksi.jpg'),
        asset('images/ksi.jpg'),
      ];
      $fallback = asset('images/galeri-dummy.jpg');
    @endphp

    {{-- Navigation Buttons --}}
    <div class="flex justify-center items-center gap-3 mt-6">
      <button id="prevBtn" class="p-2 rounded-full hover:bg-black/10 transition-colors disabled:opacity-30 disabled:cursor-not-allowed" aria-label="Prev">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
      </button>
      <button id="nextBtn" class="p-2 rounded-full hover:bg-black/10 transition-colors disabled:opacity-30 disabled:cursor-not-allowed" aria-label="Next">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
      </button>
    </div>

    {{-- Slider Container --}}
    <div class="mt-6 overflow-hidden">
      <div id="galeriSlider" class="flex transition-transform duration-500 ease-in-out">
        @php
          $chunks = array_chunk($galeri, 6); // Membagi array menjadi kelompok per 6 foto
        @endphp
        
        @foreach ($chunks as $chunk)
          <div class="min-w-full grid grid-cols-2 md:grid-cols-3 gap-4 px-1">
            @foreach ($chunk as $g)
              <div class="rounded-md bg-white shadow-sm overflow-hidden border border-gray-200">
                <img src="{{ $g }}" alt="Galeri Desa"
                     class="w-full h-40 md:h-48 object-cover"
                     onerror="this.src='{{ $fallback }}'">
              </div>
            @endforeach
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const slider = document.getElementById('galeriSlider');
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  
  let currentIndex = 0;
  const totalPages = slider.children.length; 

  function updateSlider() {
    const translateX = -(currentIndex * 100);
    slider.style.transform = `translateX(${translateX}%)`;
    
    // Update button states
    prevBtn.disabled = currentIndex === 0;
    nextBtn.disabled = currentIndex === totalPages - 1;
  }

  nextBtn.addEventListener('click', function() {
    if (currentIndex < totalPages - 1) {
      currentIndex++;
      updateSlider();
    }
  });

  prevBtn.addEventListener('click', function() {
    if (currentIndex > 0) {
      currentIndex--;
      updateSlider();
    }
  });

  // Initialize button states
  updateSlider();
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const slider = document.getElementById('galeriSlider');
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  
  let currentIndex = 0;
  const itemsPerPage = window.innerWidth >= 768 ? 3 : 2; // 3 untuk desktop, 2 untuk mobile
  const totalItems = {{ count($galeri) }};
  const maxIndex = Math.ceil(totalItems / itemsPerPage) - 1;

  function updateSlider() {
    const translateX = -(currentIndex * 100);
    slider.style.transform = `translateX(${translateX}%)`;
  }

  nextBtn.addEventListener('click', function() {
    if (currentIndex < maxIndex) {
      currentIndex++;
      updateSlider();
    }
  });

  prevBtn.addEventListener('click', function() {
    if (currentIndex > 0) {
      currentIndex--;
      updateSlider();
    }
  });

  // Reset pada resize
  window.addEventListener('resize', function() {
    currentIndex = 0;
    updateSlider();
  });
});
</script>

{{-- ================= FEEDBACK PENGUNJUNG ================= --}}
<section class="bg-gray-100 py-10 font-poppins">
  <div class="max-w-2xl mx-auto px-4 md:px-6">
    <h2 class="text-2xl md:text-3xl font-extrabold text-[#2C7961] mb-2 text-center">Kritik & Saran</h2>
    <p class="text-sm md:text-base text-black/80 mb-6 text-center">
      Kami sangat menghargai masukan Anda untuk meningkatkan pelayanan dan kualitas website Desa Bandar Rejo. Silakan tinggalkan kritik, saran, atau pesan Anda di bawah ini.
    </p>
    <form method="POST" action="{{ url('/feedback') }}" class="bg-white rounded-lg shadow-md p-6 space-y-4">
      @csrf
      <div>
        <label for="nama" class="block text-sm font-semibold text-gray-700 mb-1">Nama</label>
        <input type="text" id="nama" name="nama" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#2C7961]" placeholder="Nama Anda (opsional)">
      </div>
      <div>
        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
        <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#2C7961]" placeholder="Email Anda (opsional)">
      </div>
      <div>
        <label for="pesan" class="block text-sm font-semibold text-gray-700 mb-1">Pesan / Saran</label>
        <textarea id="pesan" name="pesan" rows="4" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#2C7961]" placeholder="Tulis kritik, saran, atau pesan Anda di sini..."></textarea>
      </div>
      <div class="flex justify-end">
        <button type="submit" class="bg-[#2C7961] hover:bg-[#256952] text-white font-semibold px-6 py-2 rounded-md transition">
          Kirim Feedback
        </button>
      </div>
    </form>
    <p class="text-xs text-gray-500 mt-3 text-center">
      Data Anda akan dijaga kerahasiaannya. Terima kasih atas partisipasi Anda!
    </p>
  </div>
</section>


@endsection
