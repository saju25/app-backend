<div class="mt-5">
    <a href="{{route('complete_order_list')}}">statut de paiement</a>
    <a href="{{route('admin_index')}}">Liste des boutiques</a>
    <a href="{{route('driver_index')}}">Liste de Livreurs    </a>
    <a href="{{route('banner_index')}}">Liste des bannières</a>
    <a href="{{route('banner_create')}}">Ajouter une bannière</a>
   
    <a href="{{route('admin_list')}}">Liste d'administrateurs</a>
    <a href="{{route('admin_add')}}">Ajouter un administrateur</a>
    <a href="{{route('message')}}">Envoyer une notification</a>
    <a href="{{ route('delivryfee', ['id' => 1]) }}">Frais de livraison</a>


    {{-- {{route('admin_list')}} --}}
</div>