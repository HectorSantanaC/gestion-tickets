<?php
// Tailwind CSS Configuration
// This config is shared across all views
?>
<script id="tailwind-config">
  tailwind.config = {
    darkMode: "class",
    theme: {
      extend: {
        "colors": {
          "on-primary-fixed-variant": "#173bab",
          "inverse-primary": "#b8c4ff",
          "on-tertiary-fixed-variant": "#802a00",
          "on-tertiary-fixed": "#380d00",
          "outline": "#757684",
          "on-secondary": "#ffffff",
          "surface-container-low": "#f2f4f6",
          "surface-container": "#eceef0",
          "on-primary-fixed": "#001453",
          "surface-container-lowest": "#ffffff",
          "primary-fixed-dim": "#b8c4ff",
          "tertiary-fixed-dim": "#ffb59a",
          "tertiary-container": "#872d00",
          "background": "#f7f9fb",
          "on-background": "#191c1e",
          "primary-fixed": "#dde1ff",
          "secondary-container": "#d0e1fb",
          "surface-container-high": "#e6e8ea",
          "error": "#ba1a1a",
          "inverse-surface": "#2d3133",
          "outline-variant": "#c4c5d5",
          "secondary-fixed-dim": "#b7c8e1",
          "primary": "#00288e",
          "on-primary": "#ffffff",
          "on-error": "#ffffff",
          "surface-variant": "#e0e3e5",
          "tertiary": "#611e00",
          "on-surface": "#191c1e",
          "surface-tint": "#3755c3",
          "surface-dim": "#d8dadc",
          "inverse-on-surface": "#eff1f3",
          "secondary-fixed": "#d3e4fe",
          "on-error-container": "#93000a",
          "on-tertiary": "#ffffff",
          "tertiary-fixed": "#ffdbce",
          "on-secondary-fixed-variant": "#38485d",
          "surface": "#f7f9fb",
          "secondary": "#505f76",
          "on-primary-container": "#a8b8ff",
          "on-secondary-container": "#54647a",
          "on-tertiary-container": "#ffa583",
          "primary-container": "#1e40af",
          "surface-container-highest": "#e0e3e5",
          "on-surface-variant": "#444653",
          "error-container": "#ffdad6",
          "surface-bright": "#f7f9fb",
          "on-secondary-fixed": "#0b1c30"
        },
        "borderRadius": {
          "DEFAULT": "0.25rem",
          "lg": "0.5rem",
          "xl": "0.75rem",
          "full": "9999px"
        },
        "spacing": {
          "margin-xl": "32px",
          "unit": "8px",
          "gutter": "16px",
          "card-gap": "12px",
          "margin-sm": "4px",
          "container-padding": "24px",
          "margin-md": "8px",
          "margin-lg": "16px"
        },
        "fontFamily": {
          "meta-xs": ["Inter"],
          "body-md": ["Inter"],
          "label-sm": ["Inter"],
          "body-lg": ["Inter"],
          "h3": ["Inter"],
          "h1": ["Inter"],
          "h2": ["Inter"]
        },
        "fontSize": {
          "meta-xs": ["12px", {
            "lineHeight": "16px",
            "fontWeight": "400"
          }],
          "body-md": ["14px", {
            "lineHeight": "20px",
            "fontWeight": "400"
          }],
          "label-sm": ["13px", {
            "lineHeight": "18px",
            "fontWeight": "600"
          }],
          "body-lg": ["16px", {
            "lineHeight": "24px",
            "fontWeight": "400"
          }],
          "h3": ["20px", {
            "lineHeight": "28px",
            "fontWeight": "500"
          }],
          "h1": ["30px", {
            "lineHeight": "38px",
            "letterSpacing": "-0.02em",
            "fontWeight": "600"
          }],
          "h2": ["24px", {
            "lineHeight": "32px",
            "letterSpacing": "-0.01em",
            "fontWeight": "600"
          }]
        }
      },
    },
  }
</script>