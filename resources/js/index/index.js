const { error } = require("laravel-mix/src/Log");
const { resolveConfig } = require("vite");

const errorMessage = document.getElementById('error-alert-message');
const successMessage = document.getElementById('success-alert-message');
const successMessageContainer = document.getElementById('successMessageContainer');
const errorMessageContainer = document.getElementById('errorMessageContainer');

//Fungsi Tambah Tugas
document.addEventListener('DOMContentLoaded', function () {
    const formInputData = document.getElementById('form-input-data');

    formInputData.addEventListener('submit', function (event) {
        event.preventDefault();

        const inputData = document.getElementById('input-data').value.trim();
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        fetch('tasks/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ 'inputData': inputData })
        }
        ).then(response => {
            if (!response.ok) {
                throw new Error(`Failed to sumbit data ${response.statusText}`);
            }
            return response.json();
        }).then(data => {
            if (data.success) {
                inputData.value = '';
                window.location.href = '/'
                successMessageContainer.classList.remove('hidden');
                successMessage.innerHTML = data.message;
            }
            else {
                errorMessageContainer.classList.remove('hidden');
                errorMessage.innerHTML = data.message;
            }
        }).catch(error => {
            console.log(`Error : ${error}`);
        });
    });
});

// Fungsi Hapus tugas
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
                setTimeout(() => {
                    window.location.href = '/';
                }, 1000);
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