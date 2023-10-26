<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Adicionando a lista de notificações recebidas -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Você está logado
                    <br><br>
                    @if (isset(Auth::user()->unreadNotifications))
                        @foreach (Auth::user()->unreadNotifications as $notification)
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Olá {{ $notification->data[0]['name'] }}</strong>
                                {{ $notification->data['mensagem'] }}
                                <button type="button" class="close marcar-lido" data-id="{{ $notification->id }}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endforeach
                    @endif
                    <button type="button" id="marcar-todos" class="btn btn-dark">Marcar todos como lido</button>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            function marcarLido(id) {
                return $.ajax({
                    url: "{{ route('marcar.lido') }}",
                    mehtod: 'GET',
                    data: {
                        id: id,
                    }
                });
            }

            $(function() {
                $('.marcar-lido').click(function() {
                    let request = marcarLido($(this).data('id'));
                    request.done(() => {
                        $(this).parents('div.alert').remove();
                    });
                });

                $('#marcar-todos').click(function() {
                    let request = marcarLido();
                    request.done(() => {
                        $('div.alert').remove();
                    });
                });
            });
        </script>
    @endsection

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> --}}
</x-app-layout>
