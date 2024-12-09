window.deleteTask = function (taskId) {
    if (confirm("Apakah Anda yakin ingin menghapus tugas ini?")) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const errorMessage = document.getElementById('error-alert-message');

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
                window.location.href = '/';
            } else {
                errorMessage.classList.remove('hidden');
                errorMessage.innerHTML = data.message;
            }
        }).catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus tugas.');
        });
    }
}