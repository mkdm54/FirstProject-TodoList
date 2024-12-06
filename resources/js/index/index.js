window.deleteTask = function (taskId) {
    if (confirm("Apakah Anda yakin ingin menghapus tugas ini?")) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/tasks/${taskId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken // Menyertakan token CSRF di header
            }
        }).then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        }).then(data => {
            if (data.success) {
                // Hapus tugas dari daftar
                const taskItem = document.getElementById(`task-${taskId}`);
                if (taskItem) {
                    taskItem.remove();
                }
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