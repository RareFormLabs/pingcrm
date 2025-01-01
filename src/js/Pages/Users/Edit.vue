<template>
  <div>
    <Head :title="`${form.first_name} ${form.last_name}`" />
    <div class="flex justify-start mb-8 max-w-3xl">
      <h1 class="text-3xl font-bold">
        <Link class="text-indigo-400 hover:text-indigo-600" href="/users"
          >Users</Link
        >
        <span class="text-indigo-400 font-medium">/</span>
        {{ form.fullName }}
      </h1>
    </div>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input
            v-model="form.fullName"
            :error="form.errors.fullName"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Full name"
          />
          <select-input
            v-model="form.fields.isOwner"
            :error="form.errors.isOwner"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Owner"
          >
            <option value="true">Yes</option>
            <option value="false">No</option>
          </select-input>
          <text-input
            v-model="currentUser.email"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Email"
            disabled
          />
          <text-input
            class="pb-8 pr-6 w-full lg:w-1/2"
            type="password"
            label="Password"
            disabled
          />
        </div>
        <div
          class="flex flex-wrap items-center px-8 py-4 bg-gray-50 border-t border-gray-100"
        >
          <div class="text-gray-500 text-sm italic">
            Updating email & password fields is disabled for security reasons.
          </div>
          <loading-button
            :loading="form.processing"
            class="btn-indigo ml-auto"
            type="submit"
            >Update User</loading-button
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
import useForm from "inertia-helper";

defineOptions({
  layout: Layout,
  remember: "form",
});

const props = defineProps({
  currentUser: Object,
});

const form = useForm({
  fullName: props.currentUser.fullName,
  fields: {
    isOwner: props.currentUser.isOwner,
  },
  userId: props.currentUser.id,
  action: "/users/save-user",
});

const update = () => {
  form.post("/users/save-user");
};
</script>
