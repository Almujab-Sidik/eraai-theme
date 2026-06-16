document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('era-contact-form');
    if (!contactForm) return;

    const btnSubmit = document.getElementById('btn-submit');
    const btnText = btnSubmit.querySelector('.btn-text');
    const btnSpinner = btnSubmit.querySelector('.btn-spinner');
    const feedbackBox = document.getElementById('form-feedback');

    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();

        // Client-side validation fallback
        const fullname = document.getElementById('fullname').value.trim();
        const email = document.getElementById('email').value.trim();
        const subject = document.getElementById('subject').value.trim();
        const message = document.getElementById('message').value.trim();

        if (!fullname || !email || !subject || !message) {
            showFeedback('Semua kolom wajib diisi.', 'error');
            return;
        }

        // Set loading state
        setLoading(true);
        hideFeedback();

        // Setup request body
        const formData = new FormData(contactForm);
        formData.append('action', 'submit_contact_form');
        formData.append('nonce', eraai_contact_ajax.nonce);

        fetch(eraai_contact_ajax.ajax_url, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Terjadi kesalahan koneksi server.');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showFeedback(data.data.message, 'success');
                contactForm.reset();
            } else {
                showFeedback(data.data.message || 'Gagal mengirim pesan.', 'error');
            }
        })
        .catch(error => {
            showFeedback(error.message || 'Terjadi kesalahan sistem. Silakan coba lagi.', 'error');
        })
        .finally(() => {
            setLoading(false);
        });
    });

    function setLoading(isLoading) {
        if (isLoading) {
            btnSubmit.disabled = true;
            btnSpinner.style.display = 'inline-block';
            btnText.textContent = 'Mengirim...';
        } else {
            btnSubmit.disabled = false;
            btnSpinner.style.display = 'none';
            btnText.textContent = 'Kirim Pesan';
        }
    }

    function showFeedback(message, type) {
        feedbackBox.textContent = message;
        feedbackBox.className = 'form-feedback ' + type;
        feedbackBox.style.display = 'block';
        
        // Scroll feedback box into view smoothly if it's outside viewport
        feedbackBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function hideFeedback() {
        feedbackBox.style.display = 'none';
        feedbackBox.textContent = '';
        feedbackBox.className = 'form-feedback';
    }
});
