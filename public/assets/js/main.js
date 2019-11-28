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

const categories = document.getElementById('categories');

if (categories) {
    categories.addEventListener('click', e => {
        if (e.target.className === 'btn btn-outline-danger delete-category') {
            if (confirm('Do you confirm delete this category?')) {
                const id = e.target.getAttribute('data-id');

                fetch(`/admin/category-delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}