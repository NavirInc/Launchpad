import { defineConfig } from 'vite'

export default defineConfig({
  build: {
    outDir: 'dist',
    emptyOutDir: false,
    cssCodeSplit: false,
    rollupOptions: {
      input: 'src/js/main.js',
      output: {
        format: 'iife',
        entryFileNames: 'js/main.min.js',
        assetFileNames: (info) => {
          const name = info.names?.[0] ?? info.name ?? ''

          if (/\.css$/i.test(name)) {
            return 'css/style.css'
          }
          if (/\.(png|jpe?g|gif|svg|webp|avif|ico)$/i.test(name)) {
            return 'images/[name][extname]'
          }
          if (/\.(woff2?|ttf|otf|eot)$/i.test(name)) {
            return 'fonts/[name][extname]'
          }
          return 'assets/[name][extname]'
        },
      },
    },
  },
})