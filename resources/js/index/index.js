const errorMessage = document.getElementById('error-alert-message');
const successMessage = document.getElementById('success-alert-message');
const successMessageContainer = document.getElementById('successMessageContainer');
const errorMessageContainer = document.getElementById('errorMessageContainer');

// Fungsi Tambah Tugas
document.getElementById('form-input-data').addEventListener('submit', function (event) {
    event.preventDefault();

    const inputElement = document.getElementById('input-data');
    const inputData = inputElement.value.trim();
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    if (!inputData) {
        errorMessageContainer.classList.remove('hidden');
        errorMessage.innerHTML = 'Tugas tidak boleh kosong.';
        return;
    }

    // Fetch untuk mengirim data ke server
    fetch('tasks', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ 'todo_tasks': inputData }) // Pastikan key sesuai dengan backend
    }).then(response => {
        console.log(response);
        if (!response.ok) {
            throw new Error(`Failed to submit data: ${response.statusText}`);
        }
        return response.json();
    }).then(data => {
        if (data.success) {
            // Reset input
            inputElement.value = '';
            successMessageContainer.classList.remove('hidden');
            successMessage.innerHTML = data.message;

            // Redirect setelah 1 detik
            setTimeout(() => {
                window.location.href = '/';
            }, 1000);
        } else {
            errorMessageContainer.classList.remove('hidden');
            errorMessage.innerHTML = data.message;
        }
    }).catch(error => {
        console.error(`${error}`);
        alert(error);
    });
});

// Fungsi Hapus Tugas
window.deleteTask = function (taskId) {
    if (confirm("Apakah Anda yakin ingin menghapus tugas ini?")) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Fetch untuk menghapus data
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
                successMessageContainer.classList.remove('hidden');
                successMessage.innerHTML = data.message;

                // Redirect setelah 1 detik
                setTimeout(() => {
                    window.location.href = '/';
                }, 1000);
            } else {
                errorMessageContainer.classList.remove('hidden');
                errorMessage.innerHTML = data.message;
            }
        }).catch(error => {
            console.error(`Error: ${error.message}`);
            alert('Terjadi kesalahan saat menghapus tugas. Silakan coba lagi.');
        });
    }
};

// Fungsi untuk menyembunyikan pesan error atau success
function hideMessages() {
    if (successMessageContainer) {
        successMessageContainer.classList.add('hidden');
    }
    if (errorMessageContainer) {
        errorMessageContainer.classList.add('hidden');
    }
}

// Jalankan hideMessages pada load awal
document.addEventListener('DOMContentLoaded', hideMessages());