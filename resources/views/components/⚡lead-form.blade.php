<div class="p-6">
    <form wire:submit.prevent="submit">
        
        @if($step == 1)
            <h3>1. Quality Control</h3>
            <input wire:model="raison_sociale" type="text" placeholder="Raison Sociale">
            <button type="button" wire:click="nextStep">Suivant</button>
        @endif

        @if($step == 2)
            <h3>2. Adresse principale</h3>
            <input wire:model="adresse" type="text" placeholder="Adresse">
            <button type="button" wire:click="backStep">Retour</button>
            <button type="button" wire:click="nextStep">Suivant</button>
        @endif

        @if($step == 3)
            <h3>3. Choix du Produit</h3>
            <select wire:model="product_type">
                <option value="">Choisir un produit</option>
                <option value="lanterneau">Lanterneau</option>
                <option value="energie">Énergie</option>
            </select>

            @if($product_type == 'lanterneau')
                <input wire:model="superficie_lanterneau" type="number" placeholder="Superficie">
            @elseif($product_type == 'energie')
                <input wire:model="mensualite_annoncee" type="number" placeholder="Mensualité">
            @endif

            <button type="button" wire:click="backStep">Retour</button>
            <button type="submit">Enregistrer la fiche</button>
        @endif
    </form>
</div>