// resources/js/employeeForm.js

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('employeeForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            // Clear previous errors
            document.querySelectorAll('.text-danger').forEach(el => el.textContent = '');

            if (data.errors) {
                if (data.errors.firstName) document.getElementById('firstNameError').textContent = data.errors.firstName[0];
                if (data.errors.lastName) document.getElementById('lastNameError').textContent = data.errors.lastName[0];
                if (data.errors.email) document.getElementById('emailError').textContent = data.errors.email[0];
                if (data.errors.age) document.getElementById('ageError').textContent = data.errors.age[0];
                if (data.errors.position) document.getElementById('positionError').textContent = data.errors.position[0];
            } else {
                alert('Employee created successfully!');
                window.location.href = data.redirect;  // Assuming the server returns a redirect URL
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
