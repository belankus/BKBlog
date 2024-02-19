import "./bootstrap";
import Alpine from "alpinejs";
import "flowbite";
import flatpickr from "flatpickr";

window.Alpine = Alpine;
window.flatpickr = flatpickr;

import EditorJS from "@editorjs/editorjs";
import Header from "@editorjs/header";
import List from "@editorjs/list";
import RawTool from "@editorjs/raw";
import Paragraph from "editorjs-paragraph-with-alignment";
import ImageTool from "@editorjs/image";

const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");
const editor = new EditorJS({
    /**
     * Id of Element that should contain the Editor
     */
    holder: "editorjs",
    onReady: () => {
        editor.on("block:destruct", (block) => {
            if (block.type === "image") {
                const imageUrl = block.data.file.url; // Replace with the actual property that contains the image URL
                deleteImageFromStorage(imageUrl);
            }
        });
    },
    /**
     * Available Tools list.
     * Pass Tool's class or Settings object for each Tool you want to use
     */
    tools: {
        header: {
            class: Header,
            config: {
                placeholder: "Enter a header",
                levels: [2, 3, 4],
                defaultLevel: 3,
            },
            inlineToolbar: ["link"],
        },
        list: {
            class: List,
            inlineToolbar: true,
        },
        raw: RawTool,
        paragraph: {
            class: Paragraph,
            inlineToolbar: true,
        },
        image: {
            class: ImageTool,
            config: {
                endpoints: {
                    byFile: "/dashboard/posts/cache-image", // Your backend file uploader endpoint
                    byUrl: "http://localhost:8008/fetchUrl", // Your endpoint that provides uploading by Url
                },
                additionalRequestHeaders: {
                    "X-CSRF-TOKEN": csrfToken,
                },
            },
        },
    },
});
Alpine.start();
