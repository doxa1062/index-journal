const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
  content: [
    "./site/template/**/*.php",
    "./site/templates/**/*.php",
    "./site/snippets/**/*.php",
    "./site/plugins/**/*.php",
    "./assets/js/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        paper: "#fefcf3",
        ink: "#000000",
        mist: "#c5c5c5",
        charcoal: "#272727",
      },
      fontFamily: {
        sans: ["DinSynt", ...defaultTheme.fontFamily.sans],
        synt: ["DinSynt", "serif"],
      },
      fontSize: {
        body: "var(--font-body)",
        mid: "var(--font-mid)",
        icon: "var(--font-icon)",
        lge: "var(--font-lge)",
        small: "var(--font-small)",
      },
      spacing: {
        gutter: "14px",
        "1.1": "1.1em",
        "2.2": "2.2em",
        "3.3": "3.3em",
        "4.4": "4.4em",
        "5.5": "5.5em",
        "6.6": "6.6em",
      },
      borderRadius: {
        "book-left": "3px",
        "book-right": "2px",
      },
      boxShadow: {
        header: "0px 15px 16px 0px #fff",
        headerScrolled: "0px 20px 16px 0px #fff",
        issue: "0px 11px 16px 0px",
        book: "-0.5rem 0 3rem 0rem rgba(0, 0, 0, 0.3)",
        insetFade: "inset 0px -20px 20px 0px rgba(255, 255, 255, 1)",
      },
      maxWidth: {
        prose: "72%",
        proseWide: "85%",
        article: "55%",
      },
      zIndex: {
        210: "210",
        250: "250",
        1000: "1000",
      },
      screens: {
        xs: "480px",
        lg: "960px",
        grid: "60rem",
        menu: { max: "668px" },
        mobile: { max: "670px" },
        narrow: { max: "736px" },
        tall: { raw: "(max-height: 860px)" },
      },
    },
  },
};
