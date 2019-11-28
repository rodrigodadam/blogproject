const authors = document.getElementById('authors');

if (authors) {
    authors.addEventListener('click', e => {
        if (e.target.className === 'btn btn-outline-danger delete-author') {
            if (confirm('Do you confirm delete this Author?')) {
                const id = e.target.getAttribute('data-id');

                fetch(`/admin/author-delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}


