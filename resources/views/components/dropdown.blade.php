<div class="dropdown">
    <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Dropdown
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        @foreach ($items as $item)
            <a class="dropdown-item" href="{{ $item['href'] }}">{{ $item['label'] }}</a>
        @endforeach
    </div>
</div>
