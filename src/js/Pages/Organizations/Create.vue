<template>
  <div>
    <Head title="Create Organization" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/organizations"
        >Organizations</Link
      >
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input
            v-model="form.title"
            :error="form.errors?.title"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Name"
          />
          <text-input
            v-model="form.email"
            :error="form.errors?.email"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Email"
          />
          <text-input
            v-model="form.phone"
            :error="form.errors?.phone"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Phone"
          />
          <text-input
            v-model="form.address"
            :error="form.errors?.address"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Address"
          />
          <text-input
            v-model="form.city"
            :error="form.errors?.city"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="City"
          />
          <text-input
            v-model="form.region"
            :error="form.errors?.region"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Province/State"
          />
          <select-input
            v-model="form.country"
            :error="form.errors?.country"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Country"
          >
            <option :value="null" />
            <option value="CA">Canada</option>
            <option value="US">United States</option>
          </select-input>
          <text-input
            v-model="form.postalCode"
            :error="form.errors?.postalCode"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Postal code"
          />
        </div>
        <div
          class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100"
        >
          <loading-button
            :loading="form.processing"
            class="btn-indigo"
            type="submit"
            >Create Organization</loading-button
          >
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import Layout from "@/Shared/Layout.vue";
import TextInput from "@/Shared/TextInput.vue";
import SelectInput from "@/Shared/SelectInput.vue";
import LoadingButton from "@/Shared/LoadingButton.vue";

defineOptions({
  layout: Layout,
  remember: "form",
});

const props = defineProps({
  csrfTokenName: String,
  csrfTokenValue: String,
});

const form = useForm({
  title: null,
  fields: {
    email: null,
    phone: null,
    address: null,
    city: null,
    region: null,
    country: null,
    postalCode: null,
  },
  [props.csrfTokenName]: props.csrfTokenValue,
  action: "entries/save-entry",
  sectionId: 2,
  typeId: 2,
  enabled: true,
});
const store = () => {
  form.post("", {
    forceFormData: true,
  });
};
</script>
