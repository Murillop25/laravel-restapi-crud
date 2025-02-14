<li @isset($item['id']) id="{{ $item['id'] }}" @endisset class="nav-item">

    <a class="nav-link {{ $item['class'] }} @isset($item['shift']) {{ $item['shift'] }} @endisset"
       href="{{ $item['href'] }}" @isset($item['target']) target="{{ $item['target'] }}" @endisset
       {!! $item['data-compiled'] ?? '' !!}>

        <i class="{{ $item['icon'] ?? 'far fa-fw fa-circle' }} {{
            isset($item['icon_color']) ? 'text-'.$item['icon_color'] : ''
        }}"></i>

        <p>
            {{ $item['text'] }}

            @if($item['text'] === 'Lista de Estudiantes')
            <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} right">
                {{ $total_students ?? 0 }}
            </span>
            @elseif(isset($item['label']))
            <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} right">
                {{ $item['label'] }}
            </span>
            @endif
        
        </p>

    </a>

</li>
