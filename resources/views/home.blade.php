@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 md:px-12">
    <!-- Hero Section -->
    <section class="min-h-[70vh] flex flex-col items-center justify-center text-center py-20 relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-[linear-gradient(rgba(0,243,255,0.1)_1px,transparent_1px),linear-gradient(90deg,rgba(0,243,255,0.1)_1px,transparent_1px)] bg-[size:100px_100px] [transform:perspective(500px)_rotateX(60deg)] [transform-origin:top]"></div>
        </div>
        
        <div class="z-10 animate-flicker">
            <h1 class="text-5xl md:text-7xl font-orbitron font-black neon-text-blue mb-4">PORTFOLIO</h1>
            <h2 class="text-2xl md:text-4xl font-orbitron font-bold text-white tracking-widest">ALBERTUS RENO ADITAMA</h2>
        </div>
    </section>

    <!-- Profile Section -->
    <section class="py-20 fade-in">
        <div class="glass p-8 md:p-12 rounded-3xl neon-border-blue relative overflow-hidden">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <!-- Profile Image -->
                <div class="relative group">
                    <div class="w-48 h-48 md:w-64 md:h-64 rounded-full overflow-hidden border-4 border-neon-blue shadow-neon-blue">
                        @if($profile->profile_image)
                            <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="Profile" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-dark-gray flex items-center justify-center">
                                <i data-lucide="user" class="w-24 h-24 text-gray-600"></i>
                            </div>
                        @endif
                    </div>
                    
                    <form action="/profile/update-photo" method="POST" enctype="multipart/form-data" class="mt-6 flex flex-col items-center">
                        @csrf
                        <label class="cursor-pointer glass px-6 py-2 rounded-full border border-neon-purple text-neon-purple hover:bg-neon-purple hover:text-white transition-all duration-300 font-orbitron text-sm">
                            GANTI FOTO PROFIL
                            <input type="file" name="profile_image" class="hidden" onchange="this.form.submit()">
                        </label>
                    </form>
                </div>

                <!-- Profile Data -->
                <div class="flex-1 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <p class="text-neon-blue font-orbitron text-xs tracking-widest">NAMA</p>
                            <p class="text-xl font-bold text-white">{{ $profile->name }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-neon-purple font-orbitron text-xs tracking-widest">USIA</p>
                            <p class="text-xl font-bold text-white">{{ $profile->age }} Tahun</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-neon-blue font-orbitron text-xs tracking-widest">TANGGAL LAHIR</p>
                            <p class="text-xl font-bold text-white">{{ \Carbon\Carbon::parse($profile->birth_date)->format('d F Y') }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-neon-purple font-orbitron text-xs tracking-widest">SEKOLAH / KELAS</p>
                            <p class="text-xl font-bold text-white">{{ $profile->school }} - {{ $profile->class }}</p>
                        </div>
                    </div>
                    <div class="pt-6 border-t border-white/10">
                        <p class="text-neon-blue font-orbitron text-xs tracking-widest mb-2">DESKRIPSI</p>
                        <p class="text-gray-400 leading-relaxed text-lg italic">"{{ $profile->description }}"</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Programming Languages -->
    <section class="py-20 fade-in">
        <h3 class="text-3xl font-orbitron font-bold neon-text-purple text-center mb-12">BAHASA PEMROGRAMAN</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach(['C++', 'Python', 'CSharp'] as $lang)
            <div class="glass p-8 rounded-2xl neon-border-blue hover:scale-105 transition-all duration-500 group flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-neon-blue/10 rounded-xl flex items-center justify-center mb-6 group-hover:shadow-neon-blue transition-all">
                    @if($lang == 'C++')
                        <span class="text-3xl font-bold text-neon-blue">C++</span>
                    @elseif($lang == 'Python')
                        <span class="text-3xl font-bold text-neon-blue">Py</span>
                    @else
                        <span class="text-3xl font-bold text-neon-blue">C#</span>
                    @endif
                </div>
                <h4 class="text-xl font-orbitron font-bold text-white">{{ $lang }}</h4>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Fields Section -->
    <section class="py-20 fade-in">
        <h3 class="text-3xl font-orbitron font-bold neon-text-blue text-center mb-12">BIDANG KEAHLIAN</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div class="glass p-10 rounded-3xl neon-border-purple hover:neon-border-blue transition-all duration-500 group relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i data-lucide="code" class="w-40 h-40"></i>
                </div>
                <h4 class="text-2xl font-orbitron font-bold text-white mb-4">Website Development</h4>
                <p class="text-gray-400">Membangun website modern dengan framework terbaru seperti Laravel dan TailwindCSS.</p>
            </div>
            <div class="glass p-10 rounded-3xl neon-border-blue hover:neon-border-purple transition-all duration-500 group relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i data-lucide="gamepad-2" class="w-40 h-40"></i>
                </div>
                <h4 class="text-2xl font-orbitron font-bold text-white mb-4">Unity Game Development</h4>
                <p class="text-gray-400">Mengembangkan game interaktif menggunakan Unity Engine dan bahasa C#.</p>
            </div>
        </div>
    </section>
</div>
@endsection
