<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/aos.js') }}"></script>
<script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('js/scrollax.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="{{ asset('js/google-map.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    function previewProfile(event) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('preview-image').src = e.target.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<script>
    function updateFileName(event) {
        const file = event.target.files[0];
        if (file) {
            document.getElementById('cv-file-name').textContent = `Selected: ${file.name}`;
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.5/awesomplete.min.js"></script>
<script>
    function previewProfile(event) {
        const file = event.target.files[0];
        const warning = document.getElementById('profile-size-warning');
        const preview = document.getElementById('preview-image');
        const defaultImage = '{{ asset('images/default.jpg') }}';
        const maxSize = 1000;

        if (file) {
            const sizeKB = file.size / 1024;

            if (sizeKB > maxSize) {
                warning.className = 'alert alert-danger mt-2 p-2';
                warning.classList.remove('d-none');
                warning.innerHTML = `<strong>❌ File too large!</strong> Image size: ${sizeKB.toFixed(1)}KB — Max allowed: ${maxSize}KB`;
                event.target.value = '';
                preview.src = defaultImage;
            } else {
                warning.classList.add('d-none');
                preview.src = URL.createObjectURL(file);
            }
        } else {
            warning.classList.add('d-none');
            preview.src = defaultImage;
        }
    }

    function updateFileName(event) {
        const file = event.target.files[0];
        const nameBox = document.getElementById('cv-file-name');
        const warning = document.getElementById('cv-size-warning');
        const maxSize = 1024;

        if (file) {
            const sizeKB = file.size / 1024;

            if (sizeKB > maxSize) {
                warning.className = 'alert alert-danger mt-2 p-2';
                warning.classList.remove('d-none');
                warning.innerHTML = `<strong>❌ File too large!</strong> CV size: ${sizeKB.toFixed(1)}KB — Max allowed: ${maxSize}KB`;
                event.target.value = '';
                nameBox.innerHTML = 'Click to upload CV (PDF)';
            } else {
                warning.classList.add('d-none');
                nameBox.innerHTML = 'Selected file: ' + file.name;
            }
        } else {
            warning.classList.add('d-none');
            nameBox.innerHTML = 'Click to upload CV (PDF)';
        }
    }
</script>
