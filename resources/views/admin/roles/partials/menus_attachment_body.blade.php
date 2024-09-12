<div class="input-group input-group-sm mb-3">
    <span class="input-group-text" id="search_label">Search</span>
    <input class="form-control" type="text" id="search_menu"
           aria-label="Sizing example input" aria-describedby="search_label">
</div>

@forelse($menus as $menu)
    <div class="form-check menu-item">
        <input class="form-check-input" type="checkbox" id="check{{ $menu->id }}"
               name="menu_ids[]" value="{{ $menu->id }}">
        <label class="form-check-label" for="check{{ $menu->id }}">{{ $menu->title }}</label>
    </div>
@empty
    <p class="text-danger">
        No menu is available to attachment.
    </p>
@endforelse

<script>
    var search = document.getElementById('search_menu');
    var menuItems = document.querySelectorAll('.menu-item');

    search.addEventListener('keyup', function() {
        var query = search.value.toLowerCase();
        menuItems.forEach(function(item) {
            var label = item.querySelector('label').textContent.toLowerCase();
            if (label.includes(query)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
