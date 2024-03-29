/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    safelist: [
        "border-red-400",
        "bg-red-100",
        "text-red-400",
        "hover:bg-red-400",
        "hover:text-red-100",
        "border-yellow-400",
        "bg-yellow-50",
        "text-yellow-400",
        "hover:bg-yellow-300",
        "hover:text-yellow-100",
        "border-green-400",
        "bg-green-100",
        "text-green-400",
        "hover:bg-green-400",
        "hover:text-green-100",
        "border-blue-400",
        "bg-blue-100",
        "text-blue-600",
        "hover:bg-blue-400",
        "hover:text-blue-100",
        "border-gray-400",
        "bg-gray-100",
        "text-gray-400",
        "hover:bg-gray-400",
        "hover:text-gray-100",
    ],
    theme: {
        extend: {
            fontFamily: {
                body: [
                    "Inter",
                    "ui-sans-serif",
                    "system-ui",
                    "-apple-system",
                    "system-ui",
                    "Segoe UI",
                    "Roboto",
                    "Helvetica Neue",
                    "Arial",
                    "Noto Sans",
                    "sans-serif",
                    "Apple Color Emoji",
                    "Segoe UI Emoji",
                    "Segoe UI Symbol",
                    "Noto Color Emoji",
                ],
                sans: [
                    "Inter",
                    "ui-sans-serif",
                    "system-ui",
                    "-apple-system",
                    "system-ui",
                    "Segoe UI",
                    "Roboto",
                    "Helvetica Neue",
                    "Arial",
                    "Noto Sans",
                    "sans-serif",
                    "Apple Color Emoji",
                    "Segoe UI Emoji",
                    "Segoe UI Symbol",
                    "Noto Color Emoji",
                ],
            },
            colors: {
                primary: {
                    50: "#eff6ff",
                    100: "#dbeafe",
                    200: "#bfdbfe",
                    300: "#93c5fd",
                    400: "#60a5fa",
                    500: "#3b82f6",
                    600: "#2563eb",
                    700: "#1d4ed8",
                    800: "#1e40af",
                    900: "#1e3a8a",
                    950: "#172554",
                },
            },
        },
    },
    plugins: [
        require("flowbite/plugin"),
        require("flowbite-typography"),
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
