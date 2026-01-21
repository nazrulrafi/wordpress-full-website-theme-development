document.addEventListener('DOMContentLoaded', function() {
    // Frontend form submission
    const form = document.getElementById('agentContactForm');
    if (form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(form);
            formData.append('action', 'agent_contact_submit');
            formData.append('nonce', agentContact.nonce);
            fetch(agentContact.ajax_url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams(formData).toString()
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.data.message);
                        form.reset();
                    } else {
                        alert('Error submitting form.');
                    }
                })
                .catch(() => alert('Server error. Please try again.'));
        });
    }

    // Admin delete/edit actions
    if (document.querySelector('.wp-list-table')) {
        // Delete contact
        document.querySelectorAll('.delete-contact').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                if (!confirm('Are you sure you want to delete this contact?')) return;
                const id = this.getAttribute('data-id');
                fetch(agentContact.ajax_url, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({
                        action: 'agent_contact_delete',
                        nonce: agentContact.nonce,
                        id: id
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.data.message);
                            location.reload();
                        } else {
                            alert('Error deleting contact.');
                        }
                    })
                    .catch(() => alert('Server error.'));
            });
        });

        // Edit contact
        document.querySelectorAll('.edit-contact').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const id = this.getAttribute('data-id');
                fetch(agentContact.ajax_url, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({
                        action: 'agent_contact_get',
                        nonce: agentContact.nonce,
                        id: id
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const modal = document.getElementById('edit-contact-modal');
                            modal.style.display = 'flex';
                            document.getElementById('edit-contact-id').value = data.data.id;
                            document.getElementById('edit-name').value = data.data.name;
                            document.getElementById('edit-phone').value = data.data.phone;
                            document.getElementById('edit-email').value = data.data.email;
                            document.getElementById('edit-message').value = data.data.message;
                        } else {
                            alert('Error loading contact.');
                        }
                    })
                    .catch(() => alert('Server error.'));
            });
        });

        // Edit form submission
        const editForm = document.getElementById('edit-contact-form');
        if (editForm) {
            editForm.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(editForm);
                formData.append('action', 'agent_contact_edit');
                formData.append('nonce', agentContact.nonce);
                fetch(agentContact.ajax_url, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams(formData).toString()
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.data.message);
                            document.getElementById('edit-contact-modal').style.display = 'none';
                            location.reload();
                        } else {
                            alert('Error updating contact.');
                        }
                    })
                    .catch(() => alert('Server error.'));
            });
        }
    }

    document.getElementById("calculateBtn").addEventListener("click", function(e) {
        e.preventDefault();

        let price = parseFloat(document.getElementById("salePrice").value) || 0;
        let down = parseFloat(document.getElementById("downPayment").value) || 0;
        let years = parseInt(document.getElementById("loanYears").value) || 0;
        let rate = parseFloat(document.getElementById("interestRate").value) || 0;

        // Loan amount
        let loanAmount = price - down;

        // Monthly interest rate
        let monthlyRate = rate / 100 / 12;

        // Number of payments
        let months = years * 12;

        // Monthly Payment Formula
        let monthlyPayment;
        if (rate > 0) {
            monthlyPayment = loanAmount * monthlyRate / (1 - Math.pow(1 + monthlyRate, -months));
        } else {
            monthlyPayment = loanAmount / months; // No interest case
        }

        document.getElementById("result").innerHTML = `
        Loan Amount: $${loanAmount.toFixed(2)} <br>
        Monthly Payment: $${monthlyPayment.toFixed(2)}
    `;
    });
});