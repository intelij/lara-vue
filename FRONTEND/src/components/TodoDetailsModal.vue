<template>
  <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto">
    <div class="fixed inset-0 bg-black opacity-25"></div>
    <div class="relative w-auto max-w-3xl mx-auto my-6 z-50">
      <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
        <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
          <h3 class="text-3xl font-semibold text-black">
            Todo Details
          </h3>
          <button
            class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
            @click="closeModal">
            <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
              ×
            </span>
          </button>
        </div>
        <div class="relative p-6 flex-auto text-black">
          <p class="text-lg font-bold">Title: {{ todo.title }}</p>
          <p class="mt-2 text-lg leading-relaxed">{{ todo.description }}</p>
          <p class="mt-4">Status: {{ todo.completed ? 'Completed' : 'Active' }}</p>
          <p class="mt-2">Date Created: {{ formatDate(todo.created_at) }}</p>
        </div>
        <div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b">
          <button
            class="bg-blue-500 text-white font-bold uppercase px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1"
            type="button" @click="closeModal"> 
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    todo: {
      type: Object,
      required: true,
    },
    showModal: {
      type: Boolean,
      required: true,
    },
  },
  methods: {
    formatDate(dateString) {
      const options = { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' };
      return new Date(dateString).toLocaleString('en-GB', options);
    },
    closeModal() {
      this.$emit('close');
    },
  },
};
</script>