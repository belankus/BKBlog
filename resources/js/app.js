import "./bootstrap";
import "flowbite";

import EditorJS from "@editorjs/editorjs";
import Header from "@editorjs/header";
import List from "@editorjs/list";
import RawTool from "@editorjs/raw";
import Paragraph from "editorjs-paragraph-with-alignment";
import ImageTool from "@editorjs/image";

// import Header from "editorjs-header-with-alignment";

// let csrf = document.body.querySelector("input[name='_token']");
// console.log(csrf);

const editor = new EditorJS({
    /**
     * Id of Element that should contain the Editor
     */
    holder: "editorjs",

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
                    byFile: "http://localhost:8008/uploadFile", // Your backend file uploader endpoint
                    byUrl: "http://localhost:8008/fetchUrl", // Your endpoint that provides uploading by Url
                },
                additionalRequestHeaders: csrf.content,
            },
        },
    },
});
