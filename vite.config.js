import { defineConfig } from 'vite'

export default defineConfig({
  build: {
    outDir: 'dist',
    emptyOutDir: false, // indispensable, sinon Vite vide le dossier du thème
    cssCodeSplit: false,
    rollupOptions: {
      input: 'src/js/main.js',
      output: {
        format: 'iife', // script classique, sans type="module"
        entryFileNames: 'js/main.min.js',
        assetFileNames: (info) => {
          const name = info.names?.[0] ?? info.name ?? ''
          return name.endsWith('.css') ? 'style.css' : 'assets/[name][extname]'
        },
      },
    },
  },
})