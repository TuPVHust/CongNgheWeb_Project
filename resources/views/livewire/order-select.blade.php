<div class="radio__div">
    <label class="m-0 p-0"><i @class([
        'fas fa-sort-up fa-2x up__sort',
        'selected__order' => $sortOrder == 'asc',
    ]) style="cursor: pointer;"></i>
        <input wire:model="sortOrder" value="asc" type="radio" {{ $sortOrder == 'asc' ? 'checked = "checked"' : '' }}
            name="radio" style="position: absolute;
        opacity: 0;
        cursor: pointer;" onchange="handleChange(this);">
        <span class="radio__checkmark"></span>
    </label>
    <label class=" m-0 p-0"><i @class([
        'fas fa-sort-down fa-2x down__sort',
        'selected__order' => $sortOrder == 'desc',
    ]) style="cursor: pointer"></i>
        <input wire:model="sortOrder" value="desc" type="radio"
            {{ $sortOrder == 'desc' ? 'checked = "checked"' : '' }} name="radio" style="position: absolute;
        opacity: 0;
        cursor: pointer;" onchange="handleChange(this);">
    </label>
</div>
<script>
    function handleChange(src) {
        Livewire.emit('orderChange', src.value);
    }
</script>
