// Interaksi Feedback E-Pasar

document.addEventListener('DOMContentLoaded', function() {
    // Rating bintang
    const stars = document.querySelectorAll('#ratingStars .bi-star');
    const ratingInput = document.getElementById('rating');
    let currentRating = 0;

    stars.forEach(star => {
        star.addEventListener('mouseenter', function() {
            const val = parseInt(this.getAttribute('data-value'));
            highlightStars(val);
        });
        star.addEventListener('mouseleave', function() {
            highlightStars(currentRating);
        });
        star.addEventListener('click', function() {
            currentRating = parseInt(this.getAttribute('data-value'));
            ratingInput.value = currentRating;
            highlightStars(currentRating);
        });
    });

    function highlightStars(val) {
        stars.forEach(star => {
            if (parseInt(star.getAttribute('data-value')) <= val) {
                star.classList.add('text-warning');
                star.classList.remove('text-secondary');
            } else {
                star.classList.remove('text-warning');
                star.classList.add('text-secondary');
            }
        });
    }
    highlightStars(0);

    // Form feedback
    const feedbackForm = document.getElementById('feedbackForm');
    const feedbackMsg = document.getElementById('feedbackMsg');
    if (feedbackForm) {
        feedbackForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const nama = feedbackForm.nama.value.trim();
            const email = feedbackForm.email.value.trim();
            const pesan = feedbackForm.pesan.value.trim();
            const rating = feedbackForm.rating.value;

            if (!nama || !email || !pesan || rating === '0') {
                feedbackMsg.innerHTML = '<div class="alert alert-warning">Mohon isi semua field dan berikan rating.</div>';
                return;
            }

            // Simulasi submit (bisa diubah ke AJAX/backend)
            feedbackMsg.innerHTML = '<div class="alert alert-success">Terima kasih atas feedback Anda!</div>';
            feedbackForm.reset();
            highlightStars(0);
            currentRating = 0;
        });
    }
}); 