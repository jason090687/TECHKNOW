document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById('login-form');
    const dashboard = document.getElementById('dashboard');
    const loginError = document.getElementById('login-error');
    const editModal = document.getElementById('edit-modal');
    const editForm = document.getElementById('edit-form');

    function showLoginForm() {
        loginForm.style.display = 'flex';
        dashboard.style.display = 'none';
    }

    function showDashboard() {
        loginForm.style.display = 'none';
        dashboard.style.display = 'flex';
    }

    // window.login = function() {
    //     const username = document.getElementById('username').value;
    //     const password = document.getElementById('password').value;

    //     if (username === 'admin' && password === 'admin') {
    //         showDashboard();
    //         localStorage.setItem('isLoggedIn', 'true');
    //     } else {
    //         loginError.textContent = 'Invalid username or password';
    //     }
    // }

    window.logout = function() {
        showLoginForm();
        localStorage.removeItem('isLoggedIn');
    }

    window.editCustomer = function(id) {
        fetch(`get_config.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('edit-id').value = data.customer_id;
                document.getElementById('edit-name').value = data.customer_name;
                document.getElementById('edit-shipping_address').value = data.shipping_address;
                document.getElementById('edit-contact_number').value = data.contact_number;
                document.getElementById('edit-password').value = data.password;
                editModal.style.display = 'block';
            })
            .catch(error => console.error('Error fetching customer:', error));
    }

    window.closeModal = function() {
        editModal.style.display = 'none';
    }

    window.saveCustomer = function() {
        const id = document.getElementById('edit-id').value;
        const customer_name = document.getElementById('edit-name').value;
        const shipping_address = document.getElementById('edit-shipping_address').value;
        const contact_number = document.getElementById('edit-contact_number').value;
        const password = document.getElementById('edit-password').value;

        fetch(`update_config.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ customer_id: id, customer_name, shipping_address, contact_number, password })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Customer updated successfully');
                window.location.reload();
            } else {
                alert('Error updating customer');
            }
        })
        .catch(error => console.error('Error updating customer:', error));
    }

    window.deleteCustomer = function(id) {
        if (confirm('Are you sure you want to delete this customer?')) {
            fetch(`delete_config.php?id=${id}`, { method: 'DELETE' })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Customer deleted successfully');
                        window.location.reload();
                    } else {
                        alert('Error deleting customer');
                    }
                })
                .catch(error => console.error('Error deleting customer:', error));
        }
    }

    if (localStorage.getItem('isLoggedIn') === 'true') {
        showDashboard();
    } else {
        showLoginForm();
    }
});
