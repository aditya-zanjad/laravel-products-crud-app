<!-- Breadcrumb -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        @foreach ($breadCrumbItems as $itemName => $itemRoute)
            @if (!$itemRoute)
                <li class="breadcrumb-item">
                    <a>{{ $itemName }}</a>
                </li>
                @continue
            @endif

            <li class="breadcrumb-item">
                <a href="{{ $itemRoute }}">{{ $itemName }}</a>
            </li>
        @endforeach
    </ol>
</div>
<!-- Breadcrumb -->