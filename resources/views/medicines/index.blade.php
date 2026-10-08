<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Meus Medicamentos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-900">Lista de Rémedios</h3>
                    <a href="{{ route('medicines.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-md text-sm shadow-sm">+ Novo Medicamento</a>

                </div>

                @if (session('sucess'))
                    <div class="mb-4 p-4 bg-green-400 text-green-700 rounded-md text-sm">
                        {{ session('sucess') }}
                    </div>    
                @endif           
                @forelse ($medicines as $medicine)

                    <div class="flex items-center space-x-2">
                     <a href="{{ route('medicines.edit', $medicine) }}" class="px-3 py-1 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-md text-sm">
                    Editar
                    </a>
                    <form action="{{ route('medicines.destroy', $medicine) }}" method="POST" onsubmit="return   confirm('Tem certeza que deseja excluir este medicamento?');">
                         @csrf
                         @method('DELETE')
                         <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white font-medium rounded-md        text-sm">
                         Excluir
                        </button>
                    </form>
                    </div>

                    
                    <div class="mb-4 p-4 border rounded">
                        <h3 class="text-lg font-semibold">{{ $medicine->name }}</h3>
                        <p class="text-gray-600">Dosagem: {{ $medicine->dosage }}</p>
                        <p class="text-gray-600">Frequencia: {{ $medicine->frequency }}</p>
                    </div>
                @empty
                    <p class="text-gray-600">Nenhum medicamento encontrado.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>