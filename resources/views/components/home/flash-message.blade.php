@if($errors->any())
    <x-home.alert type="error" {{ $attributes->class(['mt-5']) }}>
        @foreach($errors->all() as $error)
            <x-slot:message>{{ $error }}</x-slot:message>
        @endforeach
    </x-home.alert>
@endif