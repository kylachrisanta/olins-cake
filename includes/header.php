<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com" rel="preconnect">
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,700;800&family=Plus+Jakarta+Sans:wght@400;500;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-error": "#ffffff",
                        "secondary-fixed-dim": "#c8c6c4",
                        "error": "#ba1a1a",
                        "on-error-container": "#93000a",
                        "tertiary-container": "#cda721",
                        "primary": "#000000",
                        "background": "#fff8f6",
                        "outline-variant": "#d3c3c0",
                        "surface-container-low": "#faf2f0",
                        "nastar-bg": "#FFE087",
                        "tertiary": "#735c00",
                        "on-background": "#1e1b1a",
                        "on-tertiary-fixed": "#231a00",
                        "surface-container-high": "#eee6e5",
                        "surface-tint": "#745753",
                        "secondary-container": "#e1dfdd",
                        "on-surface": "#1e1b1a",
                        "primary-fixed": "#ffdad5",
                        "inverse-on-surface": "#f7efee",
                        "primary-fixed-dim": "#e3beb8",
                        "secondary": "#5e5e5c",
                        "surface-variant": "#e8e1df",
                        "surface": "#fff8f6",
                        "on-primary": "#ffffff",
                        "surface-warm": "#FFF8F6",
                        "secondary-fixed": "#e4e2df",
                        "on-tertiary-fixed-variant": "#574500",
                        "outline": "#827472",
                        "tertiary-fixed": "#ffe087",
                        "surface-container-highest": "#e8e1df",
                        "on-tertiary": "#ffffff",
                        "on-secondary": "#ffffff",
                        "on-tertiary-container": "#4f3e00",
                        "primary-container": "#2b1613",
                        "on-primary-fixed-variant": "#5b403c",
                        "sprinkle-orange": "#FFB74D",
                        "on-secondary-fixed": "#1b1c1a",
                        "surface-container": "#f4eceb",
                        "on-primary-fixed": "#2b1613",
                        "surface-bright": "#fff8f6",
                        "surface-dim": "#e0d8d7",
                        "error-container": "#ffdad6",
                        "tertiary-fixed-dim": "#ebc23d",
                        "on-surface-variant": "#504442",
                        "inverse-primary": "#e3beb8",
                        "on-primary-container": "#9c7c77",
                        "on-secondary-container": "#636361",
                        "on-secondary-fixed-variant": "#474745",
                        "surface-container-lowest": "#ffffff",
                        "brownie-bg": "#FFDAD6",
                        "inverse-surface": "#33302f"
                    },
                    "borderRadius": {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "margin-mobile": "20px",
                        "card-padding": "32px",
                        "margin-desktop": "80px",
                        "gutter": "24px",
                        "section-padding": "64px",
                        "unit": "8px"
                    },
                    "fontFamily": {
                        "display-md": ["Bricolage Grotesque"],
                        "body-md": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"],
                        "headline-lg": ["Bricolage Grotesque"],
                        "label-bold": ["Plus Jakarta Sans"],
                        "display-lg": ["Bricolage Grotesque"],
                        "headline-lg-mobile": ["Bricolage Grotesque"]
                    },
                    "fontSize": {
                        "display-md": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.01em", "fontWeight": "800"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "headline-lg": ["32px", {"lineHeight": "40px", "fontWeight": "700"}],
                        "label-bold": ["14px", {"lineHeight": "20px", "fontWeight": "700"}],
                        "display-lg": ["72px", {"lineHeight": "80px", "letterSpacing": "-0.02em", "fontWeight": "800"}],
                        "headline-lg-mobile": ["28px", {"lineHeight": "36px", "fontWeight": "700"}]
                    }
                }
            }
        }
    </script>
<style>
    .tactile-shadow {
        box-shadow: 0 4px 24px -4px rgba(62, 39, 35, 0.05), 0 12px 16px -8px rgba(62, 39, 35, 0.02);
    }
    .pattern-dots {
        background-image: radial-gradient(#d3c3c0 1px, transparent 1px);
        background-size: 16px 16px;
    }
    .path-line {
        stroke-dasharray: 20 20;
        animation: dash 30s linear infinite;
    }
    @keyframes dash {
        to {
            stroke-dashoffset: -1000;
        }
    }
</style>

