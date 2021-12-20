<div class="col-lg-3 col-md-3">
    <div class="filter__option">
        <span @class([
            'icon_grid-2x2',
            'formSelected' => $viewForm == 'grid',
        ]) wire:click.prevent="$emit('ChangeviewFormat', 'grid')"></span>
        <span @class([
            'icon_ul',
            'formSelected' => $viewForm == 'list',
        ]) wire:click.prevent="$emit('ChangeviewFormat', 'list')"></span>
    </div>
</div>
