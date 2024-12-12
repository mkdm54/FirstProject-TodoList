window.deleteTask = function (taskId) {
    if (confirm("Apakah Anda yakin ingin menghapus tugas ini?")) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const errorMessage = document.getElementById('error-alert-message');
        const successMessage = document.getElementById('success-alert-message');
        const successMessageContainer = document.getElementById('successMessageContainer');
        const errorMessageContainer = document.getElementById('errorMessageContainer');
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
                setTimeout(() => {
                    window.location.href = '/';
                }, 2000);
                successMessageContainer.classList.remove('hidden');
                successMessage.innerHTML = data.message;
            } else {
                errorMessageContainer.classList.remove('hidden');
                errorMessage.innerHTML = data.message;
            }
        }).catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus tugas.');
        });
    }
}