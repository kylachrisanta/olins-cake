<?php if (isset($_SESSION['success']) || isset($_SESSION['error'])): ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        
        <?php if (isset($_SESSION['success'])): ?>
            Toast.fire({
                icon: 'success',
                title: <?= json_encode($_SESSION['success']) ?>
            });
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            Toast.fire({
                icon: 'error',
                title: <?= json_encode($_SESSION['error']) ?>
            });
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    });
</script>
<?php endif; ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selects = document.querySelectorAll('select.form-control');
        selects.forEach(function(select) {
            new TomSelect(select, {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });

        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.getAttribute('href');
                const text = this.getAttribute('data-text') || "Data ini tidak dapat dikembalikan!";
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e74c3c',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
    });
</script>
</body>
</html>
