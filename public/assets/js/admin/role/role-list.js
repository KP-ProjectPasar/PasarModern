// Role List JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const roleRows = document.querySelectorAll('.role-row');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            roleRows.forEach(row => {
                const name = row.getAttribute('data-name');
                const status = row.getAttribute('data-status');

                const matches = name.includes(searchTerm) ||
                               status.includes(searchTerm);

                row.style.display = matches ? '' : 'none';
            });
        });
    }

    // Ensure modal is closed on load if it exists
    const initialModal = document.getElementById('deleteModal');
    if (initialModal && initialModal.classList.contains('show')) {
        initialModal.classList.remove('show');
    }

    window.editRole = function(id) {
        window.location.href = `/admin/role/edit/${id}`;
    };

    window.deleteRole = function(id, name) {
        const titleEl = document.getElementById('deleteRoleTitle');
        const btnEl = document.getElementById('deleteRoleBtn');
        const modal = document.getElementById('deleteModal');
        if (titleEl && btnEl && modal) {
            titleEl.textContent = name;
            btnEl.href = `/admin/role/delete/${id}`;
            modal.classList.add('show');

            // close when clicking on the backdrop
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeDeleteModal();
                }
            });

            // close on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeDeleteModal();
                }
            });
        } else {
            // Fallback to native confirm if modal markup is missing
            if (confirm(`Apakah Anda yakin ingin menghapus role "${name}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
                window.location.href = `/admin/role/delete/${id}`;
            }
        }
    };

    window.closeDeleteModal = function() {
        const modal = document.getElementById('deleteModal');
        if (modal) modal.classList.remove('show');
    }
});