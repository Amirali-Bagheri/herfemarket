<script>
    window.addEventListener('swal:modal', event => {
        swal({
            title: event.detail.message,
            text: event.detail.text,
            icon: event.detail.type,
        });
    });

    window.addEventListener('swal:confirm', event => {
        swal({
            title: event.detail.message,
            text: event.detail.text,
            icon: event.detail.type,
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.livewire.emit('remove');
                }
            });
    });

</script>

{{--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>--}}
@livewireScripts

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>

<x-livewire-alert::scripts />

<x-livewire-alert::flash />
{{--
<script>
    document.addEventListener('livewire:load', function () {

    @this.on('swal_loading', () => {
        let timerInterval;
        Swal.fire({
            title: 'در حال بارگذاری',
            timer: 100000,
            timerProgressBar: false,
            didOpen: () => {
                Swal.showLoading();
                timerInterval = setInterval(() => {
                    const content = Swal.getHtmlContainer();
                    if (content) {
                        const b = content.querySelector('b');
                        if (b) {
                            b.textContent = Swal.getTimerLeft();
                        }
                    }
                }, 100000);
            },
            willClose: () => {
                clearInterval(timerInterval);
            },
        });
    });

    });
</script>--}}
{{--<script defer src="https://pro.fontawesome.com/releases/v5.10.0/js/all.js" integrity="sha384-G/ZR3ntz68JZrH4pfPJyRbjW+c0+ojii5f+GYiYwldYU69A+Ejat6yIfLSxljXxD" crossorigin="anonymous"></script>--}}
{{--<script defer src="https://pro.fontawesome.com/releases/v5.10.0/js/all.js" integrity="sha384-G/ZR3ntz68JZrH4pfPJyRbjW+c0+ojii5f+GYiYwldYU69A+Ejat6yIfLSxljXxD" crossorigin="anonymous"></script>--}}

{{--<script src="/icons/fontawesome6/js/fontawesome.min.js" defer></script>--}}
{{----}}
{{--<script src="/icons/fontawesome6/js/light.min.js" defer></script>--}}
{{--<script src="/icons/fontawesome6/js/regular.min.js" defer></script>--}}
{{--<script src="/icons/fontawesome6/js/solid.min.js" defer></script>--}}
{{--<script src="/js/fontawesome.min.js" defer async></script>--}}
{{--<script defer src="https://pro.fontawesome.com/releases/v5.10.0/js/all.js" integrity="sha384-G/ZR3ntz68JZrH4pfPJyRbjW+c0+ojii5f+GYiYwldYU69A+Ejat6yIfLSxljXxD" crossorigin="anonymous"></script>--}}
{{--<script src="/icons/fontawesome6/js/all.min.js" defer></script>--}}
{{--<script src="/icons/fontawesome6/js/brands.min.js" defer></script>--}}
{{--<script src="/js/all.min.js" defer async></script>--}}
{{--<script src="/js/icons.js" async></script>--}}
