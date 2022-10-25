<div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        @forelse ($vacantes as $vacante )
        <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
            <div class="space-y-3">

                <a href="{{ route('vacantes.show', $vacante->id)}}" class="text-xl font-bold">
                    {{ $vacante->titulo}}
                </a>
                <p class="text-sm text-gray-600 font-bold">
                    {{ $vacante->empresa}}
                </p>
                <p class="text-sm text-gray-500">
                    Ultimo dia {{ $vacante->ultimo_dia->format('d/m/y')}}
                </p>
            </div>
            <div class="flex flex-col md:flex-row gap-3 items-stretch mt-5 md:mt-0">
                <a class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                    href="#">
                    Candidatos

                </a>
                <a href="{{route('vacantes.edit',$vacante->id)}}"
                    class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                    href="#">
                    Editar

                </a>
                <button class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                    wire:click="$emit('mostrarAlerta',{{$vacante->id}})">
                    Eliminar

                </button>

            </div>
        </div>

        @empty
        <p class="p-3 text-center text-sm text-gray-600">No hay vacantes para mostrar</p>

        @endforelse

    </div>

    <div class="flex justify-center mt-10">
        {{$vacantes->links()}}

    </div>


</div>

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    Livewire.on('mostrarAlerta', vacante_id =>{ 
        Swal.fire({
            title: '¿Eliminar Vacante?',
            text: "Una vacante eliminada no se puede recuperar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonCoslor: '#d33',
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
        if (result.isConfirmed) {
            //eliminar la vacante 
            Livewire.emit('eliminarVacante',vacante_id)

            Swal.fire(
            '¡Se elimino la vacante!',
            'El registro fue eliminado',
            'success'
            )
        }
        })
    })

</script>

@endpush