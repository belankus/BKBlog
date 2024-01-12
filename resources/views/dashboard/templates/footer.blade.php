<script>
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

</body>

</html>