<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Cropping with Cropper.js and Alpine.js</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body x-data="imageCropper()">
    <input type="file" @change="previewImage($event)">
    <input type="hidden" name="setting_pic" id="setting_pic">
    <div class='flex w-3/4 gap-4'>
        <div class="h-96 w-3/4">
            <img class="block max-w-full" x-ref="imagePreview" src="" alt="Preview Image">
        </div>
        <div class="w-1/4">

            <img class="block max-w-full" x-ref="croppedPreview" src="" alt="Cropped Preview">
        </div>
    </div>

    <script>
        function imageCropper() {
            return {
                cropper: null,
                previewImage(event) {
                    const file = event.target.files[0];
                    const reader = new FileReader();

                    reader.onload = (e) => {
                        this.$refs.imagePreview.src = e.target.result;
                        if (this.cropper) {
                            this.cropper.replace(e.target.result);
                        } else {
                            this.cropper = new Cropper(this.$refs.imagePreview, {
                                aspectRatio: 1,
                                viewMode: 1,
                                dragMode: 'move',
                                crop: () => {
                                    this.updateCroppedPreview();
                                    this.updateHiddenInput();
                                }
                            });
                        }
                    };

                    reader.readAsDataURL(file);
                },
                updateCroppedPreview() {
                    if (this.cropper) {
                        const canvas = this.cropper.getCroppedCanvas();
                        this.$refs.croppedPreview.src = canvas.toDataURL();
                    }
                },
                updateHiddenInput() {
                    if (this.cropper) {
                        const croppedData = this.cropper.getData();
                        const hiddenInput = document.getElementById('setting_pic');
                        hiddenInput.value = JSON.stringify(croppedData); // Set the hidden input value with the cropped data
                    }
                }
            };
        }
    </script>

    @livewireScripts
</body>

</html>
