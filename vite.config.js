import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  plugins: [vue()],
  build: {
    outDir: 'assets/dist', // Saída em assets/dist para inclusão no CI3
    emptyOutDir: true,
    manifest: true, // Gera manifest para inclusão fácil
  },
  server: {
    proxy: {
      '/api': 'http://localhost:8000/index.php', // Proxy para evitar CORS durante dev (ajuste a porta do CI3)
    },
  },
});