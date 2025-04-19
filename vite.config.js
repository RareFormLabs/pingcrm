import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import path from "path";

console.log("Resolved path for @:", path.resolve(__dirname, "./src/js"));

// https://vite.dev/config/
export default defineConfig({
  plugins: [vue()],
  resolve: {
    alias: {
      "@": path.resolve(__dirname, "./src/js"),
    },
  },
  server: {
    cors: true,
  },
  build: {
    manifest: true,
    outDir: "./web/dist/",
    rollupOptions: {
      input: {
        app: "src/js/app.js",
      },
    },
  },
});
