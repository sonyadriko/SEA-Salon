document.getElementById('toggle-btn').addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('hidden');
    document.getElementById('content').classList.toggle('collapsed');
    document.getElementById('toggle-btn-container').classList.toggle('collapsed');
});