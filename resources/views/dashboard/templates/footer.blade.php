<script type="module">
    const btn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('default-sidebar');
    const textMenu = document.querySelectorAll(`[id="textMenu"]`);
    const contentSection = document.getElementById('contentSection');

    btn.addEventListener('click', function() {
        sidebar.classList.toggle('w-64');
        sidebar.classList.toggle('w-16');
        textMenu.forEach(txtMenu => {
            txtMenu.classList.toggle('w-0');
            txtMenu.classList.toggle('overflow-hidden');
            //   console.log(element.textContent);
        });
        contentSection.classList.toggle('sm:ml-64');
        contentSection.classList.toggle('sm:ml-16');
    });
</script>
@if (Request::is('dashboard/posts/create'))
    <script type="module">
        const fp = flatpickr("#published_at", {});
        const btnClear = document.getElementById('btnClear');

        btnClear.addEventListener('click', function() {
            fp.clear();
        })

        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function() {
            fetch('/dashboard/posts/checkSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)

        });
    </script>
@endif
<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>

</body>

</html>
