function deleteTask(taskId) {
    if (confirm("Apakah Anda yakin ingin menghapus tugas ini?")) {
        const csrfToken = '{{ csrf_token() }}';

        fetch(`/tasks/${taskId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mengarahkan ke halaman utama
                    window.location.href = '/';
                } else {
                    alert('Terjadi kesalahan saat menghapus tugas.');
                }
            }).catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus tugas.');
            });
    }
}