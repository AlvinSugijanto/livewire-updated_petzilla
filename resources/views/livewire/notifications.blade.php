<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    @push('scripts')
    <script>
        window.addEventListener('payment-success', function() {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 10000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'Pembayaran Pada Transaksi #123103123012 Berhasil'
            })
        });
    </script>
    @endpush
</div>