const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

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
            class: EJModules.Header,
            config: {
                placeholder: "Enter a header",
                levels: [2, 3, 4],
                defaultLevel: 3,
            },
            inlineToolbar: ["link"],
        },
        list: {
            class: EJModules.List,
            inlineToolbar: true,
        },
        raw: EJModules.RawTool,
        paragraph: {
            class: EJModules.Paragraph,
            inlineToolbar: true,
        },
        image: {
            class: EJModules.ImageTool,
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
    onChange: () => {
        editor.save().then((outputData) => {
            // Update the hidden input field with the JSON data
            // console.log(outputData);
            document.getElementById("content").value = JSON.stringify(
                outputData,
                null,
                4
            );
        });
    },
    data: postData,
});
