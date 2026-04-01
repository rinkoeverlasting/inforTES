@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 md:px-12 py-20" x-data="{ openAdd: false, openEdit: false, currentProject: {} }">
    <!-- Skills Section -->
    <section class="mb-32 fade-in">
        <h2 class="text-4xl font-orbitron font-bold neon-text-blue text-center mb-16">MY SKILLS</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            @foreach([
                ['name' => 'C++', 'level' => 80, 'color' => 'neon-blue'],
                ['name' => 'Python', 'level' => 75, 'color' => 'neon-purple'],
                ['name' => 'C#', 'level' => 70, 'color' => 'neon-blue'],
                ['name' => 'Web Development', 'level' => 65, 'color' => 'neon-purple'],
                ['name' => 'Unity Game Development', 'level' => 70, 'color' => 'neon-blue'],
            ] as $skill)
            <div class="space-y-4">
                <div class="flex justify-between font-orbitron text-sm">
                    <span class="text-white">{{ $skill['name'] }}</span>
                    <span class="text-{{ $skill['color'] }}">{{ $skill['level'] }}%</span>
                </div>
                <div class="w-full bg-dark-gray rounded-full h-3 relative overflow-hidden">
                    <div class="absolute inset-y-0 left-0 bg-{{ $skill['color'] }} shadow-{{ $skill['color'] }} rounded-full transition-all duration-1000"
                        style="width: {{ $skill['level'] }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Projects Section -->
    <section class="fade-in">
        <div class="flex flex-col md:flex-row justify-between items-center mb-16 gap-6">
            <h2 class="text-4xl font-orbitron font-bold neon-text-purple">PROJECTS</h2>
            <button @click="openAdd = true" class="glass px-8 py-3 rounded-full border border-neon-blue text-neon-blue hover:bg-neon-blue hover:text-white transition-all duration-300 font-orbitron flex items-center gap-3">
                <i data-lucide="plus" class="w-5 h-5"></i>
                ADD PROJECT
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($projects as $project)
            <div class="glass rounded-3xl overflow-hidden neon-border-blue hover:neon-border-purple transition-all duration-500 flex flex-col group">
                <div class="h-52 overflow-hidden relative">
                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 right-4">
                        <span class="px-4 py-1 rounded-full text-xs font-orbitron {{ $project->type == 'Tugas' ? 'bg-neon-blue/20 text-neon-blue border border-neon-blue' : 'bg-neon-purple/20 text-neon-purple border border-neon-purple' }}">
                            {{ strtoupper($project->type) }}
                        </span>
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-4">
                        <h4 class="text-xl font-orbitron font-bold text-white">{{ $project->title }}</h4>
                        <span class="text-xs text-gray-500 font-orbitron">{{ \Carbon\Carbon::parse($project->date)->format('M Y') }}</span>
                    </div>
                    <p class="text-gray-400 text-sm mb-8 line-clamp-3">{{ $project->description }}</p>
                    
                    <div class="flex gap-4 mt-auto">
                        <button @click="currentProject = {{ $project->toJson() }}; openEdit = true" 
                            class="flex-1 glass py-2 rounded-xl border border-neon-blue/50 text-neon-blue hover:bg-neon-blue hover:text-white transition-all text-sm font-orbitron">
                            EDIT
                        </button>
                        <form action="/projects/delete/{{ $project->id }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-12 h-10 glass rounded-xl border border-red-500/50 text-red-500 hover:bg-red-500 hover:text-white transition-all flex items-center justify-center">
                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Empty State / Add Card -->
            @if($projects->isEmpty())
            <div @click="openAdd = true" class="glass rounded-3xl h-[450px] border-2 border-dashed border-gray-700 hover:border-neon-blue transition-all duration-300 flex flex-col items-center justify-center cursor-pointer group">
                <div class="w-20 h-20 bg-dark-gray rounded-full flex items-center justify-center mb-6 group-hover:shadow-neon-blue transition-all">
                    <i data-lucide="plus" class="w-10 h-10 text-gray-600 group-hover:text-neon-blue"></i>
                </div>
                <p class="font-orbitron text-gray-500 group-hover:text-neon-blue">TAMBAH PROJECT BARU</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Modals -->
    <!-- Add Project Modal -->
    <div x-show="openAdd" x-cloak class="fixed inset-0 z-[60] flex items-center justify-center p-6 bg-dark-black/80 backdrop-blur-sm">
        <div @click.away="openAdd = false" class="glass w-full max-w-xl p-10 rounded-3xl neon-border-blue relative">
            <button @click="openAdd = false" class="absolute top-6 right-6 text-gray-500 hover:text-white"><i data-lucide="x"></i></button>
            <h3 class="text-2xl font-orbitron font-bold neon-text-blue mb-8">TAMBAH PROJECT</h3>
            
            <form action="/projects/store" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="font-orbitron text-xs text-neon-blue">JUDUL PROJECT</label>
                    <input type="text" name="title" required class="w-full bg-dark-gray border border-white/10 rounded-xl px-4 py-3 text-white focus:border-neon-blue focus:ring-0 outline-none">
                </div>
                <div class="space-y-2">
                    <label class="font-orbitron text-xs text-neon-blue">DESKRIPSI</label>
                    <textarea name="description" required rows="3" class="w-full bg-dark-gray border border-white/10 rounded-xl px-4 py-3 text-white focus:border-neon-blue focus:ring-0 outline-none"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="font-orbitron text-xs text-neon-blue">TANGGAL</label>
                        <input type="date" name="date" required class="w-full bg-dark-gray border border-white/10 rounded-xl px-4 py-3 text-white focus:border-neon-blue focus:ring-0 outline-none">
                    </div>
                    <div class="space-y-2">
                        <label class="font-orbitron text-xs text-neon-blue">JENIS</label>
                        <select name="type" required class="w-full bg-dark-gray border border-white/10 rounded-xl px-4 py-3 text-white focus:border-neon-blue focus:ring-0 outline-none">
                            <option value="Tugas">Tugas</option>
                            <option value="Hobi">Hobi</option>
                        </select>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="font-orbitron text-xs text-neon-blue">FOTO PROJECT</label>
                    <input type="file" name="image" required class="w-full bg-dark-gray border border-white/10 rounded-xl px-4 py-3 text-gray-500">
                </div>
                <button type="submit" class="w-full py-4 rounded-xl bg-neon-blue text-dark-black font-orbitron font-bold hover:shadow-neon-blue transition-all">SIMPAN PROJECT</button>
            </form>
        </div>
    </div>

    <!-- Edit Project Modal -->
    <div x-show="openEdit" x-cloak class="fixed inset-0 z-[60] flex items-center justify-center p-6 bg-dark-black/80 backdrop-blur-sm">
        <div @click.away="openEdit = false" class="glass w-full max-w-xl p-10 rounded-3xl neon-border-purple relative">
            <button @click="openEdit = false" class="absolute top-6 right-6 text-gray-500 hover:text-white"><i data-lucide="x"></i></button>
            <h3 class="text-2xl font-orbitron font-bold neon-text-purple mb-8">EDIT PROJECT</h3>
            
            <form :action="'/projects/update/' + currentProject.id" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="font-orbitron text-xs text-neon-purple">JUDUL PROJECT</label>
                    <input type="text" name="title" x-model="currentProject.title" required class="w-full bg-dark-gray border border-white/10 rounded-xl px-4 py-3 text-white focus:border-neon-purple focus:ring-0 outline-none">
                </div>
                <div class="space-y-2">
                    <label class="font-orbitron text-xs text-neon-purple">DESKRIPSI</label>
                    <textarea name="description" x-model="currentProject.description" required rows="3" class="w-full bg-dark-gray border border-white/10 rounded-xl px-4 py-3 text-white focus:border-neon-purple focus:ring-0 outline-none"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="font-orbitron text-xs text-neon-purple">TANGGAL</label>
                        <input type="date" name="date" x-model="currentProject.date" required class="w-full bg-dark-gray border border-white/10 rounded-xl px-4 py-3 text-white focus:border-neon-purple focus:ring-0 outline-none">
                    </div>
                    <div class="space-y-2">
                        <label class="font-orbitron text-xs text-neon-purple">JENIS</label>
                        <select name="type" x-model="currentProject.type" required class="w-full bg-dark-gray border border-white/10 rounded-xl px-4 py-3 text-white focus:border-neon-purple focus:ring-0 outline-none">
                            <option value="Tugas">Tugas</option>
                            <option value="Hobi">Hobi</option>
                        </select>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="font-orbitron text-xs text-neon-purple">GANTI FOTO (OPSIONAL)</label>
                    <input type="file" name="image" class="w-full bg-dark-gray border border-white/10 rounded-xl px-4 py-3 text-gray-500">
                </div>
                <button type="submit" class="w-full py-4 rounded-xl bg-neon-purple text-white font-orbitron font-bold hover:shadow-neon-purple transition-all">UPDATE PROJECT</button>
            </form>
        </div>
    </div>
</div>
@endsection
