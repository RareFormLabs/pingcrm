<template>
  <Head title="Login" />
  <div class="flex items-center justify-center p-6 min-h-screen bg-indigo-800">
    <div class="w-full max-w-md">
      <logo class="block mx-auto w-full max-w-xs fill-white" height="50" />
      <form
        class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden"
        @submit.prevent="login"
      >
        <div class="px-10 py-12">
          <h1 class="text-center text-3xl font-bold">Welcome Back!</h1>
          <div class="mt-6 mx-auto w-24 border-b-2" />
          <text-input
            v-model="form.loginName"
            :error="form.errors.loginName"
            class="mt-10"
            label="Email"
            type="text"
            autofocus
            autocapitalize="off"
          />
          <text-input
            v-model="form.password"
            :error="form.errors.password"
            class="mt-6"
            label="Password"
            type="password"
          />
          <label class="flex items-center mt-6 select-none" for="remember">
            <input
              id="remember"
              v-model="form.rememberMe"
              class="mr-1"
              type="checkbox"
            />
            <span class="text-sm">Remember Me</span>
          </label>
        </div>
        <div class="flex px-10 py-4 bg-gray-100 border-t border-gray-100">
          <loading-button
            :loading="form.processing"
            class="btn-indigo ml-auto"
            type="submit"
            >Login</loading-button
          >
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import Logo from "@/Shared/Logo.vue";
import TextInput from "@/Shared/TextInput.vue";
import LoadingButton from "@/Shared/LoadingButton.vue";

const props = defineProps({
  csrfTokenValue: String,
  csrfTokenName: String,
  redirect: String,
});

const form = useForm({
  loginName: "johndoe@example.com",
  password: "secret",
  rememberMe: false,
  redirect: props.redirect,
});

const login = () => {
  form.post("users/login");
};
</script>
