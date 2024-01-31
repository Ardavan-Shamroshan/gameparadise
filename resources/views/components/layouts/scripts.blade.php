
@include('sweetalert::alert')

<!-- Javascript -->
<script src="{{ asset("assets/js/jquery.min.js") }}"></script>
<script src="{{ asset("assets/js/popper.min.js") }}"></script>
<script src="{{ asset("assets/js/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset("assets/js/bootstrap.min.js") }}"></script>
<script src="{{ asset('assets/js/jquery.lazy/jquery.lazy.min.js') }}"></script>
<script src="{{ asset("assets/js/swiper-bundle.min.js") }}"></script>
<script src="{{ asset("assets/js/swiper.js") }}"></script>
<script src="{{ asset("assets/js/count-down.js") }}"></script>
<script src="{{ asset("assets/js/simpleParallax.min.js") }}"></script>
<script src="{{ asset("assets/js/gsap.js") }}"></script>
<script src="{{ asset("assets/js/SplitText.js") }}"></script>
<script src="{{ asset("assets/js/wow.min.js") }}"></script>
<script src="{{ asset("assets/js/ScrollTrigger.js") }}"></script>
<script src="{{ asset("assets/js/gsap-animation.js") }}"></script>
<script src="{{ asset("assets/js/tsparticles.min.js") }}"></script>
<script src="{{ asset("assets/js/tsparticles.js") }}"></script>
<script src="{{ asset("assets/js/main.js") }}"></script>
<script src="{{ asset("assets/js/override.js") }}"></script>

<script>
    function preloadImages(array) {
        if (!preloadImages.list) {
            preloadImages.list = [];
        }
        var list = preloadImages.list;
        for (var i = 0; i < array.length; i++) {
            var img = new Image();
            img.onload = function () {
                var index = list.indexOf(this);
                if (index !== -1) {
                    // remove image from the array once it's loaded
                    // for memory consumption reasons
                    list.splice(index, 1);
                }
            }
            list.push(img);
            img.src = array[i];
        }
    }

    var imgs = document.getElementsByTagName('img'), t = [];
    for (var i = 0, n = imgs.length; i < n; i++)
        t.push(imgs[i].src);
    preloadImages(t);
</script>

@stack('script')

@livewireScripts

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-livewire-alert::scripts/>

