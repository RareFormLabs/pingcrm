<template>
  <div>
    <Head title="Create Contact" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/contacts"
        >Contacts</Link
      >
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input
            v-model="form.fields.firstName"
            :error="form.errors.first_name"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="First name"
          />
          <text-input
            v-model="form.fields.lastName"
            :error="form.errors.last_name"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Last name"
          />
          <select-input
            v-model="form.fields.organization[0]"
            :error="form.errors.organization"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Organization"
          >
            <option :value="null" />
            <option
              v-for="organization in organizations"
              :key="organization.value"
              :value="organization.value"
            >
              {{ organization.label }}
            </option>
          </select-input>
          <text-input
            v-model="form.fields.email"
            :error="form.errors.email"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Email"
          />
          <text-input
            v-model="form.fields.phone"
            :error="form.errors.phone"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Phone"
          />
          <text-input
            v-model="form.fields.address"
            :error="form.errors.address"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Address"
          />
          <text-input
            v-model="form.fields.city"
            :error="form.errors.city"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="City"
          />
          <text-input
            v-model="form.fields.state"
            :error="form.errors.state"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Province/State"
          />
          <select-input
            v-model="form.fields.country"
            :error="form.errors.country"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Country"
          >
            <option :value="null" />
            <option value="CA">Canada</option>
            <option value="US">United States</option>
          </select-input>
          <text-input
            v-model="form.fields.postalCode"
            :error="form.errors.postalCode"
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
            >Create Contact</loading-button
          >
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import Layout from "@/Shared/Layout.vue";
import TextInput from "@/Shared/TextInput.vue";
import SelectInput from "@/Shared/SelectInput.vue";
import LoadingButton from "@/Shared/LoadingButton.vue";

defineOptions({
  layout: Layout,
  remember: "form",
});

const props = defineProps({
  organizations: Array,
  csrfTokenName: String,
  csrfTokenValue: String,
  redirect: String,
});

const form = useForm({
  fields: {
    firstName: "",
    lastName: "",
    organization: [],
    email: "",
    phone: "",
    address: "",
    city: "",
    state: "",
    country: "",
    postalCode: "",
  },
});

const store = () => {
  form
    .transform((data) => ({
      ...data,
      action: "entries/save-entry",
      sectionId: 3,
      redirect: props.redirect,
      [props.csrfTokenName]: props.csrfTokenValue,
    }))
    .post("", {
      forceFormData: true,
    });
};
</script>
