@props([
    'message',
    'type' => 'info',
    'alert' => [
        'info' => [
            'class' => 'alert-info',
            'icon' => 'fa fa-info-circle'
        ],
        'success' => [
            'class' => 'alert-success',
            'icon' => 'fa fa-check-circle'
        ],
        'error' =>  [
            'class' => 'alert-danger',
            'icon' => 'fa fa-exclamation-circle'
        ],
        'warning' => [
            'class' => 'alert-warning',
            'icon' => 'fa fa-warning'
        ]
    ]
])

<div {{ $attributes->class(["alert wow fadeIn {$alert[$type]['class']}"]) }}>
    <span class="text">
        <i class="{{ $alert[$type]['icon'] }}"></i>
        {{ $message }}
    </span>
</div>