@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        @php
            $levelClasses = [
                'success' => 'bg-green-100 border-green-400 text-green-700',
                'error' => 'bg-red-100 border-red-400 text-red-700',
                'warning' => 'bg-yellow-100 border-yellow-400 text-yellow-700',
                'info' => 'bg-blue-100 border-blue-400 text-blue-700',
            ];
            $levelClass = $levelClasses[$message['level']] ?? $levelClasses['info'];
        @endphp
        <div class="border-l-4 p-4 mb-4 {{ $levelClass }}" role="alert">
            {!! $message['message'] !!}
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
