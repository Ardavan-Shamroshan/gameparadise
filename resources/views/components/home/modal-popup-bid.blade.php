@props(['content'])


<div {{ $attributes->merge(['class' => 'modal fade popup', 'tabindex'=>"-1" ,'role'=>"dialog", 'aria-hidden'=>"true"]) }}>
    <div class="modal-dialog modal-dialog-centered" role="document" style="padding: 11rem 3rem;">
        <div class="modal-content">

            {{ $content }}

        </div>
    </div>
</div>
