export const content = [
    'templates/**/*.html.twig',
    'assets/js/**/*.js',
];
export const theme = {
    extend: {},
    variants: {
        extend: {
            visibility: ["group-hover"],
        },
    },
};
export const plugins = [require('@tailwindcss/line-clamp')];

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      "./assets/**/*.js",
      "./templates/**/*.html.twig",
    ],
    theme: {
      extend: {},
    },
    plugins: [],
  }