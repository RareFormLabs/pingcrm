<template>
  <div>
    <Head :title="`${form.firstName} ${form.lastName}`" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/contacts"
        >Contacts</Link
      >
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.fields.firstName }} {{ form.fields.lastName }}
    </h1>
    <trashed-message
      v-if="contact.status === 'disabled'"
      class="mb-6"
      @restore="restore"
    >
      This contact has been deleted.
    </trashed-message>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input
            v-model="form.fields.firstName"
            :error="form.errors.firstName"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="First name"
          />
          <text-input
            v-model="form.fields.lastName"
            :error="form.errors.lastName"
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
          class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100"
        >
          <button
            v-if="contact.status !== 'disabled'"
            class="text-red-600 hover:underline"
            tabindex="-1"
            type="button"
            @click="destroy"
          >
            Delete Contact
          </button>
          <loading-button
            :loading="form.processing"
            class="btn-indigo ml-auto"
            type="submit"
            >Update Contact</loading-button
          >
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Layout from "@/Shared/Layout.vue";
import TextInput from "@/Shared/TextInput.vue";
import SelectInput from "@/Shared/SelectInput.vue";
import LoadingButton from "@/Shared/LoadingButton.vue";
import TrashedMessage from "@/Shared/TrashedMessage.vue";
import useForm from "inertia-helper";

defineOptions({
  layout: Layout,
  remember: "form",
});

const props = defineProps({
  contact: Object,
  organizations: Array,
});

const form = useForm({
  entryId: props.contact.id,
  action: "entries/save-entry",
  fields: {
    firstName: props.contact.firstName,
    lastName: props.contact.lastName,
    organization: [props.contact.organization],
    email: props.contact.email,
    phone: props.contact.phone,
    address: props.contact.address,
    city: props.contact.city,
    state: props.contact.state,
    country: props.contact.country,
    postalCode: props.contact.postalCode,
  },
});

const update = async () => {
  form.post("entries/save-entry");
};

const destroy = () => {
  if (confirm("Are you sure you want to delete this contact?")) {
    // Usually, to delete an element, you'd want to set "elements/delete" as the action,
    // but since we're demoing a soft-delete, and need access to the soft-deleted element
    // on the frontend, we'll set the status to "disabled" instead.
    form
      .transform((data) => ({
        ...data,
        enabled: false,
      }))
      .post("", {
        forceFormData: true,
      });
  }
};

const restore = () => {
  if (confirm("Are you sure you want to restore this contact?")) {
    form
      .transform((data) => ({
        ...data,
        enabled: true,
      }))
      .post("", {
        forceFormData: true,
      });
  }
};
</script>
