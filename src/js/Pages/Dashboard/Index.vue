<template>
  <div>
    <Head title="Dashboard" />
    <h1 class="mb-8 text-3xl font-bold">Dashboard</h1>
    <p class="mb-8 leading-normal">
      Hey there! Welcome to Ping CRM, a demo app designed to help illustrate how
      <a
        class="text-indigo-500 hover:text-orange-600 underline"
        href="https://inertiajs.com"
        target="_blank"
        >Inertia.js</a
      >
      on the
      <a
        href="https://github.com/RareFormLabs/craft-inertia"
        target="_blank"
        class="text-indigo-500 hover:text-orange-600 underline"
        >Craft CMS adapter</a
      >
      works.
    </p>
    <p class="mb-8 leading-normal">
      The database is reset every day, so feel free to play around as much as
      you like, but please be mindful of others.
    </p>
  </div>
</template>

<script>
import { Head } from "@inertiajs/vue3";
import Layout from "@/Shared/Layout.vue";

export default {
  components: {
    Head,
  },
  layout: Layout,
};
</script>
