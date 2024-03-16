import "./bootstrap";
import "flowbite";
import flatpickr from "flatpickr";
import EditorJS from "@editorjs/editorjs";
import Header from "@editorjs/header";
import List from "@editorjs/list";
import RawTool from "@editorjs/raw";
import Paragraph from "editorjs-paragraph-with-alignment";
import ImageTool from "@editorjs/image";

window.flatpickr = flatpickr;
window.Cropper = Cropper;

window.EditorJS = EditorJS;
window.EJModules = {
    Header,
    List,
    RawTool,
    Paragraph,
    ImageTool,
};
