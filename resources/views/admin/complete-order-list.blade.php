<x-guest-layout>
    <!-- Sidebar -->
    <div class="sidebar collapse d-md-block" id="sidebar">
        @include('admin.sidebar')
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="nav_container">
            <div class="nav_div">
                <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </nav>
            </div>
        </div>

        <div class="container">
            <div class="conten_div">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>Admin ID</th>
                            <th>Statut de paiement du livreur</th>
                            <th>Statut de paiement de la boutique</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $index => $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>Veuillez payer manuellement et mettre à jour le statut du paiement. Le numéro de paiement est le  {{ $dms[$index]->dm_phone ?? 'No driver' }}</td> 
                                <td>Veuillez payer manuellement et mettre à jour le statut du paiement. Le numéro de paiement est le <span class=" text-bold">{{ $shops[$index]->shop_phone ?? 'No shop' }}</span> </td> 
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No orders found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-guest-layout>
